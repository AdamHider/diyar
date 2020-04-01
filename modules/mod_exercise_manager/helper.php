<?php

class ModExerciseManagerHelper {

    private static $template = [];
    
    public static function getExerciseList() {
        $user_id = JFactory::getUser()->id;
        $active_language = JFactory::getLanguage()->get('tag');
        $db = JFactory::getDbo();
        $sql = "
            SELECT DISTINCT
                el.exercise_id,
                el.status,
                el.is_basic,
                cont.title as article_title,
                el.exercise_head,
                cont.language,
                el.exercise_difficulty,
                el.question_quantity,
                ea.article_url,
                el.modified_at
            FROM
                joom_exercise_list el
                    JOIN 
                joom_exercise_to_article ea USING (exercise_id)
                    JOIN 
                joom_content cont ON ea.article_id = cont.id
            WHERE el.created_by = '$user_id' 
            HAVING language = '$active_language'
            ORDER BY modified_at DESC
        ";
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    
    public static function getExercise($exercise_id) {
        if($exercise_id == 0){
            $exercise_id = ModExerciseManagerHelper::createExercise();
        }
        $exercise = ModExerciseManagerHelper::getExerciseById($exercise_id)[0];
        return $exercise;
    }
    
    private static function getExerciseById($exercise_id) {
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        $sql = "
            SELECT 
                el.exercise_id,
                el.status,
                el.is_basic,
                el.exercise_head,
                el.exercise_difficulty,
                el.question_list
            FROM
                joom_exercise_list el
            WHERE
                el.created_by = '$user_id'
                    AND el.exercise_id = '$exercise_id'
            LIMIT 1
        ";
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    
    public static function saveChangesAjax() {
        $exercise = JRequest::getVar('exercise', '', 'post');
        ModExerciseManagerHelper::linkExerciseToArticles($exercise['article_id'], $exercise['exercise_id']);
        ModExerciseManagerHelper::updateExercise($exercise);
        return;
    }
    
    private static function createExercise() {
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        $db->query($db->setQuery("DELETE FROM joom_exercise_list WHERE question_quantity IS NULL"));
        $sql = "
            INSERT INTO 
                joom_exercise_list
            SET
                status = 0,
                exercise_head = '{}',
                question_list = '{}',
                created_by = $user_id
        ";
        $db->query($db->setQuery($sql));
        return $db->insertid();
    }
    private static function updateExercise($exercise) {
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        if(empty($exercise['exercise_head'])){
            $exercise['exercise_head'] = "'".'{}'."'";
        } else {
            $exercise['exercise_head'] = "'".json_encode($exercise['exercise_head'],  JSON_UNESCAPED_UNICODE )."'";
        }
        $recompiled = ModExerciseManagerHelper::recompileCorrectAnswerTemplate($exercise['question_list']);
        $correct_answer_template = $recompiled['template'];
        $sql = "
            UPDATE 
                joom_exercise_list
            SET
                status = '".$exercise['status']."',
                is_basic = '".$exercise['is_basic']."',
                exercise_difficulty = '".$exercise['exercise_difficulty']."',
                question_quantity = '".count($exercise['question_list'])."',
                exercise_head = ".$exercise['exercise_head'].",
                question_list = '".json_encode($exercise['question_list'],  JSON_UNESCAPED_UNICODE )."',
                correct_answer_template = '".json_encode($correct_answer_template,  JSON_UNESCAPED_UNICODE )."',
                max_possible_points = '".$recompiled['max_possible_points']."',
                modified_at = NOW() 
            WHERE 
                exercise_id = '".$exercise['exercise_id']."'
        ";
        $db->query($db->setQuery($sql));
        return $db->insertid();
    }
    
    
    public static function getLanguageList() {
        $result = [];
        $language_list = JLanguage::getKnownLanguages();
        $active_language = JFactory::getLanguage()->get('tag');
        foreach($language_list as $tag => $language){
            if($tag !== $active_language){
                array_push($result, $language['tag']);
            } else {
                array_unshift($result, $language['tag']);
            }
        }
        return $result;
    }
    
    

   
    private static function linkExerciseToArticles($article_id, $exercise_id){
        $db = JFactory::getDbo();
        $db->query($db->setQuery("DELETE FROM joom_exercise_to_article WHERE article_id = '$article_id' AND exercise_id = '$exercise_id'"));
        $complete_article_list = ModExerciseManagerHelper::getAssociatedArticles($article_id);
        if(empty($complete_article_list)){
            $complete_article_list = [['id'=>$article_id]];
        }
        foreach($complete_article_list as $article){
            $article_url = ModExerciseManagerHelper::getURLOfExerciseArticle($article_id);
            $sql = "
                INSERT INTO 
                    joom_exercise_to_article
                SET
                    article_id = '".$article['id']."',
                    exercise_id = '$exercise_id',
                    article_url = '$article_url'
            ";
            $db->query($db->setQuery($sql));
        }
        return;
    }
    
    private static function getAssociatedArticles($article_id){
        $db = JFactory::getDbo();
         $sql = "
            SELECT 
                id
            FROM
                joom_associations
            WHERE
                `context` = 'com_content.item'
            AND `key` = (SELECT `key` FROM  joom_associations WHERE id = '$article_id')
        ";
        $db->setQuery($sql);
        return $db->loadAssocList();
    }
    
    private static function recompileCorrectAnswerTemplate($question_list){
        $result = [];
        $max_possible_points = 0;
        foreach($question_list as $question_id => $question){
            foreach($question['answers'] as $answer_id => $answer){
                if($answer['correct'] == 'true'){
                    $answer_points = (int)$question['hardness'];
                    $max_possible_points += $answer_points;
                } else {
                    $answer_points = 0;
                    
                }
                $result[$question_id][$answer_id] = $answer_points;
            }
        }
        return [
            'template' => $result,
            'max_possible_points' => $max_possible_points
            ];
    }
    
    public static function getExerciseArticle($exercise_id){
        $db = JFactory::getDbo();
        $active_language = JFactory::getLanguage()->get('tag');
         $sql = "
            SELECT 
                cont.id, cont.title
            FROM
                joom_exercise_to_article ea
                    JOIN
                joom_content cont ON (ea.article_id = cont.id AND cont.language = '$active_language')
            WHERE
                exercise_id = '$exercise_id'
        ";
        $db->setQuery($sql);
        $result = $db->loadAssocList();
        if(empty($result)){
            return [
                'id' => 0,
                'title' => ''
            ];
        } else {
            return $result[0];
        }
    }
    
    public static function getArticleAjax() {
        $search = mb_strtolower(JRequest::getVar('search', '', 'post'));
        $user = JFactory::getUser();
        $user_id = $user->id;
        $active_language = JFactory::getLanguage()->get('tag');
        $levels = JAccess::getAuthorisedViewLevels($user_id);
        $db = JFactory::getDbo();
         $sql = "
            SELECT 
                jcon.id, CONCAT (jcon.title, ' (',jcat.title,')') as title
            FROM
                joom_content jcon
                JOIN
                joom_categories jcat ON (jcat.id = jcon.catid)
            WHERE
                jcon.access IN (".implode(',', $levels).") AND jcon.language = '$active_language' 
                    AND
                    ( LOWER(jcon.title) LIKE '$search%' 
                   OR LOWER(jcon.title) LIKE '% $search%' 
                   OR LOWER(jcon.title) LIKE '$search' 
                   OR LOWER(jcat.title) LIKE '$search%'
                   OR LOWER(jcat.title) LIKE '% $search%'
                   OR LOWER(jcat.title) LIKE '$search'
                    )
                LIMIT 10    
        ";
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    public static function getURLOfExerciseArticle($article_id) {
        $menu_url = 'option=com_content&view=category&layout=blog&id=';
        $db = JFactory::getDbo();
        $sql = "
            SELECT 
                con.id as article_id, menu.id as menu_id
            FROM
                joom_content con 
                    JOIN 
                joom_menu menu ON menu.link LIKE CONCAT('%', '$menu_url', con.catid)
            WHERE 
                con.id = $article_id
        ";
        $db->setQuery($sql);
        $ids_object = $db->loadObjectList()[0];
        $result_url = 'index.php?option=com_content&view=article&id='.$ids_object->article_id.'&Itemid='.$ids_object->menu_id;
        return $result_url;
    }
    public static function calculateDate($date_input) {
        $result = '';
        if($date_input && ($date_input == '1970-01-01 00:00:00' || $date_input == '-')){
            return '-';
        }
        $date = date('d.m.Y', strtotime($date_input));
        $time = date('H:i', strtotime($date_input));
        $from_date = strtotime($date);
        $to_date = strtotime(date('d.m.Y'));
        $date_diff = floor(($to_date - $from_date)/3600/24);
        if($date_diff == 0){
            $from_time = strtotime($time);
            $to_time = strtotime(date('H:i'));
            $time_diff = round(abs($to_time - $from_time) / 60);
            if( $time_diff < 59 ){
               $result .= ' '. $time_diff . " minutes ago";
            } else {
                $result .= 'Today at '.$time;
            }
        } else if ($date_diff == 1){
            $result .= 'Yesterday at '.$time;
        } else {
            $result .= $date.' at '.$time;
        } 
        return $result;
    }
}
