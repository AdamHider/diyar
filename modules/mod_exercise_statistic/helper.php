
<?php

class ModExerciseStatisticHelper {
    
  
    
    public static function getStatisticListView(){
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        $sql = "
            SELECT 
                es.exercise_id,
                es.user_id,
                es.points,
                el.exercise_difficulty,
                el.is_basic,
                el.question_quantity,
                con.title as article_title,
                el.exercise_head,
                el.max_possible_points,
                ea.article_url,
                es.created_at
            FROM
                joom_exercise_statistic es
                        JOIN
                joom_exercise_to_article ea USING(exercise_id)
                        JOIN
                joom_exercise_list el USING (exercise_id)
                        JOIN
                joom_content con ON con.id = ea.article_id
            WHERE es.user_id = $user_id    
            ORDER BY es.created_at DESC 
               ";
        $db->setQuery($sql);
        $result = $db->loadObjectList();
        return $result;
    }
    
     public static function getStatisticCommonView(){
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        ModExerciseStatisticHelper::createTempView();
        
        $db->setQuery("SELECT rowNumber FROM common_view_tmp WHERE user_id = $user_id");
        $rowNumber = $db->loadObjectList()[0]->rowNumber;
        
        $db->setQuery("SELECT * FROM common_view_tmp WHERE rowNumber BETWEEN $rowNumber - 5 AND $rowNumber + 5");
        return $db->loadObjectList();
    }
    
    public static function getStatisticChartView(){
        $user_id = JFactory::getUser()->id;
        $db = JFactory::getDbo();
        ModExerciseStatisticHelper::createTempView();
        
        $db->setQuery("SELECT rowNumber FROM common_view_tmp WHERE user_id = $user_id");
        $rowNumber = $db->loadObjectList()[0]->rowNumber;
        
        $db->setQuery("SELECT user_id, u.name FROM common_view_tmp t JOIN joom_users u ON u.id = t.user_id WHERE rowNumber BETWEEN $rowNumber - 5 AND $rowNumber + 5");
        
        $result = [
            'users' => [],
            'dates' => ModExerciseStatisticHelper::getWeeks(date('m'), date('Y'))
        ];
        $colors = ['#312567', '#f4cd42', '#adc661', '#2768b8','#e45b13', 'orange', 'darkblue', 'pink', 'purple'];
        $user_list = $db->loadObjectList();
        foreach($user_list as $key => $user){
                $borderWidth = 3;
            if($user->user_id == $user_id){
                $borderWidth = 6;
            }
            $user_object = [
                'label' => $user->name,
                'data' => [],
                'borderWidth' => '1',
                'borderColor' => $colors[$key],
                'borderWidth' => $borderWidth,
                'lineTension' => '0',
                'fill' => 'false'
            ];
            foreach($result['dates']['start_dates'] as $date){
                $points = '';
                $db->setQuery("SELECT COALESCE(SUM(points), 0) total_points FROM joom_users u LEFT JOIN (SELECT statistic_id, exercise_id, user_id, exercise_submitted, SUM(points) as points, created_at FROM joom_exercise_statistic GROUP BY user_id, exercise_id) es ON u.id = es.user_id JOIN joom_exercise_list el USING (exercise_id) WHERE es.user_id = $user->user_id AND es.created_at <= '$date'");
                $total_points = $db->loadObjectList()[0];
                if(!empty($total_points)){
                    $points = $total_points->total_points;
                }
                $user_object['data'][] = $points;
            }
            $result['users'][] = $user_object;
        }
        return $result;
    }
    
    private static function createTempView(){
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
                    u.name
                FROM
                    (SELECT *, SUM(points) AS total_points
                    FROM
                        joom_exercise_statistic
                    GROUP BY user_id) es
            LEFT JOIN joom_user_dashboard ud ON ud.user_id = es.user_id
            JOIN joom_users u ON u.id = es.user_id
            GROUP BY user_id
            ORDER BY total_points DESC) t) t1
               ";
        return $db->query($db->setQuery($sql));
    }
    
        
    public static function saveChangesAjax() {
        $homework = [];
        mb_parse_str(JRequest::getVar('homework', '', 'post'), $homework);
        ModClassroomHomeworksHelper::updateHomework($homework);
        return;
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
    private static function getWeeks($month,$year){		//total no. weeks in month
        $output = [];
        foreach([$month-1,$month] as $month){
            $month = intval($month);				//force month to single integer if '0x'
            $suff = array('st','nd','rd','th','th','th'); 		//week suffixes
            $end = date('t',mktime(0,0,0,$month,1,$year)); 		//last date day of month: 28 - 31
            $start = date('w',mktime(0,0,0,$month,1,$year)); 	//1st day of month: 0 - 6 (Sun - Sat)
            $last = 7 - $start; 					//get last day date (Sat) of first week
            $noweeks = ceil((($end - ($last + 1))/7) + 1);						//initialize string		
            $monthlabel = str_pad($month, 2, '0', STR_PAD_LEFT);
            for($x=1;$x<$noweeks+1;$x++){	
                if($x == 1){
                    $startdate = "$year-$monthlabel-01";
                    $day = $last - 6;
                }else{
                    $day = $last + 1 + (($x-2)*7);
                    $day = str_pad($day, 2, '0', STR_PAD_LEFT);
                    $startdate = "$year-$monthlabel-$day";
                }
                if($x == $noweeks){
                    $enddate = "$year-$monthlabel-$end";
                }else{
                    $dayend = $day + 6;
                    $dayend = str_pad($dayend, 2, '0', STR_PAD_LEFT);
                    $enddate = "$year-$monthlabel-$dayend";
                }
                if($enddate < date("Y-m-d", strtotime("-1 months"))){
                    continue;
                }
                if($startdate > date('Y-m-d')){
                    break;
                }
                $output['start_dates'][] = $startdate;
                $output['end_dates'][] = $enddate;
                $output['labels'][] = date('d M', strtotime($startdate)).' - '.date('d M', strtotime($enddate));
            }
        }
	return $output;
    }
    
}


