<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>

<div class="exercise-main">
    <div id="exercise-body">
        <?php 
        
        if(!empty($exercise_form['exercise']->exercise_id && !empty($action))){
            if($action == 'form'){
                include 'form.php';
            } else {
                include 'view.php'; 
            }
        } 
?>   
    </div>
</div>

<script>
   
</script>

