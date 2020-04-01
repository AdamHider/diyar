<?php

class ModExerciseFormHelper {

    private static $template = [];
    
   
    
    public static function getExercise($exercise_id) {
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        $sql = "
            SELECT 
                el.exercise_id,
                el.question_list
            FROM
                joom_exercise_list el
            WHERE
                el.exercise_id = '$exercise_id' 
        ";
        $db->setQuery($sql);
        return $db->loadObjectList();
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
    
    public static function confirmAjax() {
        $exercise = ModExerciseFormHelper::checkExercise(JRequest::getVar('exercise', '', 'post'));
        return ModExerciseFormHelper::submitExercise($exercise);
    }

    private static function checkExercise($exercise) {
        $correct_answer_template = ModExerciseFormHelper::getCorrectAnswerTemplate($exercise['exercise_id']);
        $points = 0;
        foreach($exercise['question_list'] as $question_id => &$question){
            foreach($question['answers'] as $answer_id => &$answer){
                if(empty($answer['user_choice'])){
                    $answer['user_choice'] = 'false';
                }
                $answer_points = $correct_answer_template[$question_id][$answer_id]*1;
                if($answer_points > 0){
                    $answer_points = '+'.$answer_points;
                }
                if($answer['correct'] == 'true' || $answer['user_choice'] !== 'false'){
                    $answer['answer_points'] = $answer_points;
                }
                if($answer['user_choice'] !== 'false'){
                    $points += $correct_answer_template[$question_id][$answer_id]*1;
                }
            }
        }
        return [
            'exercise_id' => $exercise['exercise_id'],
            'question_list' => $exercise['question_list'],
            'points' => $points
            ];
    }
    
    private static function getCorrectAnswerTemplate($exercise_id) {
        $db = JFactory::getDbo();
        $sql = "
            SELECT 
                correct_answer_template
            FROM
                joom_exercise_list 
            WHERE
                exercise_id = '$exercise_id' 
        ";
        $db->setQuery($sql);
        return json_decode($db->loadAssocList()[0]['correct_answer_template'], TRUE);
    }
    
    private static function submitExercise($exercise) {
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        $sql = "
            INSERT INTO 
                joom_exercise_statistic
            SET
                exercise_id = '".$exercise['exercise_id']."', 
                user_id = '$user_id', 
                exercise_submitted = '".json_encode($exercise['question_list'], JSON_UNESCAPED_UNICODE)."', 
                points = '".$exercise['points']."'
        ";
        return $db->query($db->setQuery($sql));
    }
    
    
    public static function getExerciseValidated($exercise_id){
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        $sql = "
            SELECT 
                es.exercise_id,
                es.exercise_submitted AS question_list,
                es.points,
                el.max_possible_points,
                el.exercise_difficulty,
                ea.article_url
            FROM
                joom_exercise_statistic es
                    JOIN 
                joom_exercise_list el USING(exercise_id)
                    JOIN 
                joom_exercise_to_article ea USING(exercise_id)
            WHERE 
                exercise_id  = '$exercise_id' 
                AND user_id = '$user_id' 
            ORDER BY statistic_id DESC 
            LIMIT 1
        ";
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    
    
    
}
