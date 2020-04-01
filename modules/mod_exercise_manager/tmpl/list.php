<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
$active_language = JFactory::getLanguage()->get('tag');
?>

<div class="exercise-list">
    <div class="exercise-list-head">
        <div class="column">
            <label><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_STATUS'); ?>: </label>
        </div>
        <div class="column exercise_name">
            <label><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_LESSON'); ?>: </label>
        </div>
        <div class="column exercise_name">
            <label><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_EXERCISE'); ?>: </label>
        </div>
        <div class="column">
            <label><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_LAST_MODIFICATION'); ?>: </label>
        </div>
        <div class="column">
            <label><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_ACTION'); ?>: </label>
        </div>
    </div>  
    <?php if(!empty($exercise_manager['exercise_list'])){
        foreach($exercise_manager['exercise_list'] as $exercise){ ?>
            <div class="exercise-block">
                <div class="column">
                    <?php  echo JText::_('MOD_EXERCISE_MANAGER_STATUS_'.$exercise->status); ?>
                </div>
                <div class="column">
                    <?php echo $exercise->article_title?>
                    <a class="button button-positive button-mini" href="<?php echo JURI::base().$exercise->article_url;?>"><i class="fa fa-eye"></i></a>  
                </div>
                <div class="column exercise_name">
                    <?php  echo JText::_('MOD_EXERCISE_MANAGER_SUPERIORITY_'.$exercise->is_basic).' '; ?>
                    <?php if(!empty($exercise->exercise_head) && $exercise->exercise_head !== '{}'){ 
                        foreach (json_decode($exercise->exercise_head, false, 512, JSON_UNESCAPED_UNICODE)->headvalues as $headvalue_id => $headvalue){ 
                        if(!empty($headvalue) && $headvalue->language == $active_language){  ?>   
                           <?php echo $headvalue->value ?>
                    <?php  } 
                        } 
                    }   echo JText::_('MOD_EXERCISE_MANAGER_DIFFICULTY_TEXT_'.$exercise->exercise_difficulty).' ('.$exercise->question_quantity.' '.JText::_('MOD_EXERCISE_MANAGER_TEXT_QUESTIONS_QUANTITY').')';?>
                    <a class="button button-positive button-mini" href="index.php/ru/упражнение?exercise_id=<?php echo $exercise->exercise_id?>&action=form"><i class="fa fa-eye"></i></a>
                </div> 
                <div class="column">
                    <?php  echo ModExerciseManagerHelper::calculateDate($exercise->modified_at); ?>
                </div>
                <div class="column action-edit">
                    <?php if(in_array(10, $user_levels)){ ?>
                    <button class='button edit_exercise' data-exercise_id="<?php echo $exercise->exercise_id?>" ><i class="fa fa-pencil"></i></button> 
                    <?php }  ?>
                </div>
            </div>
        <?php } ?>
     <?php } else {?>
        <div class='exercise_empty_message' ><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_NO_EXERCISES'); ?></div>
     <?php } ?>
     <button id='create_exercise' class='button'><?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_CREATE_EXERCISE'); ?></button>
</div>

<script>
    function init(){
        jQuery('#create_exercise').on('click', function(){
            openEditor('');
        })
        jQuery('.edit_exercise').on('click', function(e){
            var exercise_id = jQuery(e.target).attr('data-exercise_id');
            openEditor(exercise_id);
        })
    }
    function openEditor(exercise_id) {
        var url = window.location.href + "?action=edit";
        if(exercise_id){
            url += '&exercise_id='+exercise_id;
        }
        window.history.pushState("", "", url);
        location.replace(url);
        return;
    };
    init();
</script>

