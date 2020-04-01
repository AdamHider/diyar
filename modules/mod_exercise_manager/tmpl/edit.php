<?php 
defined('_JEXEC') or die; 
$active_language = JFactory::getLanguage()->get('tag');

?>

<div class="exercise-manager-edit">
    <div class="action-block">
        <button class="button button-mini  back" onclick="window.history.back()"><i class="fa fa-arrow-left"></i><?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_BACK'); ?></button>
        <button class="button button-mini save"><i class="fa fa-check"></i><?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_SAVE'); ?></button>
    </div>
    <div class="message-container">
        <div class="message"></div>
    </div>
    <div class='info-row'>
        <div class="exercise_head">
            <div class="exercise-article-block">
                <label>Lesson</label>
                <div class="article_input">
                    <?php 
                        $autocomplete_config = [
                            'module_name' => 'exercise_manager',
                            'get_data_method_name' => 'getArticle',
                            'input_value_to_render' => $exercise_manager['article']['title'],
                            'input_placeholder' => JText::_('MOD_EXERCISE_MANAGER_TEXT_ARTICLE_PLACEHOLDER'),
                            'click_action_method_name' => 'linkArticle'
                        ];
                        include 'autocomplete.php';    
                    ?>
                </div>
            </div>
            <div class="exercise-misc-block">
                <div class="exercis-misc-column">
                    <label><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_DIFFICULTY'); ?></label>
                    <select id="exercise_difficulty" value="<?php echo $exercise_manager['exercise']->exercise_difficulty; ?>">
                        <option value="1" <?php if($exercise_manager['exercise']->exercise_difficulty == 1){ echo 'selected="selected"';}; ?>><?php  echo JText::_('MOD_EXERCISE_MANAGER_DIFFICULTY_TEXT_1'); ?></option>
                        <option value="2" <?php if($exercise_manager['exercise']->exercise_difficulty == 2){ echo 'selected="selected"';}; ?>><?php  echo JText::_('MOD_EXERCISE_MANAGER_DIFFICULTY_TEXT_2'); ?></option>
                        <option value="3" <?php if($exercise_manager['exercise']->exercise_difficulty == 3){ echo 'selected="selected"';}; ?>><?php  echo JText::_('MOD_EXERCISE_MANAGER_DIFFICULTY_TEXT_3'); ?></option>
                        <option value="4" <?php if($exercise_manager['exercise']->exercise_difficulty == 4){ echo 'selected="selected"';}; ?>><?php  echo JText::_('MOD_EXERCISE_MANAGER_DIFFICULTY_TEXT_4'); ?></option>
                        <option value="5" <?php if($exercise_manager['exercise']->exercise_difficulty == 5){ echo 'selected="selected"';}; ?>><?php  echo JText::_('MOD_EXERCISE_MANAGER_DIFFICULTY_TEXT_5'); ?></option>
                    </select>
                </div>
                <div class="exercis-misc-column">
                    <label><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_STATUS'); ?></label>
                    <select id="exercise_status" value="<?php echo $exercise_manager['exercise']->status; ?>">
                        <option value="0" <?php if($exercise_manager['exercise']->status == 0){ echo 'selected="selected"';}; ?>><?php  echo JText::_('MOD_EXERCISE_MANAGER_STATUS_0'); ?></option>
                        <option value="1" <?php if($exercise_manager['exercise']->status == 1){ echo 'selected="selected"';}; ?>><?php  echo JText::_('MOD_EXERCISE_MANAGER_STATUS_1'); ?></option>
                    </select>
                </div>
                <div class="exercis-misc-column">
                    <label><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_GROUP'); ?></label>
                    <select id="exercise_is_basic" value="<?php echo $exercise_manager['exercise']->is_basic; ?>">
                        <option value="0" <?php if($exercise_manager['exercise']->is_basic == 0){ echo 'selected="selected"';}; ?>><?php  echo JText::_('MOD_EXERCISE_MANAGER_SUPERIORITY_0'); ?></option>
                        <option value="1" <?php if($exercise_manager['exercise']->is_basic == 1){ echo 'selected="selected"';}; ?>><?php  echo JText::_('MOD_EXERCISE_MANAGER_SUPERIORITY_1'); ?></option>
                    </select>
                </div>
            </div>
            <div class="headvalue-panel">
                <div class="headvalue-list headvalues-head">
                    <?php if($exercise_manager['exercise']->exercise_head && $exercise_manager['exercise']->exercise_head !== '{}'){ ?> 
                    <?php  foreach(json_decode($exercise_manager['exercise']->exercise_head, false, 512, JSON_UNESCAPED_UNICODE)->headvalues as  $headvalue_id => $headvalue){   ?>
                    <div class='headvalue-block' data-item_id="<?php echo $headvalue_id; ?>">
                        <div class='headvalue-clarification'> 
                            <textarea type="text" rows="1" placeholder="<?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_HEADVALUE_PLACEHOLDER'); ?>" value="<?php echo $headvalue->value; ?>" 
                                data-column="value"
                                data-item_type="headvalue"
                                data-question_id="head"
                            ><?php echo $headvalue->value; ?></textarea>
                            <select class="language-select"
                                        data-column="language"
                                        data-item_type="headvalue"
                                        data-question_id="head"
                                        data-item_id="<?php echo $headvalue_id; ?>"
                            >
                                <?php foreach ($exercise_manager['language_list'] as $language){ ?>
                                <option value="<?php echo $language; ?>" 
                                    <?php if($language == $headvalue->language){echo 'selected="selected"';} ?> 
                                        >
                                    <?php echo $language; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>    
                        <button class="button button-mini button-negative delete-headvalue"
                                data-action="delete" 
                                data-item_type="headvalue"
                                data-item_id="<?php echo $headvalue_id; ?>"
                                data-question_id="head">
                            <i class="fa fa-close"></i>
                        </button>
                    </div> 
                    <?php  }} ?> 
                </div> 
                <button class="button button-mini button-add add-headvalue"
                         data-action="add" 
                         data-item_type="headvalue"
                        data-question_id="head">
                        <i class="fa fa-plus"></i> <?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_ADD_VALUE'); ?>
                </button> 
            </div>
        </div>
        <div class='question-list questions-question'>    
            <?php  if(isset($exercise_manager['exercise'])){ ?>
            <?php  foreach(json_decode($exercise_manager['exercise']->question_list, false, 512, JSON_UNESCAPED_UNICODE) as  $question_id => $question){  ?>
                <div class='question-block' data-item_id="<?php echo $question_id; ?>">
                    <button class="button button-mini button-negative delete-question"
                            data-action="delete" 
                            data-item_type="question"
                            data-question_id="<?php echo $question_id; ?>">
                        <i class="fa fa-close"></i>
                    </button>
                    <select class="hardness-select"
                                data-column="hardness"
                                data-item_type="question"
                                data-question_id="<?php echo $question_id; ?>"
                    >
                        <option value="1" <?php  if($question->hardness == '1'){ echo 'selected="true"';} ?> ><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_EASY_QUESTION'); ?></option>
                        <option value="2" <?php  if($question->hardness == '2'){ echo 'selected="true"';} ?>><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_HARD_QUESTION'); ?></option>
                        <option value="3" <?php  if($question->hardness == '3'){ echo 'selected="true"';} ?>><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_VERY_HARD_QUESTION'); ?></option>
                    </select>
                    <div class="questionvalue-panel">
                        <div class="questionvalue-list questionvalues-<?php echo $question_id; ?>">
                        <?php if(!empty($question->questionvalues)){ 
                            foreach ($question->questionvalues as $questionvalue_id => $questionvalue){ 
                                if(!empty($questionvalue)){  ?> 
                                    <div class='questionvalue-block' data-item_id="<?php echo $questionvalue_id; ?>">
                                        <div class='questionvalue-clarification'> 
                                            <textarea type="text" rows="1" placeholder="<?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_QUESTIONVALUE_PLACEHOLDER'); ?>" value="<?php echo $questionvalue->value; ?>" 
                                                data-column="value"
                                                data-item_type="questionvalue"
                                                data-item_id="<?php echo $questionvalue_id; ?>"
                                                data-question_id="<?php echo $question_id; ?>"
                                            ><?php echo $questionvalue->value; ?></textarea>
                                            <select class="language-select"
                                                        data-column="language"
                                                        data-item_id="<?php echo $questionvalue_id; ?>"
                                                        data-item_type="questionvalue"
                                                        data-question_id="<?php echo $question_id; ?>"
                                            >
                                                <?php foreach ($exercise_manager['language_list'] as $language){ ?>
                                                <option value="<?php echo $language; ?>" 
                                                    <?php if($language == $questionvalue->language){echo 'selected="selected"';} ?> 
                                                        >
                                                    <?php echo $language; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>    
                                        <button class="button button-mini button-negative delete-questionvalue"
                                                data-action="delete" 
                                                data-item_type="questionvalue"
                                                data-question_id="<?php echo $question_id; ?>"
                                                data-value_id="0"
                                                data-answer_id="0">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </div> 

                        <?php  } 
                            } 
                        }?> 
                        </div>      
                        <button class="button button-mini button-add add-questionvalue"
                             data-action="add" 
                             data-item_type="questionvalue"
                             data-question_id="<?php echo $question_id; ?>"
                             >
                            <i class="fa fa-plus"></i> <?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_ADD_VALUE'); ?>
                        </button> 
                    </div> 
                    <div class="answer-panel">
                        <div class="answer-list answers-<?php echo $question_id; ?>">
                        <?php if(!empty($question->answers)){ 
                            foreach ($question->answers as $answer_id => $answer){ 
                                if(!empty($answer)){  ?> 
                                <div class='answer-block' data-item_id="<?php echo $answer_id; ?>"> 
                                    <button class="button button-mini button-negative delete-answer"
                                            data-action="delete" 
                                            data-item_type="answer"
                                            data-question_id="<?php echo $question_id; ?>"
                                            data-answer_id="<?php echo $answer_id; ?>">
                                        <i class="fa fa-close"></i>
                                    </button>
                                    <div class="correct">
                                            <label>Correct answer</label>
                                            <input type="checkbox" 
                                                <?php if($answer->correct !== 'false'){
                                                    echo 'checked=""';
                                                } ?>
                                                data-column="correct"
                                                data-item_type="answer"
                                                data-item_id="<?php echo $answer_id; ?>"
                                                data-question_id="<?php echo $question_id; ?>"
                                                data-answer_id="<?php echo $answer_id; ?>">
                                        </div>
                                    <div class="answervalue-panel">
                                        <div class="answervalue-list answervalues-<?php echo $answer_id; ?>">
                                        <?php if(!empty($answer->answervalues)){ 
                                            foreach ($answer->answervalues as $answervalue_id => $answervalue){ 
                                                if(!empty($answervalue)){  ?> 
                                                <div class='answervalue-block' data-item_id="<?php echo $answer_id; ?>">
                                                    <div class='answervalue-clarification'> 
                                                        <textarea type="text" rows="1"  placeholder="<?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_ANSWERVALUE_PLACEHOLDER'); ?>" value="<?php echo $answervalue->value; ?>" 
                                                            data-column="value"
                                                            data-item_type="answervalue"
                                                            data-item_id="<?php echo $answervalue_id; ?>"
                                                            data-question_id="<?php echo $question_id; ?>"
                                                            data-answer_id="<?php echo $answer_id; ?>"
                                                            data-answervalue_id="<?php echo $answervalue_id; ?>"
                                                        ><?php echo $answervalue->value; ?></textarea>
                                                        <select class="language-select"
                                                                    data-column="language"
                                                                    data-item_type="answervalue"
                                                                    data-item_id="<?php echo $answervalue_id; ?>"
                                                                    data-question_id="<?php echo $question_id; ?>"
                                                                    data-answer_id="<?php echo $answer_id; ?>"
                                                                    data-answervaluelanguage_id="<?php echo $answer_id; ?>"
                                                        >
                                                            <?php foreach ($exercise_manager['language_list'] as $language){ ?>
                                                            <option value="<?php echo $language; ?>" 
                                                                <?php if($language == $answervalue->language){echo 'selected="selected"';} ?> 
                                                                    >
                                                                <?php echo $language; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>   
                                                    <button class="button button-mini button-negative delete-answervalue"
                                                            data-action="delete" 
                                                            data-item_type="answervalue"
                                                            data-item_id="<?php echo $answervalue_id; ?>"
                                                            data-question_id="<?php echo $question_id; ?>"
                                                            data-answer_id="<?php echo $answer_id; ?>"
                                                            data-answervalue_id="<?php echo $answervalue_id; ?>">
                                                        <i class="fa fa-close"></i>
                                                    </button>
                                                </div>     

                                        <?php  } 
                                            } 
                                        }?> 
                                        </div>      
                                        <button class="button button-mini button-add add-answervalue"
                                             data-action="add" 
                                             data-item_type="answervalue"
                                             data-question_id="<?php echo $question_id; ?>"
                                             data-answer_id="<?php echo $answer_id; ?>">
                                            <i class="fa fa-plus"></i> <?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_ADD_VALUE'); ?>
                                        </button> 
                                    </div> 
                                </div> 
                        <?php  } } }?> 
                            </div>
                            <button class="button button-mini button-add add-answer"
                                data-action="add" 
                                data-item_type="answer"
                                data-question_id="<?php echo $question_id; ?>"
                                data-answer_id="0">
                               <i class="fa fa-plus"></i> <?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_ADD_ANSWER'); ?>
                            </button> 
                    </div>
                </div>
            <?php  } ?>     
             <?php  } ?>  
            </div>   
            <div id="add-new-question">
                <button class="button button-mini button-add add-question"
                            data-action="add" 
                            data-item_type="question" 
                            data-question_id="question">
                    <i class="fa fa-plus"></i><?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_ADD_QUESTION'); ?></button>  
             </div>
        </div>
        
    
    <div class="action-block">
        <button class="button button-mini  back" onclick="goBack()"><i class="fa fa-arrow-left"></i><?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_BACK'); ?></button>
        <button class="button button-mini  save"><i class="fa fa-check"></i><?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_SAVE'); ?></button>
    </div>
</div>


        <div id="question-empty" class='empty-block'>
            <div class='question-block' data-item_id="0">
                <button class="button button-mini button-negative delete-question"
                        data-action="delete" 
                        data-item_type="question"
                        data-question_id="0">
                    <i class="fa fa-close"></i>
                </button>
                <select class="hardness-select"
                            data-column="hardness"
                            data-item_type="question"
                            data-question_id="0"
                >
                    <option value="1"><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_EASY_QUESTION'); ?></option>
                    <option value="2"><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_HARD_QUESTION'); ?></option>
                    <option value="3"><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_VERY_HARD_QUESTION'); ?></option>
                </select>
                <div class="questionvalue-panel">
                    <div class="questionvalue-list">
                    </div>      
                    <button class="button button-mini button-add add-questionvalue"
                         data-action="add" 
                         data-item_type="questionvalue"
                         data-question_id="0"
                         data-answer_id="0">
                        <i class="fa fa-plus"></i> <?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_ADD_VALUE'); ?>
                    </button> 
                </div> 
                <div class="answer-panel">
                    <div class="answer-list">
                    </div>      
                    <button class="button button-mini button-add add-answer"
                         data-action="add" 
                         data-item_type="answer"
                         data-question_id="0"
                         data-answer_id="0">
                        <i class="fa fa-plus"></i> <?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_ADD_ANSWER'); ?>
                    </button> 
                </div>
            </div> 
        </div>

        <div id='answer-empty' class='empty-block'>  
            <div class='answer-block' data-item_id="0">
                <button class="button button-mini button-negative delete-answer"
                        data-action="delete" 
                        data-item_type="answer"
                        data-question_id="0"
                        data-answer_id="0">
                    <i class="fa fa-close"></i>
                </button>
                <div class="correct">
                    <label><?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_CORRECT_ANSWER'); ?></label>
                    <input type="checkbox" name="gender" value="true" 
                        data-column="correct"
                        data-item_type="answer"
                        data-question_id="0"
                        data-answer_id="0">
                </div>
                <div class="answervalue-panel">
                    <div class="answervalue-list">
                    </div>      
                    <button class="button button-mini button-add add-answervalue"
                         data-action="add" 
                         data-item_type="answervalue"
                         data-question_id="0"
                         data-answer_id="0">
                        <i class="fa fa-plus"></i> <?php  echo JText::_('MOD_EXERCISE_MANAGER_BUTTON_ADD_VALUE'); ?>
                    </button> 
                </div>
            </div> 
        </div>
        <div id='headvalue-empty' class='empty-block'>  
            <div class='headvalue-block' data-item_id="0">
                <div class='headvalue-clarification'> 
                    <textarea type="text" rows="1" placeholder="<?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_HEADVALUE_PLACEHOLDER'); ?>" value="" 
                        data-column="value"
                        data-item_type="headvalue"
                        data-question_id="head"
                    ></textarea>
                    <select class="language-select"
                                data-column="language"
                                data-item_type="headvalue"
                                data-question_id="head"
                    >
                        <?php foreach ($exercise_manager['language_list'] as $language){ ?>
                        <option value="<?php echo $language; ?>" 
                            <?php if($language == 'en-EN'){echo 'selected="selected"';} ?> 
                                >
                            <?php echo $language; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>    
                <button class="button button-mini button-negative delete-headvalue"
                        data-action="delete" 
                        data-item_type="headvalue"
                        data-question_id="head">
                    <i class="fa fa-close"></i>
                </button>
            </div> 
        </div>
        <div id='questionvalue-empty' class='empty-block'>  
            <div class='questionvalue-block' data-item_id="0">
                <div class='questionvalue-clarification'> 
                    <textarea type="text" rows="1" placeholder="<?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_QUESTIONVALUE_PLACEHOLDER'); ?>" value="" 
                        data-column="value"
                        data-item_type="questionvalue"
                        data-question_id="0"
                        data-answer_id="0"
                    ></textarea>
                    <select class="language-select"
                                data-column="language"
                                data-item_type="questionvalue"
                                data-question_id="0"
                    >
                        <?php foreach ($exercise_manager['language_list'] as $language){ ?>
                        <option value="<?php echo $language; ?>" 
                            <?php if($language == 'en-EN'){echo 'selected="selected"';} ?> 
                                >
                            <?php echo $language; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>    
                <button class="button button-mini button-negative delete-questionvalue"
                        data-action="delete" 
                        data-item_type="questionvalue"
                        data-question_id="0"
                        data-answer_id="0">
                    <i class="fa fa-close"></i>
                </button>
            </div> 
        </div>
        <div id='answervalue-empty' class='empty-block'>  
            <div class='answervalue-block' data-item_id="0">
                <div class='answervalue-clarification'> 
                    <textarea type="text" rows="1"  placeholder="<?php  echo JText::_('MOD_EXERCISE_MANAGER_TEXT_ANSWERVALUE_PLACEHOLDER'); ?>" value="" 
                        data-column="value"
                        data-item_type="answervalue"
                        data-question_id="0"
                        data-answer_id="0"
                        data-answervalue_id="0"
                    ></textarea>
                    <select class="language-select"
                                data-column="language"
                                data-item_type="answervalue"
                                data-question_id="0"
                                data-answer_id="0"
                                data-answervaluelanguage_id="0"
                    >
                        <?php foreach ($exercise_manager['language_list'] as $language){ ?>
                        <option value="<?php echo $language; ?>" 
                            <?php if($language == 1){echo 'selected="selected"';} ?> 
                                >
                            <?php echo $language; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>   
                <button class="button button-mini button-negative delete-answervalue"
                        data-action="delete" 
                        data-item_type="answervalue"
                        data-question_id="0"
                        data-answer_id="0">
                    <i class="fa fa-close"></i>
                </button>
            </div> 
        </div>
        

        

<script>
    var $ = [];
    var mainObject = {
        exercise_id: <?php echo $exercise_manager['exercise']->exercise_id; ?>,
        article_id: '<?php  echo $exercise_manager['article']['id'] ?>',
        exercise_difficulty: '<?php  echo $exercise_manager['exercise']->exercise_difficulty ?>',
        status: '<?php  echo $exercise_manager['exercise']->exercise_difficulty ?>',
        is_basic: '<?php  echo $exercise_manager['exercise']->exercise_difficulty ?>',
        exercise_head: <?php if($exercise_manager['exercise']->exercise_head !== '{}'){ echo $exercise_manager['exercise']->exercise_head; } else { echo '{ headvalues: {}}';} ?>,
        question_list: <?php echo $exercise_manager['exercise']->question_list; ?>
    };
    var changed = false;
    
    var checkboxes = {};
    
    var button_save = false;
    
    var question_quantity = 0;
    
    var current_dropdowns = [];
    
    var language_number =  <?php echo count($exercise_manager['language_list']); ?>; 
    
    jQuery(document).ready(function(){
        $ = jQuery;
        initControls();
    });
    function initControls(){
        $( ".button" ).click(function(e) {
            if(e.target.className === 'fa fa-close'){
                e.target = $(e.target).parent();
            }    
            var data = {
                action: $(e.target).attr('data-action'),
                question_id: $(e.target).attr('data-question_id'),
                answer_id: $(e.target).attr('data-answer_id'),
                item_type: $(e.target).attr('data-item_type')
            };
            
            if(data.action == 'add'){
                changed = true; 
                addElement(data);
            }
            if(data.action == 'delete'){
                changed = true;
                deleteElement(e, data);
            }
        });
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
            if(e.target.type == 'checkbox'){
                data.value = e.target.checked;
                checkMulticorrectness(data);
            }
            autoGrow(e.target);
            updateWordObject(data);
        });
        $("select").change(function(e) {
            changed = true;
            var data={
                value: e.target.value,
                question_id: $(e.target).attr('data-question_id'),
                column: $(e.target).attr('data-column'),
                answer_id: $(e.target).attr('data-answer_id'),
                item_id: $(e.target).attr('data-item_id'),
                item_type: $(e.target).attr('data-item_type')
            };
            if(e.target.id == 'exercise_difficulty'){
                mainObject.exercise_difficulty = data.value;
                return;
            } else if(e.target.id == 'exercise_status'){
                mainObject.status = data.value;
                return;
            } else if (e.target.id == 'exercise_is_basic'){
                mainObject.is_basic = data.value;
                return;
            } 
            if(!calculateLanguageDropdowns(data)){
                return;
            };
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
                return "<?php  echo JText::_('MOD_EXERCISE_MANAGER_WARNING_CONFIRM_RELOAD'); ?>";
            }
             
        };
    }
    
    var current_possible_language = 'ru-RU';
    
    function calculateLanguageDropdowns(data){
        var main_languages = JSON.parse('<?php echo json_encode($exercise_manager['language_list']); ?>');
        if(data.item_type == 'headvalue'){ 
            var item_id = 'head';
            var item_type = 'head';
            var button_path = ".exercise-manager-edit .headvalue-panel";
        }else if(data.item_type == 'answervalue'){ 
            var item_id = data.answer_id;
            var item_type = 'answer';
            var button_path = ".exercise-manager-edit ."+item_type+"-block[data-item_id='"+item_id+"'] .answervalue-panel";
        }else if(data.item_type == 'questionvalue'){
            var item_id = data.question_id;
            var item_type = 'question';
            var button_path = ".exercise-manager-edit ."+item_type+"-block[data-item_id='"+item_id+"'] .questionvalue-panel";
        }else{
            return true;
        }
        current_dropdowns = [];
        $(button_path+' .language-select').each(function(e){
            delete main_languages[main_languages.indexOf(this.value)];
            var possible_language = getPossibleLang(main_languages);
            if(main_languages.length == current_dropdowns.length+1){
                $(button_path+" .add-"+item_type+"value").css('visibility', 'hidden');
            } else {
                $(button_path+" .add-"+item_type+"value").css('visibility', 'visible');
            }
            if(current_dropdowns.indexOf(this.value) > -1){
                renderMsg('language_duplicate!');
                $(this).val(possible_language);
                current_possible_language = possible_language;
                return false;
            }
            current_dropdowns.push(this.value);
        })
        return true;
    }
    
    function getPossibleLang(language_list){
        for(var i = 0; i < language_list.length; i++){
            if(language_list[i] !== undefined){
                return language_list[i]
            }
        }
    }
    // THIS PART IS TOO FUCKING DIFFICULT TO UNDERSTAND
    function checkMulticorrectness(node_data){
        if(!checkboxes.hasOwnProperty(node_data.question_id)){
            checkboxes[node_data.question_id] = [];
        }
        var selfUncheckedIndex = selfUnchecked(checkboxes[node_data.question_id], node_data.item_id);
        if(selfUncheckedIndex > -1){
            //Check if is the last checkbox within the answer checked
            //If it is prevent unchecking
            if(checkboxes[node_data.question_id] === 1){
                return;
            }
            zerolizeAnswerCorrectness(checkboxes[node_data.question_id][selfUncheckedIndex]);
            checkboxes[node_data.question_id].splice(selfUncheckedIndex, 1);
            return;
        }  
        if( checkboxes[node_data.question_id].length === 0){
            checkboxes[node_data.question_id].push({question_id: node_data.question_id, answer_id: node_data.item_id});
            return;
        } 
        zerolizeAnswerCorrectness(checkboxes[node_data.question_id][0]);
        checkboxes[node_data.question_id] = [{question_id: node_data.question_id, answer_id: node_data.item_id}];
    }
    
    function zerolizeAnswerCorrectness(correctness_object){
        mainObject.question_list[correctness_object.question_id]['answers'][correctness_object.answer_id].correct = 'false';
        $(".answers-"+correctness_object.question_id+" .answer-block[data-item_id='"+correctness_object.answer_id+"'] input[type='checkbox']").prop('checked', false);
    }
    function selfUnchecked(prev_checkboxes, answer_id ){
        for(var i = 0; i < prev_checkboxes.length; i++){
            if(prev_checkboxes[i].answer_id == answer_id ){
                return i;
            }
        }
        return -1;
    }
    function goBack(){
        window.history.back();
    }
    
    function saveChanges(){
        var validated = validateMainObject();
        if(validated.error !== ''){
            renderMsg(validated.error);
            return;
        }
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=exercise_manager&method=saveChanges&format=json",
            type: "POST",
            data: {exercise: validated.validated_object},
            success: function (response){
                //renderSuccessMsg();
                var url = window.location.href;
                if(url.indexOf("&exercise_id=") < 0){
                    url = window.location.href+'&exercise_id='+mainObject.exercise_id;
                }     
                location.replace(url); 
            }
        });
    }
    
    function validateMainObject(){
        var result = {
            validated_object: mainObject,
            error: ''
        };
        if(!validateEmptyCheckboxes()){
            result.error += '<?php  echo JText::_('MOD_EXERCISE_MANAGER_WARNING_ADD_CORRECT'); ?></br>';
            return result;
        }
        if(!difficultyForQuestionQuantity()){
            result.error += '<?php  echo JText::_('MOD_EXERCISE_MANAGER_WARNING_DIFFICULTY_CHANGE'); ?></br>';
            return result;
        }
        if(!mainObject.article_id){
            result.error += '<?php  echo JText::_('MOD_EXERCISE_MANAGER_WARNING_NO_ARTICLE'); ?></br>';
        }
        if(Object.keys(mainObject.question_list).length == 0){
            result.error += '<?php  echo JText::_('MOD_EXERCISE_MANAGER_WARNING_NO_QUESTIONS'); ?></br>';
        }
        return result;
    }
    
    function difficultyForQuestionQuantity(){
        var question_quantity = Object.keys(mainObject.question_list).length;
        if(
            (question_quantity < 10 && mainObject.exercise_difficulty > 1) ||
            (question_quantity >= 15 && mainObject.exercise_difficulty > 2) ||
            (question_quantity >= 25 && mainObject.exercise_difficulty > 3) ||
            (question_quantity >= 30 && mainObject.exercise_difficulty > 4) ||
            (question_quantity < 50 && mainObject.exercise_difficulty == 5)    
        ){
            return false;
        }
        return true;
    }
    
    function validateEmptyCheckboxes(){
        var questions_array = Object.keys(mainObject.question_list);
        return true;
    }
    
    function addElement(data){
        var parent_id = data.question_id;
        if(data.item_type == 'answervalue'){
            parent_id = data.answer_id;
        }
        data.new_id = getRandomId(data.item_type);
        var empty_element_class = '#'+data.item_type+'-empty .'+data.item_type+'-block';
        var empty_element = prepareEmptyDOM(empty_element_class, data);
        $(".exercise-manager-edit ." + data.item_type + '-list.' + data.item_type + 's-' + parent_id).append(empty_element);
        calculateLanguageDropdowns(data);
        addToWordObject(data);
    }
    
    function deleteElement(e, data){
        data.item_id = $(e.target).parent().data('item_id');
        $(e.target).parent().remove();
        calculateLanguageDropdowns(data)
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
        $(emptyDomClassName+' .questionvalue-list').removeClass().addClass("questionvalue-list questionvalues-"+question_id);
        $(emptyDomClassName+' .answervalue-list').removeClass().addClass("answervalue-list answervalues-"+answer_id);
        return $(emptyDomClassName).clone( true );
    }    
    
    function prepareObject(data){
        var empty_objects = {
            empty_question : {
                answers: {},
                questionvalues: {},
                question_id: 0,
                hardness: 1
            },
            empty_answer : {
                answer_id: 0,
                correct: false,
                answervalues: {}
            },
            empty_questionvalue : {
                language: current_possible_language,
                question_id: 0,
                value: ''
            },
            empty_answervalue : {
                language: current_possible_language,
                question_id: 0,
                answer_id: 0,
                value: ''
            },
            empty_headvalue : {
                language: current_possible_language,
                value: ''
            }
        };
        var empty_object = empty_objects['empty_'+data.item_type];
        empty_object[data.item_type + '_id'] = data.new_id;
        return empty_object;
    }    
  
    
    function updateWordObject(data){
        if(data.item_type == 'headvalue'){
            mainObject.exercise_head.headvalues[data.item_id][data.column] = data.value;
        } else if(data.item_type == 'question'){
            mainObject.question_list[data.question_id][data.column] = data.value;
        } else if(data.item_type == 'answer' || data.item_type == 'questionvalue'){
            mainObject.question_list[data.question_id][data.item_type+'s'][data.item_id][data.column] = data.value;
        } else {
            mainObject.question_list[data.question_id]['answers'][data.answer_id][data.item_type+'s'][data.item_id][data.column] = data.value;
        }
    }
    
    function addToWordObject(data){
        var object = prepareObject(data);
        if(data.item_type == 'headvalue'){
            mainObject.exercise_head.headvalues[data.new_id] = object;
        } else if(data.item_type == 'question'){
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
        if(data.item_type == 'headvalue'){
            delete mainObject.exercise_head.headvalues[data.item_id];
        } else if(data.item_type == 'question'){
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
    
    var last_id = getLastId();
    function getRandomId(){
        console.log(last_id);
        last_id = last_id*1 +1;
        var new_id = 'DIY'+last_id;
        return new_id;
    }
    
    function getLastId(){
        var question_list = '{<?php  echo json_encode($exercise_manager['exercise']); ?>}';
        var pattern = /"DIY[0-9]+"/gi;
        var match = pattern.exec(question_list);
        var previous_id = 0;
        while (match = pattern.exec(question_list)){
            var id = match[0].match(/\d+/)[0];
            if(id*1 > previous_id*1){
                previous_id = id*1;
            }
        }
        if(previous_id == 0){
            return 111111111;
        } 
        return previous_id;
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