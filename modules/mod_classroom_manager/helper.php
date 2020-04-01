
<?php

class ModClassroomManagerHelper {
    public static function getClassroom($user_id){
        $db = JFactory::getDbo();
        $query = "
                SELECT 
                    cl.classroom_id,
                    cl.classroom_code, 
                    cl.classroom_name, 
                    cl.classroom_institution, 
                    cl.classroom_address, 
                    cl.classroom_rank
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
    
    public static function getStudentList($classroom_id){
        $db = JFactory::getDbo();
        $db->query($db->setQuery("SET @rownumber=0"));
        $query = "
            SELECT 
                (@rownumber:=@rownumber + 1) AS rowNumber, t.*
            FROM
                (SELECT 
                    u.id,
                    COALESCE(ud.avatar_link, 'images/users/user_placeholder.png')  avatar_link,
                    u.name student_name,
                    u.lastVisitDate last_visit
                FROM
                    joom_classroom_students cs
                JOIN joom_users u ON cs.user_id = u.id
                LEFT JOIN joom_user_dashboard ud ON ud.user_id = u.id
                LEFT JOIN joom_exercise_statistic es ON es.user_id = cs.user_id
                WHERE
                    classroom_id = '$classroom_id'
                GROUP BY cs.user_id
                ORDER BY name ASC) t 
               ";
        $db->setQuery($query);
        $result = $db->loadObjectList();
        return $result;
    }
    
     public static function getTopStudents($classroom_id){
        $db = JFactory::getDbo();
        ModClassroomManagerHelper::createTempView($classroom_id);
        $db->setQuery("SELECT * FROM common_view_tmp WHERE rowNumber LIMIT 3");
        return $db->loadObjectList();
    }
    
    public static function getStudentsRatingChartView($classroom_id){
        $user_id = JFactory::getUser()->id;
        $result = [
            'labels' => [],
            'data' => [],
            'backgroundColor' => [],
            'colors' => ModClassroomManagerHelper::composeBackgroundGradients()
        ];
        $db = JFactory::getDbo();
        ModClassroomManagerHelper::createTempView($classroom_id);
        $db->setQuery("SELECT * FROM common_view_tmp WHERE rowNumber LIMIT 3");
        $rating_list = $db->loadObjectList();
        foreach($rating_list as $rating){
            $result['labels'][] = $rating->name;
            $result['data'][] = $rating->total_points;
            if($user_id == $rating->user_id){
                $result['backgroundColor'][] = 'gradient_user';
            } else {
                $result['backgroundColor'][] = 'gradient_common';
            }
        }
        
        return $result;  
    }
    
    private static function createTempView($classroom_id){
        $db = JFactory::getDbo();
        $db->query($db->setQuery("SET @rating=0"));
        $sql = "
            CREATE TEMPORARY TABLE IF NOT EXISTS common_view_tmp
            SELECT * FROM
                (SELECT (@rating:=@rating + 1) AS rowNumber, t.*
            FROM
                (SELECT 
                    es.exercise_id,
                    COALESCE(ud.avatar_link, 'images/users/user_placeholder.png') avatar_link,
                    es.user_id,
                    es.total_points,
                    COUNT(DISTINCT ch.homework_id) AS homeworks_completed,
                    u.name
                FROM
                    (SELECT *, SUM(points) AS total_points
                    FROM
                        joom_exercise_statistic
                    GROUP BY user_id) es
            LEFT JOIN joom_classroom_homeworks ch ON ch.exercise_id = es.exercise_id
            JOIN joom_classroom_students cs ON cs.user_id = es.user_id AND cs.classroom_id = $classroom_id
            LEFT JOIN joom_user_dashboard ud ON ud.user_id = es.user_id
            JOIN joom_users u ON u.id = es.user_id
            GROUP BY user_id
            ORDER BY total_points DESC) t) t1
               ";
        return $db->query($db->setQuery($sql));
    }
    
    public static function saveChangesAjax() {
        $classroom = [];
        mb_parse_str(JRequest::getVar('classroom', '', 'post'), $classroom);
        ModClassroomManagerHelper::updateClassroom($classroom);
        return;
    }
    private static function updateClassroom($classroom) {
        $db = JFactory::getDbo();
        $sql = "
            UPDATE 
                joom_classroom_list
            SET
                classroom_name = '".$classroom['classroom_name']."', 
                classroom_institution = '".$classroom['classroom_institution']."', 
                classroom_address = '".$classroom['classroom_address']."'
            WHERE 
                classroom_id = '".$classroom['classroom_id']."'
        ";
        $db->query($db->setQuery($sql));
        return $db->insertid();
    }
    
    private static function composeBackgroundGradients(){
        $result = [
            'all_labels' => '',
            'backgroundGradients' => []
        ];
        $startColors = [
            '#022e97', '#fd6375', '#3d0997', '#6668d9', '#e4e372', '#f4c26f', '#ffcb2c', '#ca5080', '#0cd7f7', '#f396c9', '#ffc22e', '#fe2759', 
            '#f128b9', '#88d2ef', '#63e9d5', '#ff1161', '#ff7b44', '#fdb186', '#16e8c8', '#68f510', '#40f16b', '#ea96e4', '#647de3', '#ef4e84'];
        $endColors = [
            '#16a4c1', '#ffd592', '#e96199', '#bd8ae0', '#16b5bc', '#a45ee4', '#ff863f', '#f8b3b1', '#6056f1', '#53e350', '#ff1d5c', '#d89edb',
            '#feaf6a', '#f5376b', '#2488ad', '#fd653d', '#ff5493', '#ff654a', '#a22cdc', '#0b6ce6', '#14ead7', '#9d56b4', '#7755b9', '#cf70d9'];
        for($i = 0; $i < 3; $i++){
            if($i > 0){
                $result['all_labels'] .= ',';
            }
            $result['all_labels'] .= 'gradient_'.$i;
            $result['backgroundGradients'][] = [
                'label' => 'gradient_'.$i,
                'startColor' => $startColors[$i],
                'endColor' => $endColors[$i]
            ];
        }
        return $result;
    }
    
    private static function classroomCodeGenerate($user_id){
        $code = substr(md5($user_id), 0, 8).$user_id;
        return $code;
    }
           
    public static function createClassroomAjax() {
        $data = [];
        mb_parse_str(JRequest::getVar('classroom', '', 'post'), $data);
        $user_id = JFactory::getUser()->id;
        $classroom_code = ModClassroomManagerHelper::classroomCodeGenerate($user_id);
        $db = JFactory::getDbo();
        // Retrieve the shout
        $query = "
                INSERT INTO
                   joom_classroom_list
                SET
                    classroom_name = '{$data["classroom_name"]}',
                    classroom_code = '$classroom_code',
                    teacher_id = $user_id,
                    classroom_institution = '{$data["classroom_institution"]}',
                    classroom_address = '{$data["classroom_address"]}'
               ";
        $db->setQuery($query);
        return $db->query();
    }
    
    public static function calculateDate($date_input) {
        $result = '';
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


