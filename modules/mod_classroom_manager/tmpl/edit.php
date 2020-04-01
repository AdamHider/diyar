<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>

<div class="classroom">
    <div id="classroom_manager_body">
        <form id="classroomForm" onsubmit="updateClassroom(); return false;">
            <input type="hidden" title='ClassroomId'  name="classroom_id" value="<?php echo $classroom_manager['classroom']->classroom_id; ?>">
            
            <label for="classroom_name"><?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_CLASSROOM_NAME'); ?>:</label>
            <input type="text" title='Name'  name="classroom_name" value="<?php echo $classroom_manager['classroom']->classroom_name; ?>" placeholder="<?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_CLASSROOM_NAME_PLACEHOLDER'); ?>">
            
            <label for="classroom_institution"><?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_CLASSROOM_INSTITUTION_NAME'); ?>:</label>
            <input type="text" title='Address' name="classroom_institution" value="<?php echo $classroom_manager['classroom']->classroom_institution; ?>" placeholder="<?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_CLASSROOM_INSTITUTION_NAME_PLACEHOLDER'); ?>">
            
            <label for="classroom_address"><?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_CLASSROOM_ADDRESS'); ?>:</label>
            <input type="text" title='Institution' name="classroom_address" value="<?php echo $classroom_manager['classroom']->classroom_address; ?>" placeholder="<?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_CLASSROOM_ADDRESS_PLACEHOLDER'); ?>">
            
            <input type="submit" class='button' value="<?php  echo JText::_('MOD_CLASSROOM_MANAGER_BUTTON_SAVE'); ?>">
        </form> 
    </div>
</div>

<script>
    
    var autocomplete_results = [];
    var current_letter = '';
    var keyboard_is_active = false;
    
    
    
    function updateClassroom(){
        var classroom = jQuery('#classroomForm').serialize(); 
        
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=classroom_manager&method=saveChanges&format=json",
            type: "POST",
            data: {classroom: classroom},
            success: function (response){ 
                window.history.back();
            }
        });
    }
    
    

   

init();
</script>

