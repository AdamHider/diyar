<?php

class ModArticleExercisesHelper {

    private static $template = [];
    
    public static function composeExerciseList($article_id) {
        $exercise_list = ModArticleExercisesHelper::getExerciseList($article_id);
        $result_exercises = [
            'basic_exercises' => [],
            'custom_exercises' => []
        ];
        foreach($exercise_list as &$exercise){
            $exercise->exercise_head = json_decode($exercise->exercise_head, false, 512, JSON_UNESCAPED_UNICODE);
            if($exercise->is_basic == '1'){
                $result_exercises['basic_exercises'][] = $exercise;
            } else {
                $result_exercises['custom_exercises'][] = $exercise;
            }
        }
        return $result_exercises;
    }
    
    private static function getExerciseList($article_id) {
        $user_id = JFactory::getUser()->id;
        $user_levels = JAccess::getGroupsByUser($user_id);
        $where = '';
        if(in_array(11, $user_levels)){
            $where .= " AND el.status = 1";
        }
        $db = JFactory::getDbo();
        $sql = "
            SELECT 
                ea.exercise_id,
                cont.title article_title,
                el.is_basic,
                el.exercise_head,
                el.exercise_difficulty,
                el.question_quantity,
                es.points,
                el.max_possible_points,
                el.created_by,
                (SELECT DISTINCT
                    homework_id
                FROM
                    joom_classroom_homeworks ch
                        JOIN
                    joom_classroom_students cs ON ch.classroom_id = cs.classroom_id
                        LEFT JOIN
                    joom_exercise_statistic es1 ON es1.exercise_id = ch.exercise_id
                        AND es1.user_id = cs.user_id
                WHERE
                        ch.exercise_id = el.exercise_id
                    AND cs.user_id = $user_id
                    AND ch.created_at <= CURDATE()
                    AND ch.status = 1) AS homework_active
            FROM
                joom_exercise_to_article ea
                    JOIN
                joom_exercise_list el ON ea.exercise_id = el.exercise_id
                    LEFT JOIN
                joom_exercise_statistic es ON es.exercise_id = el.exercise_id AND es.user_id = $user_id
                    LEFT JOIN
                joom_content cont ON cont.id = ea.article_id
            WHERE 
                ea.article_id = '$article_id'  $where
            GROUP BY ea.exercise_id
            ORDER BY is_basic DESC, exercise_difficulty ASC
        ";
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    
    public static function getExercise($exercise_id) {
        if($exercise_id == 0){
            $exercise_id = ModArticleExercises::createExercise();
        }
        $exercise = ModArticleExercises::getExerciseById($exercise_id)[0];
        return $exercise;
    }
    
    
    private static function createExercise() {
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        $garbage_clear_query = "DELETE FROM joom_exercise_list WHERE exercise_data IS NULL OR exercise_data = '{}'";
        $db->query($db->setQuery($garbage_clear_query));
        $sql = "
            INSERT INTO 
                joom_exercise_list
            SET
                status = 0,
                created_by = $user_id
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
                array_push($result, $tag);
            } else {
                array_unshift($result, $tag);
            }
        }
        return $result;
    }
    
    public static function saveChangesAjax() {
        $exercise = JRequest::getVar('exercise', '', 'post');
        ModArticleExercises::linkExerciseToArticles($exercise['article_id'], $exercise['exercise_id']);
        ModArticleExercises::updateExercise($exercise);
        return;
    }

    public static function updateExercise($exercise) {
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        $sql = "
            UPDATE 
                joom_exercise_list
            SET
                exercise_data = '".json_encode($exercise['question_list'],  JSON_UNESCAPED_UNICODE )."'
            WHERE
                created_by = $user_id AND exercise_id = {$exercise['exercise_id']}
                    
        ";
        $db->query($db->setQuery($sql));
        return;
    }
   
    private static function linkExerciseToArticles($article_id, $exercise_id){
        $db = JFactory::getDbo();
        $db->query($db->setQuery("DELETE FROM joom_exercise_to_article WHERE article_id = '$article_id'"));
        $complete_article_list = ModArticleExercises::getAssociatedArticles($article_id);
        if(empty($complete_article_list)){
            $complete_article_list = [['id'=>$article_id]];
        }
        foreach($complete_article_list as $article){
            $sql = "
                INSERT INTO 
                    joom_exercise_to_article
                SET
                    article_id = '".$article['id']."',
                    exercise_id = '$exercise_id'
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
                exercise_id = $exercise_id
        ";
        $db->setQuery($sql);
        $result = $db->loadAssocList()[0];
        if(empty($result)){
            $result = [
                'id' => 0,
                'title' => ''
            ];
        }
        return $result;
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
}
