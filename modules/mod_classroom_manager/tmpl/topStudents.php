<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>


<div id="top_students">
    <h2><?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_TOP_STUDENTS_TITLE'); ?></h2>
    <div class="top-student-list">
        <?php foreach($classroom_manager['top_students'] as $top_student ){?>
        <div class='top-student-<?php echo $top_student->rowNumber; ?>  <?php if($top_student->user_id == $user->id){ echo 'current-user'; } ?>'>
            <div  class="column-name">
                <?php echo $top_student->name; ?> 
            </div>
            <div  class="column-image">
                <img class="avatar-main" src="<?php echo $top_student->avatar_link; ?>" 
                     style="background-image: url('images/exercise_engine/primacy_<?php echo $top_student->rowNumber; ?>.png')"/> 
            </div>
            <div  class="column-total-points">
                <?php echo $top_student->total_points; ?> 
            </div>
        </div>
        <?php } ?>
    </div>
    <img class="top-background-image"  src="images/exercise_engine/primacy_base.png"/>
</div>

