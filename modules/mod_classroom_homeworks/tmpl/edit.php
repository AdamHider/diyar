<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>

<div class="homework-block">
    <div id="homework_body">
        <div class="panel">
                <label for="exercise_title"><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_EXERCISE'); ?></label>
                <?php 
                    $autocomplete_config = [
                        'module_name' => 'classroom_homeworks',
                        'get_data_method_name' => 'getExercise',
                        'input_value_to_render' => $classroom_homeworks['homework']->exercise_title,
                        'input_placeholder' =>  JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_ENTER_EXERCISE_NAME') ,
                        'click_action_method_name' => 'linkExercise'
                    ];
                    include 'autocomplete.php';    
                ?>   
                <form id="homeworkForm" onsubmit="updateHomework(); return false;">
                    
                <input type="hidden" title='homework_id' name="homework_id" value="<?php echo $classroom_homeworks['homework']->homework_id; ?>">
                <div class="exercise_id_holder">
                    <input type="hidden" title='exercise_id' name="exercise_id" value="<?php echo $classroom_homeworks['homework']->exercise_id; ?>" >
                </div>
                
                <label for="start_date"><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_STARTDATE'); ?></label>
                <input type="date" title='start_date' name="start_date" value="<?php echo date("Y-m-d", strtotime($classroom_homeworks['homework']->created_at));  ?>">
                
                <label for="end_date"><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_ENDDATE'); ?></label>
                <input type="date" title='end_date' name="end_date" value="<?php echo date("Y-m-d", strtotime($classroom_homeworks['homework']->finish_date));  ?>">
                
                <label for="status"><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_STATUS'); ?></label>
                <select name="status" value="<?php echo $classroom_homeworks['homework']->status; ?>">
                    <option value="1" <?php if($classroom_homeworks['homework']->status == '1'){echo 'selected="selected"';}  ?>><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_STATUS_1'); ?></option>
                    <option value="0" <?php if($classroom_homeworks['homework']->status == '0'){echo 'selected="selected"';}  ?>><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_STATUS_0'); ?></option>
                </select>
                      
                <div >
                <input type="submit" class='button button-mini' value="<?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_BUTTON_SAVE'); ?>">  
                <button class="button button-mini  back" onclick="window.history.back()"><i class="fa fa-arrow-left"></i><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_BUTTON_BACK'); ?></button>
      
                </div>
      
            </form> 
        </div>
    </div>
</div>

<script>
    
    
    
    function linkExercise(exercise_id){
        var html = '<input type="hidden" title="exercise_id" name="exercise_id" value="'+exercise_id+'">';
        $('.exercise_id_holder').html(html);
    }
    
    function updateHomework(){
        var homework = jQuery('#homeworkForm').serialize(); 
        
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=classroom_homeworks&method=saveChanges&format=json",
            type: "POST",
            data: {homework: homework},
            success: function (response){ 
                window.history.back();
            }
        });
    }
</script>


