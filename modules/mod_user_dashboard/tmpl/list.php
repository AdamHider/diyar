<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>

<div class="classroom">
    <div id="classroom_manager_body">
            <div class='classroom_info' >
                <?php if(in_array(10, $user_levels)){ ?>
                    <a class="button button-positive button-mini" href="index.php/ru/мой-профиль/мой-класс?item_id=<?php echo $classroom_manager['classroom']->classroom_id?>&action=edit"><i class="fa fa-pencil"></i></a>
                <?php } ?>
                <div>Name: <?php echo $classroom_manager['classroom']->classroom_name; ?> </div>
                <div>Code: <?php echo $classroom_manager['classroom']->classroom_code; ?> </div>
                <div>Institution: <?php echo $classroom_manager['classroom']->classroom_institution; ?> </div>
                <div>Address: <?php echo $classroom_manager['classroom']->classroom_address; ?> </div>
            </div>
            <div id="top_students">
                <?php foreach($classroom_manager['top_students'] as $top_student ){?>
                <div class='top-student <?php if($top_student->id == $user->id){ echo 'current-user'; } ?>'>
                    <div>
                        <label>Name:</label>
                        <?php echo $top_student->student_name; ?> 
                    </div>
                    <div>
                        <label>Average Difficulty:</label>
                        <?php echo $top_student->total_difficulty; ?> 
                    </div>
                    <div>
                        <label>Average Points:</label>
                        <?php echo $top_student->total_points; ?> 
                    </div>
                </div>
                <?php } ?>
            </div>
            <div id="students_list">
                <?php if(!empty($classroom_manager['student_list'])){ 
                    foreach($classroom_manager['student_list'] as $student ){?>
                <div class='student-block <?php if($student->id == $user->id){ echo 'current-user'; } ?>'>
                    <div>
                        <label>Name:</label>
                        <?php echo $student->student_name; ?> 
                    </div>
                    <div>
                        <label>Last Visit:</label>
                        <?php 
                            echo ModClassroomManagerHelper::calculateDate($student->last_visit);
                        ?> 
                    </div>
                    <div>
                        <label>Rating:</label>
                        <?php echo $student->total_points; ?> 
                    </div>
                </div>
                <?php }} ?>
            </div>
    </div>
</div>

<script>
    
    var autocomplete_results = [];
    var current_letter = '';
    var keyboard_is_active = false;
    
    function init(){
        jQuery('.edit_homework').on('click', function(e){
            var homework_id = jQuery(e.target).attr('data-homework_id');
            openEditor(homework_id);
        })
    }
    function openEditor(homework_id) {
        var url = window.location.href + "?action=edit";
        if(homework_id > 0){
            url += '&homework_id='+homework_id;
        }
        window.history.pushState("", "", url);
        location.replace(url);
        return;
    };
    function editClassroom(){
        var classroom = jQuery('#classroomForm').serialize(); 
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=classroom_manager&method=createClassroom&format=json",
            type: "POST",
            data: {classroom: classroom},
            success: function (response){
                location.replace('');
            }
        });
    }
    
    function createHomework(){
        var homework = jQuery('#homeworkForm').serialize(); 
        return;
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=classroom_manager&method=createClassroom&format=json",
            type: "POST",
            data: {classroom: classroom},
            success: function (response){
                location.replace('');
            }
        });
    }
    
    function getWord(word) {
        if(!word){
            word = document.getElementById("search-input").value;
        }
        if(word == ''){
            jQuery('#search-input').css('border', '1px solid #ff7373');
            jQuery('#search-input').css('box-shadow', '0px 0px 7px #f25e5e');
            return;
        }
        var url = window.location.href + "?word=" + word;
        window.history.pushState("", "", url);
        location.replace("?word=" + word);
        return;
    };

   

init();
</script>

