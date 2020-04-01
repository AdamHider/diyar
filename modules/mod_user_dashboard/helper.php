
<?php

class ModUserDashboardHelper {
    public static function getUserDashboard($user_id){
        $db = JFactory::getDbo();
        $query = "
            SELECT 
                ud.user_id,
                COALESCE(ud.avatar_link, 'images/users/user_placeholder.png') avatar_link,
                COALESCE(ud.background_link, 'images/users/user_background.jpg') background_link,
                u.name
            FROM
                joom_user_dashboard ud
                JOIN 
                joom_users u ON ud.user_id = u.id
            WHERE
                ud.user_id = '$user_id'
               ";
        $db->setQuery($query);
        $result = $db->loadObjectList();
        return $result;
    }
    
    public static function createUserDashboard($user_id){
        $db = JFactory::getDbo();
        $query = "
            INSERT INTO
                joom_user_dashboard
            SET
                user_id = $user_id
               ";
        return $db->query($db->setQuery($query));
    }
    
    
    public static function linkImageToUser($file_name, $image_url,$user_id){
        $db = JFactory::getDbo();
        $query = "
            UPDATE
                joom_user_dashboard
            SET
                ".$file_name."_link = '" . addslashes($image_url) . "'
            WHERE
                user_id = $user_id
               ";
        return $db->query($db->setQuery($query));
    }
    
    private static $image_requirements = [
        'avatar' => [
            'minWidth' => 200,
            'maxWidth' => 500,
            'minHeight' => 200,
            'maxHeight' => 500,
            'equalSize' => true
        ],
        'background' => [
            'minWidth' => 1920,
            'maxWidth' => 2400,
            'minHeight' => 300,
            'maxHeight' => 500,
            'equalSize' => false
        ],
    ];
    
    public static function uploadPhotosAjax(){
        $result_array = [];
        if(!empty($_FILES)){
            foreach($_FILES as $file_name => $file){
                if(empty($file["name"])){
                    continue;
                }
                $result = [
                    'link' => '',
                    'target' => $file_name,
                    'error' => false
                ];
                $user   = JFactory::getUser();
                $image_path = "/images/users/user_".$user->id."/";
                $target_dir = JPATH_BASE.$image_path;
                $imageFileType = strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));
                $target_file = $target_dir . $file_name .  '.' .$imageFileType;
                $uploadOk = 1;
                
                // Check if image file is a actual image or fake image
                // Check width and height
                if(!empty($file["tmp_name"])) {
                    $image_size = getimagesize($file["tmp_name"]);
                    if($image_size == false) {
                        $result['error'] = "File is not an image.";
                        $uploadOk = 0;
                    } else {
                        $result['error'] = ModUserDashboardHelper::checkImageSize($image_size, $file_name);
                    }
                }
                // Check if file already exists
                if(!is_dir($target_dir)){
                    mkdir($target_dir, 0777);
                }
                
                // Check file size
                if ($file["size"] > 2000000) {
                    $result['error'] = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $result['error'] = "Sorry, only JPG, JPEG, PNG files are allowed.";
                    $uploadOk = 0;
                }

                if ($uploadOk && !$result['error']) {
                    $extensions = ['jpg','jpeg','png'];
                    foreach($extensions as $extension){
                        if(file_exists($target_dir . $file_name . '.' . $extension)){
                            unlink($target_dir . $file_name . '.' . $extension);
                        }
                    }
                    if ( move_uploaded_file( $file["tmp_name"], $target_file ) ) {
                        $result['link'] = ltrim($image_path, '/') . $file_name . '.' .$imageFileType;
                    } else {
                        $result['error'] = "Sorry, there was an error uploading your file.";
                    }
                }
                $result_array[] = $result;
                if(empty($result['error'])){
                    ModUserDashboardHelper::linkImageToUser($file_name, $result['link'],$user->id);
                } else {
                    break;
                }
                
            }
        }
        return $result_array;
    }
    
    private static function checkImageSize($image_size, $file_name){
        $error = false;
        $width = $image_size[0];
        $height = $image_size[1];
        if(ModUserDashboardHelper::$image_requirements[$file_name]['equalSize']){
            if($width !== $height){
                $error = "Image must be squared!";
            } else {
                if($width < ModUserDashboardHelper::$image_requirements[$file_name]['minWidth']){
                    $error = "Image is too small!".$file_name ." minimum width is ".ModUserDashboardHelper::$image_requirements[$file_name]['minWidth'];
                } 
                if($width > ModUserDashboardHelper::$image_requirements[$file_name]['maxWidth']){
                    $error = "Image is too big!".$file_name ." maximum width is ".ModUserDashboardHelper::$image_requirements[$file_name]['maxWidth'];
                } 
            }
        } else {
            if($width < ModUserDashboardHelper::$image_requirements[$file_name]['minWidth']){
                $error = "Image width is too small!".$file_name ." minimum width is ".ModUserDashboardHelper::$image_requirements[$file_name]['minWidth'];
            } else 
            if ($height < ModUserDashboardHelper::$image_requirements[$file_name]['minHeight']){
                $error = "Image height is too small!".$file_name ." minimum height is ".ModUserDashboardHelper::$image_requirements[$file_name]['minHeight'];
            } else 
            if($width > ModUserDashboardHelper::$image_requirements[$file_name]['maxWidth']){
                $error = "Image width is too big!".$file_name ." maximum width is ".ModUserDashboardHelper::$image_requirements[$file_name]['maxWidth'];
            } else 
            if ($height > ModUserDashboardHelper::$image_requirements[$file_name]['maxHeight']){
                $error = "Image height is too big!".$file_name ." maximum height is ".ModUserDashboardHelper::$image_requirements[$file_name]['maxHeight'];
            }
        }
        return $error;
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


