<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>

<div class="exercise-manager">
    <div id="exercise-manager-body">
        <?php if(!empty($exercise_manager['action'])){
            include 'edit.php'; 
        } else {
            include 'list.php';  
        }
?>   
    </div>
</div>

<script>
   
</script>

