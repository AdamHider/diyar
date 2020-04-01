<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
$active_language = JFactory::getLanguage()->get('tag');
?>

<div class="homeworks-list">
    <?php if(!empty($classroom_homeworks['homeworks_list'])){
        foreach($classroom_homeworks['homeworks_list'] as $homework){ ?>
            <div class="homework-block 
            <?php if(in_array(11, $user_levels)){if($homework->points){ echo 'homework-done'; }else { echo 'homework-undone'; }}?>
            <?php if(in_array(10, $user_levels)){if($homework->status == '1'){ echo 'homework-published'; }else { echo 'homework-unpublished'; }}?>"
            >
                <div class="first-row">
                    <div class="column">
                        <label><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_STARTDATE'); ?>:</label>
                        <?php 
                        echo ModClassroomHomeworksHelper::calculateDate($homework->start_date);
                        ?> 
                    </div>
                    <div class="column">
                        <label><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_ENDDATE'); ?>:</label>
                        <?php 
                        echo ModClassroomHomeworksHelper::calculateDate($homework->end_date);
                        ?> 
                    </div>
                    <?php if(in_array(10, $user_levels)){ ?>
                    <div class="column">
                        <?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_STATUS_'.$homework->status); ?>
                    </div>
                    <div class="column action-edit">
                            <button class='button edit_homework' data-homework_id="<?php echo $homework->homework_id?>" ><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_BUTTON_EDIT'); ?></button> 
                            <button class='button button-negative delete_homework' data-homework_id="<?php echo $homework->homework_id?>" ><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_BUTTON_DELETE'); ?></button> 
                    </div>
                     <?php }  ?>
                </div>
                <div class="second-row">
                    <div class="column">
                        <label><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_LESSON'); ?>: </label>
                        <?php echo $homework->article_title?>
                        <a class="button button-positive button-mini" href="<?php echo JURI::base().'index.php?'.$homework->article_url;?>"><i class="fa fa-eye"></i></a>  
                    </div>
                    <div class="column exercise_name">
                        <label><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_EXERCISE'); ?>: </label>
                        <?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_SUPERIORITY_'.$homework->is_basic).' '; ?>
                        <?php if(!empty($homework->exercise_head->headvalues)){
                            foreach ($homework->exercise_head->headvalues as $headvalue_id => $headvalue){ 
                            if(!empty($headvalue) && $headvalue->language == $active_language){  ?>   
                               <?php echo $headvalue->value ?>
                        <?php  } 
                        }}  echo JText::_('MOD_CLASSROOM_HOMEWORKS_DIFFICULTY_TEXT_'.$homework->exercise_difficulty).' ('.$homework->question_quantity.' '.JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_QUESTIONS_QUANTITY').')';?> 
                            <a class="button button-mini button-positive" href="<?php echo JText::_('MOD_CLASSROOM_HOMEWORKS_LINK_GO_EXERCISE'); ?><?php echo $homework->exercise_id?>&action=view"><i class="fa fa-eye"></i></a>
                   </div>
                    <?php if(in_array(11, $user_levels) && $homework->points){  ?>
                    <div class="column">
                        <label><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_POINTS'); ?>:</label>
                        <?php echo $homework->points; ?>/100
                    </div>
                    <?php } ?>
                </div>  
                <div class="row completed-homework">
                    <button class="accordion"><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_COMPLETED_BY'); ?>:</button>
                    <div class="panel">
                        <?php if(!empty($homework->students)){ 
                            foreach ($homework->students as $student){  ?>   
                        <div class="homework-student-block <?php if($student->completed){ echo 'completed'; }  ?>"> 
                            <div  class="column">
                                <img src="<?php echo $student->avatar_link; ?>" width="30px"/> 
                            </div>  
                            <div><?php echo $student->student_name ?></div> 
                            <?php if(in_array(10, $user_levels) && $student->points){  ?>
                            <div><?php echo $student->points ?></div> 
                            <div>
                                <?php 
                                echo ModClassroomHomeworksHelper::calculateDate($student->created_at);
                                ?> 
                            </div> 
                            <?php } ?>
                        </div>
                        <?php  } }?> 
                    </div>
                </div>  
                
                
                
            </div>
        <?php } ?>
     <?php } else {?>
        <div class='exercise_empty_message' >
            <?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_TEXT_NO_HOMEWORKS'); ?>
        </div>
     <?php } ?>
    
    <?php if(in_array(10, $user_levels)){ ?>
        <button class='button edit_homework' data-homework_id="0"><?php  echo JText::_('MOD_CLASSROOM_HOMEWORKS_BUTTON_CREATE_HOMEWORK'); ?></button>
    <?php } ?>
</div>

<script>
    
    var autocomplete_results = [];
    var current_letter = '';
    var keyboard_is_active = false;
    
    function init(){
        accordionInit();
        jQuery('.edit_homework').on('click', function(e){
            var homework_id = jQuery(e.target).attr('data-homework_id');
            openEditor(homework_id);
        })
        jQuery('.delete_homework').on('click', function(e){
            var homework_id = jQuery(e.target).attr('data-homework_id');
            deleteHomework(homework_id);
        })
    }
    
    function accordionInit(){
        var acc = document.getElementsByClassName("accordion");
        var i;
        for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");
            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
              panel.style.display = "none";
            } else {
              panel.style.display = "block";
            }
          });
        } 
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
    
    function deleteHomework(homework_id){
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=homeworks_manager&method=deleteHomework&format=json",
            type: "POST",
            data: {homework_id: homework_id},
            success: function (response){
               location.replace('');
            }
        });
    }
    
init();
</script>

