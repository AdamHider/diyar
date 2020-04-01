<?php defined('_JEXEC') or die; ?>
<?php $count_questions = 0;?>

<div class="exercise-result">
    <div class="message-container">
        <div class="message"></div>
    </div>
    <div class="total-points-row">
        <?php 
        $points = $exercise_form['exercise']->points;
        $max = $exercise_form['exercise']->max_possible_points;
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
        <div class="total-points <?php echo $class; ?> ">
            <img class="medal" src="/diyar/images/exercise_engine/medal_<?php echo $exercise_form['exercise']->exercise_difficulty; ?>.png" />
            <h4 class="total-level"><?php echo JText::_('MOD_EXERCISE_TEXT_LEVEL').' '.$exercise_form['exercise']->exercise_difficulty; ?></h4>
            <h4 class="total-header"><?php echo JText::_('MOD_EXERCISE_TEXT_YOUR_POINTS').':'; ?></h4>
            <div class="point-block">
                <span class="total-real-points"><?php echo $exercise_form['exercise']->points; ?></span>
                <span class="total-max">/<?php echo $exercise_form['exercise']->max_possible_points; ?></span>
                <img class="fa fa-star" src="/diyar/images/icons/star.png" width="40px"/>
            </div>
            <h4 class="total-title">
                <?php 

                if($percentage >= 100){
                    echo JText::_('MOD_EXERCISE_TEXT_RESULT_SUMMARY_TOP');
                } else if($percentage < 100 && $percentage >= 80){
                    echo JText::_('MOD_EXERCISE_TEXT_RESULT_SUMMARY_5');
                } else if($percentage < 80 && $percentage >= 60){
                    echo JText::_('MOD_EXERCISE_TEXT_RESULT_SUMMARY_4');
                } else if($percentage < 60 && $percentage >= 40){
                    echo JText::_('MOD_EXERCISE_TEXT_RESULT_SUMMARY_3');
                } else if($percentage < 40 && $percentage >= 20){
                    echo JText::_('MOD_EXERCISE_TEXT_RESULT_SUMMARY_2');
                } else if($percentage < 20 && $percentage >= 0){
                    echo JText::_('MOD_EXERCISE_TEXT_RESULT_SUMMARY_1');
                }   
                ?>
            </h4>
        </div> 
    </div>
    <div class='exercise-view'>
        <div class="exercise-title">
            <h4><?php echo JText::_('MOD_EXERCISE_TEXT_YOUR_RESULTS').':'; ?></h4>
        </div>
        <div class='question-list questions-question'>    
            <?php  if(isset($exercise_form['exercise'])){ ?>
            <?php  foreach(json_decode($exercise_form['exercise']->question_list, false, 512, JSON_UNESCAPED_UNICODE) as  $question_id => $question){
                $count_questions ++;
                
                ?>
                <div class='question-block' data-item_id="<?php echo $question_id; ?>">
                    <div class="questionvalue-panel">
                        <div class="questionvalue-list questionvalues-<?php echo $question_id; ?>">
                        <?php if(!empty($question->questionvalues)){ 
                            foreach ($question->questionvalues as $questionvalue_id => $questionvalue){ 
                                if(!empty($questionvalue) && $questionvalue->language == $exercise_form['language']){  ?> 
                                    <h4><?php echo $count_questions.'. '.$questionvalue->value; ?></h4>

                        <?php  } 
                            } 
                        }?> 
                        </div>      
                    </div> 
                    <div class="answer-panel">
                        <?php if(!empty($question->answers)){ 
                            foreach ($question->answers as $answer_id => $answer){ 
                                if(!empty($answer) 
                                        && ((!empty( $answer->user_choice ) && $answer->user_choice !== 'false') 
                                                || (!empty( $answer->correct ) && $answer->correct == 'true'))){  ?> 
                                <div class='answer-block 
                                    <?php if(!empty( $answer->correct ) && $answer->correct == 'true'){ echo 'true-answer'; }else{ echo 'wrong-answer'; } ?>
                                    <?php if(!empty( $answer->user_choice ) && $answer->user_choice !== 'false'){ echo ' user-choice';} ?>' data-item_id="<?php echo $answer_id; ?>"> 
                                    
                                    <?php if(!empty( $answer->user_choice ) && $answer->user_choice !== 'false'){ ?>  
                                        <i class="check"></i>
                                    <?php }?>   
                                    <?php if(!empty($answer->answervalues)){ 
                                        foreach ($answer->answervalues as $answervalue_id => $answervalue){ 
                                            if(!empty($answervalue) && $answervalue->language == $exercise_form['language']){  ?> 
                                                <span class="answer-text">
                                                    <?php if(!empty( $answer->user_choice ) && $answer->user_choice === 'false' 
                                                            && !empty( $answer->correct ) && $answer->correct == 'true'){ ?>  
                                                        <span class="true-answer">True Answer: </span>
                                                    <?php }?>   
                                                    <?php echo $answervalue->value; ?>
                                                </span>
                                    <?php  } 
                                        } 
                                    }?>                 
                                    <?php if(isset($answer->answer_points) && $answer->correct == 'true' && $answer->user_choice !== 'false'){  ?>
                                        <span class="answer-points"> 
                                            <b><?php echo $answer->answer_points; ?></b><img class="fa fa-star" src="/diyar/images/icons/star.png" width="30px"/>
                                        </span>
                                    <?php } ?>                      
                                </div> 
                        <?php  } } }?> 
                    </div>
                </div>
            <?php  } ?>     
             <?php  } ?>  
            </div>  
        
        </div>
    <div class="action-block">
        <a class="button button" href="<?php echo  JURI::base().'index.php?'.$exercise_form['exercise']->article_url; ?>"><i class="fa fa-check"></i><?php echo JText::_('MOD_EXERCISE_TEXT_OKAY'); ?></a>
    </div>
</div>


       

        

<script>
    var $ = [];
    var mainObject = {
        exercise_id: <?php echo $exercise_form['exercise']->exercise_id; ?>,
        question_list: <?php echo $exercise_form['exercise']->question_list; ?>
    };
    var changed = false;
    
    
    var button_save = false;
    
    var current_dropdowns = [];
    
    jQuery(document).ready(function(){
        $ = jQuery;
        initControls();
    });
    function initControls(){
        $("textarea, input").change(function(e) {
            if(e.target.id == 'search-input'){
                return;
            }
            changed = true;
            var data={
                value: e.target.value,
                question_id: $(e.target).attr('data-question_id'),
                column: $(e.target).attr('data-column'),
                answer_id: $(e.target).attr('data-answer_id'),
                item_id: $(e.target).attr('data-item_id'),
                item_type: $(e.target).attr('data-item_type')
            };
            console.log(e.target);
            if(e.target.type == 'checkbox'){
                data.value = e.target.checked;
            }
            autoGrow(e.target);
            updateWordObject(data);
        });
        $('button.save').click(function(e){
            button_save = true;
            saveChanges();
        });
    }
    
    
   
    
    function goBack(){
        window.history.back();
    }
    
    function saveChanges(){
        var validated = validate(mainObject);
        if(validated.error !== ''){
            renderMsg(validated.error);
            return;
        }
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=exercise_form&method=confirm&format=json",
            type: "POST",
            data: {exercise: validated.validated_object},
            success: function (response){
                //renderSuccessMsg();
                var url = window.location.href.split(/[?#]/)[0];
                if(url.indexOf("&exercise_id=") < 0){
                    url = window.location.href+'&exercise_id='+mainObject.exercise_id+'action=confirm';
                }     
                //location.replace(url); 
            }
        });
    }
    
    function validate(exercise){
        var result = {
            validated_object: exercise,
            error: ''
        };
        return result;
    }
    
    function addElement(data){
        var parent_id = data.question_id;
        if(data.item_type == 'answervalue'){
            parent_id = data.answer_id;
        }
        data.new_id = getRandomId();
        var empty_element_class = '#'+data.item_type+'-empty .'+data.item_type+'-block';
        var empty_element = prepareEmptyDOM(empty_element_class, data);
        addToWordObject(data);
        $(".exercise-manager-edit ." + data.item_type + '-list.' + data.item_type + 's-' + parent_id).append(empty_element);
    }
    
    function deleteElement(e, data){
        data.item_id = $(e.target).parent().data('item_id');
        $(e.target).parent().remove();
        deleteFromWordObject(data);
    }
    
        
    function prepareEmptyDOM(emptyDomClassName, data){
        var question_id = data.question_id;
        var answer_id = data.answer_id;
        
        if(data.item_type == 'question'){
            question_id = data.new_id;
        }  
        if(data.item_type == 'answer'){
            answer_id = data.new_id;
        }
        $(emptyDomClassName).attr("data-item_id", data.new_id);
        
        $(emptyDomClassName+' .button').attr("data-question_id", question_id);
        $(emptyDomClassName+' .button').attr("data-answer_id", answer_id);
        
        $(emptyDomClassName+' input').attr("data-question_id", question_id);
        $(emptyDomClassName+' input').attr("data-item_id", data.new_id);
        $(emptyDomClassName+' input').attr("data-answer_id", answer_id);
        
        $(emptyDomClassName+' textarea').attr("data-question_id", question_id);
        $(emptyDomClassName+' textarea').attr("data-item_id", data.new_id);
        $(emptyDomClassName+' textarea').attr("data-answer_id", answer_id);
        
        $(emptyDomClassName+' select').attr("data-question_id", question_id);
        $(emptyDomClassName+' select').attr("data-item_id", data.new_id);
        $(emptyDomClassName+' select').attr("data-answer_id", answer_id);
        
        $(emptyDomClassName+' .answer-list').addClass("answers-"+data.new_id);
        $(emptyDomClassName+' .questionvalue-list').addClass("questionvalues-"+data.new_id);
        $(emptyDomClassName+' .answervalue-list').addClass("answervalues-"+data.new_id);
        return $(emptyDomClassName).clone( true );
    }    
    
    function prepareObject(data){
        var empty_objects = {
           
        };
        
        var empty_object = empty_objects['empty_'+data.item_type];
        empty_object[data.item_type + '_id'] = data.new_id;
        return empty_object;
    }    
  
    
    function updateWordObject(data){
        console.log(data);
        if(data.item_type == 'question'){
            mainObject.question_list[data.question_id][data.column] = data.value;
        } else if(data.item_type == 'answer' || data.item_type == 'questionvalue'){
            mainObject.question_list[data.question_id][data.item_type+'s'][data.item_id][data.column] = data.value;
        } else {
            mainObject.question_list[data.question_id]['answers'][data.answer_id][data.item_type+'s'][data.item_id][data.column] = data.value;
        }
    }
    
    function addToWordObject(data){
        var object = prepareObject(data);
        if(data.item_type == 'question'){
            mainObject.question_list[data.new_id] = object;
        } else if(data.item_type == 'answer' || data.item_type == 'questionvalue'){
            if(!mainObject.question_list[data.question_id].hasOwnProperty(data.item_type+'s')){
                mainObject.question_list[data.question_id][data.item_type+'s'] = {};
            }
            mainObject.question_list[data.question_id][data.item_type+'s'][data.new_id] = object;
        } else {
            mainObject.question_list[data.question_id]['answers'][data.answer_id][data.item_type+'s'][data.new_id] = object;
        }
    }
    
    function deleteFromWordObject(data){
        if(data.item_type == 'question'){
            delete mainObject.question_list[data.item_id];
        } else if(data.item_type == 'answer' || data.item_type == 'questionvalue'){
            delete mainObject.question_list[data.question_id][data.item_type+'s'][data.item_id];
        } else {
            delete mainObject.question_list[data.question_id]['answers'][data.answer_id][data.item_type+'s'][data.item_id];
        }
    }
        
    function linkArticle(article_id){
        mainObject.article_id = article_id;
    }
        
    function getRandomId(){
        return 'DIY'+Math.floor(Math.random() * 100000);
    }
    
    function renderMsg(msg){
        
        $('.message-container .message').html(msg);
        return;
    }
    function autoGrow(element) {
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }
    
</script>