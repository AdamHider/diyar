<?php defined('_JEXEC') or die; ?>
<?php $count_questions = 0;?>

<div class="exercise-start">
    <div class="message-container">
        <div class="message"></div>
    </div>
    <div class='exercise-form'>
        <div class="exercise-title">
            <h4><?php echo JText::_('MOD_EXERCISE_FORM_TEXT_INTRO').':'; ?></h4>
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
                                if(!empty($answer)){  ?> 
                                <div class='answer-block' data-item_id="<?php echo $answer_id; ?>"> 
                                        <?php if(!empty($answer->answervalues)){ 
                                            foreach ($answer->answervalues as $answervalue_id => $answervalue){ 
                                                if(!empty($answervalue) && $answervalue->language == $exercise_form['language']){  ?> 
                                                <div class="inputGroup">
                                                    <?php 
                                                        $type = 'radio';
                                                    ?>
                                                    <input id="option<?php echo $answervalue_id; ?>" name="option<?php echo $question_id; ?>" type="<?php echo $type; ?>"
                                                            data-column="user_choice"
                                                            data-item_type="answer"
                                                            data-item_id="<?php echo $answer_id; ?>"
                                                            data-question_id="<?php echo $question_id; ?>"
                                                            data-answer_id="<?php echo $answer_id; ?>"
                                                           />
                                                    <label for="option<?php echo $answervalue_id; ?>"><?php echo $answervalue->value; ?></label>
                                                </div>
                                    
                                    
                                        <?php  } 
                                            } 
                                        }?>     
                                </div> 
                        <?php  } } }?> 
                    </div>
                </div>
            <?php  } ?>     
             <?php  } ?>  
            </div>   
        </div>
        
    
    <div class="action-block">
        <button class="button button-mini  back" onclick="goBack()"><i class="fa fa-arrow-left"></i><?php echo JText::_('MOD_EXERCISE_FORM_BUTTON_BACK'); ?></button>
        <button class="button button-mini  save"><i class="fa fa-check"></i><?php echo JText::_('MOD_EXERCISE_FORM_BUTTON_READY'); ?></button>
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
            var data = {
                value: e.target.value,
                question_id: $(e.target).attr('data-question_id'),
                column: $(e.target).attr('data-column'),
                answer_id: $(e.target).attr('data-answer_id'),
                item_id: $(e.target).attr('data-item_id'),
                item_type: $(e.target).attr('data-item_type')
            };
            if(e.target.type == 'checkbox'){
                data.value = e.target.checked;
            }
            updateWordObject(data);
        });
        $('button.save').click(function(e){
            button_save = true;
            saveChanges();
        });
        
        window.onbeforeunload = function (){
            if(!changed || button_save){
                return;
            } else {
                return "Are you sure you want to reload?";
            }
             
        };
    }
    
    function calculateLanguageDropdowns(data){
        
        $('.exercise-manager-edit .language-select').each(function(e){
            
        })
        return true;
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
                var url = [location.protocol, '//', location.host, location.pathname].join('');
                if(url.indexOf("&exercise_id=") < 0){
                    url += '?exercise_id='+mainObject.exercise_id+'&action=view';
                }     
                location.replace(url); 
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
    
    
    
    function updateWordObject(data){
        zerolizeQuestion(data.question_id);
        mainObject.question_list[data.question_id].answers[data.item_id][data.column] = data.value;
    }
    
    function zerolizeQuestion(question_id){
        var keys = Object.entries(mainObject.question_list[question_id].answers);
        for(var i = 0; i < keys.length; i++){
            var answer_id = keys[i][0];
            mainObject.question_list[question_id].answers[answer_id].user_choice = false;
        }
    }
        
    function renderMsg(msg){
        
        $('.message-container .message').html(msg);
        return;
    }
    
</script>