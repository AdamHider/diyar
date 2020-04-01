<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>

<div class="classroom">
    <div id="classroom_manager_body">
        <form id="classroomForm" onsubmit="updateClassroom(); return false;">
            <input type="hidden" title='ClassroomId'  name="classroom_id" value="<?php echo $classroom_manager['classroom']->classroom_id; ?>">
            
            <label for="classroom_name">Name:</label>
            <input type="text" title='Name'  name="classroom_name" value="<?php echo $classroom_manager['classroom']->classroom_name; ?>">
            
            <label for="classroom_institution">Institution:</label>
            <input type="text" title='Address' name="classroom_institution" value="<?php echo $classroom_manager['classroom']->classroom_institution; ?>">
            
            <label for="classroom_address">Address:</label>
            <input type="text" title='Institution' name="classroom_address" value="<?php echo $classroom_manager['classroom']->classroom_address; ?>">
            
            <input type="submit" class='button' value="Submit">
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
                //window.history.back();
            }
        });
    }
    
    

   

init();
</script>

