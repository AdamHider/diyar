<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
$active_language = JFactory::getLanguage()->get('tag');
?>

<div class="exercise-list">
    <?php if(!empty($article_exercises['exercise_list'])){
        foreach($article_exercises['exercise_list'] as $exercise_group_name => $exercise_group){ ?>
        <div class="exercise_group <?php  echo $exercise_group_name; ?>">   
            <?php  if($exercise_group_name == 'basic_exercises'){  ?>
                <h2>General Exercises</h2>
            <?php  } else { ?>
                <h2>Custom Exercises</h2>
            <?php  } ?>
            <div class="group-content">    
            <?php  foreach($exercise_group as $exercise){  ?>
            <div class="exercise-block <?php echo JText::_('MOD_ARTICLE_EXERCISE_DIFFICULTY_CLASS_'.$exercise->exercise_difficulty); ?> <?php if(!empty($exercise->homework_active) && !$exercise->points){ echo 'is-homework';} ?>  <?php if(!empty($exercise->points)){ echo "is-passed" ;}?>">
                <div class="column exercise-image">
                    <img src="images/exercise_engine/diyar_difficulty_<?php echo $exercise->exercise_difficulty; ?>.png" />
                </div>
                <div class="column exercise-name">
                    <p class="exercise-title">
                    <?php if(!empty($exercise->exercise_head->headvalues)){
                        foreach ($exercise->exercise_head->headvalues as $headvalue_id => $headvalue){ 
                        if(!empty($headvalue) && $headvalue->language == $active_language){   
                            echo $headvalue->value;?> 
                        <label><?php echo $headvalue->value;?></label>
                    <?php   } 
                    }}?> 
                    </p>
                    <p>  <?php echo JText::_('MOD_ARTICLE_EXERCISE_DIFFICULTY_TEXT_'.$exercise->exercise_difficulty);?> </p>
                     <p><?php echo ' ('.$exercise->question_quantity.' '.JText::_('MOD_ARTICLE_EXERCISE_TEXT_QUESTIONS_QUANTITY').')'; ?></p>
                </div> 
                <?php if(in_array(10, $user_levels) && $user->id == $exercise->created_by){ ?>
                    <div class="column exercise-edit">
                        <a class="edit-button" href="<?php echo JText::_('MOD_ARTICLE_EXERCISE_LINK_EDIT_EXERCISE'); ?><?php echo $exercise->exercise_id?>"><i class="fa fa-pencil"></i></a>   
                    </div>
                <?php }  ?>
                <?php if(empty($exercise->points)){ ?>
                    <div class="column exercise-action">
                        <a class="button button-positive" href="<?php echo JText::_('MOD_ARTICLE_EXERCISE_LINK_GO_EXERCISE'); ?><?php echo $exercise->exercise_id?>&action=form"><?php echo JText::_('MOD_ARTICLE_EXERCISE_TEXT_GO'); ?></a>   
                    </div>
                <?php } else { ?>
                    <div class="column exercise-is-passed">
                        <div class="exercise-is-passed-container">
                            <label><?php echo JText::_('MOD_ARTICLE_EXERCISE_TEXT_TEST_PASSED'); ?></label>
                            <div class="is-passed-action">
                                <i class="fa fa-check"></i>
                                <a class="passed-button" href="<?php echo JText::_('MOD_ARTICLE_EXERCISE_LINK_GO_EXERCISE'); ?><?php echo $exercise->exercise_id?>&action=view"><i class="fa fa-eye"></i></a>  
                            </div>   
                        </div>
                    </div>
                    <div class="column exercise-points">
                        <?php 
                            $points = $exercise->points;
                            $max = $exercise->max_possible_points;
                            $percentage = $points*100/$max;
                            if($percentage >= 100){
                                $class = "super";
                            } else if($percentage < 100 && $percentage >= 80){
                                $class = "good";
                            } else if($percentage < 80 && $percentage >= 60){
                                $class = "pre-good";
                            } else if($percentage < 60 && $percentage >= 40){
                                $class = "normal";
                            } else if($percentage < 40 && $percentage >= 20){
                                $class = "pre-normal";
                            } else if($percentage < 20 && $percentage >= 0){
                                $class = "bad";
                            }   
                        ?>
                        <div class="points <?php echo $class; ?>">
                            <span class="total-real-points"><?php echo $exercise->points; ?></span>
                            <span class="total-max">/<?php echo $exercise->max_possible_points; ?></span>
                            <img class="fa fa-star" src="/diyar/images/icons/star.png" width="30px"/>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
            </div>
        </div>
        <?php } ?>
     <?php }?>
</div>

<script>
    function init(){
        jQuery('#create_exercise').on('click', function(){
            openEditor();
        })
    }
    function openEditor() {
        var url = window.location.href + "?action=edit";
        window.history.pushState("", "", url);
        location.replace("?action=edit");
        return;
    };
    init();
</script>

