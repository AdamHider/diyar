
<?php

class ModClassroomHomeworksHelper {
    
    public static function getClassroom($user_id){
        $db = JFactory::getDbo();
        $query = "
                SELECT 
                    cl.classroom_id
                FROM
                    joom_classroom_list cl
                    JOIN 
                    joom_classroom_students cs USING(classroom_id)
                WHERE
                    cl.teacher_id = $user_id OR cs.user_id = $user_id
               ";
        $db->setQuery($query);
        $result = $db->loadObjectList();
        return $result;
    }
    
    public static function getHomeworksList($classrom_id){
        $user_id = JFactory::getUser()->id;
        $user_levels = JAccess::getGroupsByUser($user_id);
        $where = '';
        if(in_array(10, $user_levels)){
            $where .= " AND ch.created_by = '$user_id' ";
        }
        if(in_array(11, $user_levels)){
            $where .= " AND ch.status = 1 AND CURDATE() >= ch.created_at";
        }
        $db = JFactory::getDbo();
        $sql = "
            SELECT 
                ch.homework_id,
                ch.classroom_id,
                ch.exercise_id,
                es.points,
                el.exercise_head,
                el.exercise_difficulty,
                el.question_quantity,
                el.is_basic,
                con.title as article_title,
                ea.article_url,
                ch.created_at start_date,
                ch.created_by,
                ch.finish_date end_date,
                ch.status
            FROM
                joom_classroom_homeworks ch
                    JOIN
                joom_exercise_to_article ea USING(exercise_id)
                    JOIN
                joom_exercise_list el USING (exercise_id)
                    JOIN
                joom_content con ON con.id = ea.article_id
                    LEFT JOIN
                joom_exercise_statistic es ON 
                        el.exercise_id = es.exercise_id 
                    AND es.user_id = '$user_id'  
            WHERE ch.classroom_id = '$classrom_id' $where
               ";
        $db->setQuery($sql);
        $result = $db->loadObjectList();
        return $result;
    }
    
    public static function getHomeworkPerformedByStudents($homework, $classroom_id){
        $user_id = JFactory::getUser()->id;
        $user_levels = JAccess::getGroupsByUser($user_id);
        $select = '';
        if(in_array(10, $user_levels)){
            $select .= ", COALESCE(ROUND(AVG(es.points)), '-') points, COALESCE(es.created_at, '-') created_at ";
        }
        if(in_array(11, $user_levels)){
            $select .= "";
        }
        $db = JFactory::getDbo();
        $sql = "
            SELECT 
                u.id,
                COALESCE(ud.avatar_link, 'images/users/user_placeholder.png')  avatar_link,
                u.name student_name,
                IF(points IS NOT NULL, 1, 0) completed
                $select
            FROM
                 joom_classroom_students cs 
                    LEFT JOIN joom_exercise_statistic es ON cs.user_id = es.user_id 
                        AND exercise_id = '$homework->exercise_id' 
                    JOIN joom_classroom_homeworks ch ON ch.homework_id = '$homework->homework_id'
                    LEFT JOIN joom_user_dashboard ud ON ud.user_id = cs.user_id
                    JOIN joom_users u ON u.id = cs.user_id
            WHERE
                cs.classroom_id = '$classroom_id' 
            GROUP BY cs.user_id        
            ORDER BY es.points DESC, u.name ASC
               ";
        $db->setQuery($sql);
        $result = $db->loadObjectList();
        return $result;
    }
    
    public static function getHomework($homework_id, $classrom_id){
        if($homework_id == 0){
            $homework_id = ModClassroomHomeworksHelper::createEmptyHomework($classrom_id);
        }
        $homework = ModClassroomHomeworksHelper::getHomeworkById($homework_id)[0];
        return $homework;
    }
    
    
    private static function createEmptyHomework($classrom_id) {
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        $db->query($db->setQuery("DELETE FROM joom_classroom_homeworks WHERE exercise_id = '0'"));
        $sql = "
            INSERT INTO 
                joom_classroom_homeworks
            SET
                classroom_id = '$classrom_id', 
                exercise_id = '0', 
                created_by = '$user_id', 
                created_at = NOW(), 
                finish_date = NOW(), 
                status = ''
        ";
        $db->query($db->setQuery($sql));
        return $db->insertid();
    }
    
    public static function deleteHomework($homework_id) {
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        $db->query($db->setQuery("DELETE FROM joom_classroom_homeworks WHERE homework_id = '$homework_id' AND created_by = '$user_id'"));
        return;
    }
    
    private static function getHomeworkById($homework_id) {
        $db = JFactory::getDbo();
        $active_language = JFactory::getLanguage()->get('tag');
        $sql = "
            SELECT 
                hw.homework_id, 
                hw.classroom_id, 
                hw.exercise_id, 
                cont.title as exercise_title,
                hw.created_at, 
                hw.created_by, 
                hw.finish_date,
                hw.status
            FROM
                joom_classroom_homeworks hw
                    LEFT JOIN
                joom_exercise_to_article ea ON(hw.exercise_id = ea.exercise_id)
                    LEFT JOIN
                joom_content cont ON (ea.article_id = cont.id AND cont.language = '$active_language')
            WHERE homework_id = '$homework_id'
        ";
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    
    public static function saveChangesAjax() {
        $homework = [];
        mb_parse_str(JRequest::getVar('homework', '', 'post'), $homework);
        ModClassroomHomeworksHelper::updateHomework($homework);
        return;
    }
    
    private static function updateHomework($homework) {
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        $sql = "
            UPDATE 
                joom_classroom_homeworks
            SET
                exercise_id = '".$homework['exercise_id']."', 
                created_by = '$user_id', 
                created_at = '".$homework['start_date']."', 
                finish_date = '".$homework['end_date']."', 
                status = '".$homework['status']."'
            WHERE 
                homework_id = '".$homework['homework_id']."'
        ";
        $db->query($db->setQuery($sql));
        return $db->insertid();
    }
    
    
    public static function getExerciseAjax() {
        $search = mb_strtolower(JRequest::getVar('search', '', 'post'));
        $user = JFactory::getUser();
        $user_id = $user->id;
        $active_language = JFactory::getLanguage()->get('tag');
        $levels = JAccess::getAuthorisedViewLevels($user_id);
        
        $db = JFactory::getDbo();
         $sql = "
            SELECT 
                ea.exercise_id as id, 
                CONCAT (jcon.title, ' (',jcat.title,')') as article_title,
                el.exercise_head,
                el.exercise_difficulty,
                el.question_quantity
            FROM
                joom_content jcon
                    JOIN
                joom_categories jcat ON (jcat.id = jcon.catid)
                    JOIN
                joom_exercise_to_article ea ON (ea.article_id = jcon.id)
                    JOIN
                joom_exercise_list el ON (ea.exercise_id = el.exercise_id)
            WHERE
                jcon.access IN (".implode(',', $levels).") AND jcon.language = '$active_language' 
                    AND
                    ( LOWER(jcon.title) LIKE '$search%' 
                   OR LOWER(jcon.title) LIKE '% $search%' 
                   OR LOWER(jcon.title) LIKE '$search' 
                   OR LOWER(jcat.title) LIKE '$search%'
                   OR LOWER(jcat.title) LIKE '% $search%'
                   OR LOWER(jcat.title) LIKE '$search'
                    ) AND el.exercise_head IS NOT NULL
                    AND el.status = 1
                LIMIT 10    
        ";
        $db->setQuery($sql);
        return $db->loadObjectList();
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


