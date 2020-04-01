<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>

<div class="morphology-container">
    <?php foreach( $lugat['morphology'] as $key => $tense ){   ?>
        <h4><?php echo JText::_('MOD_LUGAT_MORGOLOGY_'.strtoupper($tense['group']).'_'.strtoupper($key)); ?></h4>
        <?php if($tense['template'] == 'personilized'){
            include 'template_personilized.php';
        } else if ($tense['template'] == 'noun_case'){
            include 'template_noun_case.php';
        } else {
            include 'template_noun_plurality.php';
        }
        ?>
        
    <?php } ?>
</div>


