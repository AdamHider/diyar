<?php defined('_JEXEC') or die; ?>

<div class="lugat-manager-edit">
    <div class="action-block">
        <button class="button button-mini  back" onclick="window.history.back()"><i class="fa fa-arrow-left"></i><?php echo JText::_('MOD_LUGAT_BUTTON_BACK'); ?></button>
        <button class="button button-mini save"><i class="fa fa-check"></i><?php echo JText::_('MOD_LUGAT_BUTTON_SAVE'); ?></button>
    </div>
    <div class='info-row'>
            <div class='query-word_block'>
                <div class="query-word-row">
                    <?php if(!empty($lugat_manager['word_object']['query_object']['word'])){ ?>
                       <div class="query-word"><?php echo $lugat_manager['word_object']['query_object']['word']?>
                       </div>
                    <?php  } ?> 
                    <div class="query-word-transcription">
                        <label><?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_TRANSCRIPTION_LABEL'); ?></label>
                            <div class="label-description"><?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_TRANSCRIPTION_DESCRIPTION'); ?></div>
                        [ 
                        <input type="text"  placeholder="<?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_TRANSCRIPTION'); ?>" 
                            value="<?php echo  $lugat_manager['word_object']['query_object']['transcription'] ?>"
                            data-column="transcription"
                            data-relation_id="<?php echo $lugat_manager['word_object']['query_object']['relation_id']; ?>"
                            data-destination_type="query"
                            data-item_id="<?php echo $lugat_manager['word_object']['query_object']['relation_id']; ?>"
                            data-item_type="relation" 
                        />
                        ]
                    </div>
                </div>
                
                
            </div>
            <?php  if(isset($lugat_manager['word_object']['translations'])){ ?>

                <div class='translations-block'>
                    <div class='part-of-speech-list'>

           
                 <div class='part-of-speech-block'>
                   <div class='relation-list relations-relation'>         
            <?php  foreach($lugat_manager['word_object']['translations'] as $translation){  ?>

                
                    <div class='relation-block' data-item_id="<?php echo $translation['relation_id']; ?>">
                        <button class="button button-mini button-negative delete-relation"
                                data-action="delete" 
                                data-item_type="relation" 
                                data-destination_type="relation"
                                data-relation_id="<?php echo $translation['relation_id']; ?>">
                            <i class="fa fa-close"></i>
                        </button>
            <?php if(!empty($translation['word'])){ ?>                                          
                        <span class='relation-name'><?php echo $translation['word'] ?></span>
            <?php  } ?>            
                         <div class='relation-clarification'>
                            <label><?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_CLARIFICATION_LABEL'); ?></label>
                            <div class="label-description"><?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_CLARIFICATION_DESCRIPTION'); ?></div>
                            <input type="text" placeholder="<?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_CLARIFICATION'); ?>" 
                                    data-column="clarification"
                                    data-destination_type="relation"
                                    data-item_id="<?php echo $translation['relation_id']; ?>"
                                    data-item_type="relation"
                                    data-relation_id="<?php echo $translation['relation_id']; ?>"
                                    value="<?php echo $translation['clarification']; ?>"
                            />
                         </div>
                        <div class='relation-relevance'>
                            <label><?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_RELEVANCE_LABEL'); ?></label>
                            <div class="label-description"><?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_RELEVANCE_DESCRIPTION'); ?></div>
                            <input type="number" placeholder="<?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_RELEVANCE'); ?>" min="1" max="10"
                                    data-column="relevance"
                                    data-destination_type="relation"
                                    data-item_id="<?php echo $translation['relation_id']; ?>"
                                    data-item_type="relation"
                                    data-relation_id="<?php echo $translation['relation_id']; ?>"
                                    data-relevance_rate="<?php echo $translation['relevance']; ?>"
                                    value="<?php echo 11-ceil($translation['relevance'] * 0.9); ?>"
                            />/10
                         </div>
                        <select class="pts-select"
                                    data-relation_id="<?php echo $translation['relation_id']; ?>"
                                    data-item_id="<?php echo $translation['relation_id']; ?>"
                                    data-column="part_of_speech_id"
                                    data-destination_type="relation"
                                    data-item_type="relation"
                        >
                            <?php foreach ($lugat_manager['parts_of_speech'] as $part_of_speech){ ?>
                            <option value="<?php echo $part_of_speech['part_of_speech_id']; ?>" 
                                <?php if($part_of_speech['part_of_speech_id'] == $translation['part_of_speech_id']){echo 'selected="selected"';} ?> 
                                    >
                                <?php echo $part_of_speech['part_of_speech_name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                        <div class="attribute-panel">
                            <div class="attribute-list attributes-<?php echo $translation['relation_id']; ?>">
                <?php if(!empty($translation['attributes'])){ 
                    foreach ($translation['attributes'] as $attribute){ 
                            if(!empty($attribute)){  ?> 
                                <div class='attribute-block' data-item_id="<?php echo $attribute['attribute_id']; ?>">
                                    <select class="attribute-select" 
                                            data-relation_id="<?php echo $translation['relation_id']; ?>"
                                            data-column="attribute_id"
                                            data-item_type="attribute" 
                                            data-destination_type="relation"
                                            data-item_id="<?php echo $attribute['attribute_id']; ?>"
                                    >
                                        <?php foreach ($lugat_manager['attribute_list'] as $attribute_group){ ?>
                                        <optgroup label="<?php echo $attribute_group['attribute_group_name']; ?>">
                                            <?php foreach ($attribute_group['attributes'] as $child_attribute){ ?>
                                            <option value="<?php echo $child_attribute['attribute_id']; ?>" 
                                                <?php if($child_attribute['attribute_id'] == $attribute['attribute_id']){echo 'selected="selected"';} ?> 
                                                    >
                                                <?php echo $child_attribute['attribute_name']; ?>
                                            </option>
                                            <?php } ?>
                                        </optgroup>
                                       <?php } ?>
                                    </select>
                                    <button class="button button-mini button-negative delete-attribute" 
                                            data-action="delete" 
                                            data-item_type="attribute" 
                                            data-destination_type="relation"
                                            data-item_id="<?php echo $attribute['attribute_id']; ?>"
                                            data-relation_id="<?php echo $translation['relation_id']; ?>">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </div> 
                    <?php  } } ?> 
                    <?php }?> 
                            </div>
                            <button class="button button-mini button-add add-attribute" 
                                    data-action="add" 
                                    data-item_type="attribute" 
                                    data-destination_type="relation"
                                    data-relation_id="<?php echo $translation['relation_id']; ?>">
                                <i class="fa fa-plus"></i> <?php echo JText::_('MOD_LUGAT_BUTTON_ATTRIBUTE'); ?>
                            </button> 
                        </div>
                        <div class="example-panel">
                            <div class="example-list examples-<?php echo $translation['relation_id']; ?>">
                                <?php if(!empty($translation['examples'])){ ?>    
                                <?php foreach($translation['examples'] as $example){ ?> 
                                <div class="example-block" 
                                    data-item_id="<?php echo $example['example_id']; ?>"
                                    data-related_example_relation_id="<?php echo $example['related_example_relation_id']; ?>"
                                    data-query_example_relation_id="<?php echo $example['query_example_relation_id']; ?>"
                                                 
                                >
                                    <span>
                                        <label><?php echo $lugat_manager['relation_example_label']; ?></label>
                                        <input type="text" 
                                                placeholder="<?php echo $lugat_manager['relation_example']; ?>"
                                                value="<?php echo $example['related_example'] ?>"
                                                data-column="related_example"
                                                data-destination_type="relation"
                                                data-item_type="example" 
                                                data-relation_id="<?php echo $translation['relation_id']; ?>"
                                                data-item_id="<?php echo $example['example_id']; ?>"
                                        />
                                    </span>
                                    <span>
                                    -
                                    </span>
                                    <span>
                                        <label><?php echo $lugat_manager['query_example_label']; ?></label>
                                        <input type="text" placeholder="<?php echo $lugat_manager['query_example']; ?>"
                                                value="<?php echo $example['query_example'] ?>"
                                                data-column="query_example"
                                                data-destination_type="relation"
                                                data-item_type="example" 
                                                data-relation_id="<?php echo $translation['relation_id']; ?>"
                                                data-item_id="<?php echo $example['example_id']; ?>"
                                        />
                                    </span>
                                    <button class="button button-mini button-negative delete-example" 
                                            data-action="delete" 
                                            data-item_type="example" 
                                            data-destination_type="relation"
                                            data-relation_id="<?php echo $translation['relation_id']; ?>">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </div>
                                <?php  } ?>  
                                <?php  } ?> 
                            </div>  
                            <button class="button button-mini button-add add-example"  
                                    data-action="add" 
                                    data-item_type="example" 
                                    data-destination_type="relation"
                                    data-relation_id="<?php echo $translation['relation_id']; ?>">
                                <i class="fa fa-plus"></i> <?php echo JText::_('MOD_LUGAT_BUTTON_EXAMPLE'); ?>
                            </button>
                        </div>
                    </div>
            <?php  } ?>     
                    </div> 
                     <div id="add-new-relation">
                        <div  class="autocomplete">
                            <div id="special-symbols" style="display: none">
                                <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value);" value='â'/>
                                <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value);" value='ö'/>
                                <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value);" value='ü'/>
                                <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value);" value='ı'/>
                                <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value);" value='ğ'/>
                                <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value);" value='ş'/>
                                <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value);" value='ç'/>
                                <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value);" value='ñ'/>
                            </div>
                            <input id="new-relation-input" type="text" name="new-relation-input" placeholder="<?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_WORD'); ?>" 
                                oninput="autocompleteGo(this.value)"
                                onfocus="autocompleteGo(this.value)"  value="">
                            <a id="keyboard-open" onclick="showKeyboard();"><i class="fa fa-keyboard-o"></i></a>       
                            <input type="submit" style="visibility: hidden;" />
                        </div>
                        <button class="button button-mini button-add add-relation"
                                    data-action="add" 
                                    data-item_type="relation" 
                                    data-relation_id="relation"
                                    data-destination_type="relation">
                            <i class="fa fa-plus"></i> <?php echo JText::_('MOD_LUGAT_BUTTON_TRANSLATION'); ?></button>  
                     </div>
                    </div>
                </div>
            </div>
             <?php  } ?>  
        </div>
        
    
    <div class="action-block">
        <button class="button button-mini  back" onclick="goBack()"><i class="fa fa-arrow-left"></i><?php echo JText::_('MOD_LUGAT_BUTTON_BACK'); ?></button>
        <button class="button button-mini  save"><i class="fa fa-check"></i><?php echo JText::_('MOD_LUGAT_BUTTON_SAVE'); ?></button>
    </div>
</div>


        <div id="relation-empty" class='empty-block'>
            <div class='relation-block' data-item_id="0">
                <button class="button button-mini button-negative delete-relation"
                        data-action="delete" 
                        data-item_type="relation"
                        data-destination_type="relation"
                        data-relation_id="0">
                    <i class="fa fa-close"></i>
                </button>

                <span class='relation-name'></span>      
                
                <div class='relation-clarification'>
                    <label><?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_CLARIFICATION_LABEL'); ?></label>
                            <div class="label-description"><?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_CLARIFICATION_DESCRIPTION'); ?></div>
                    <input type="text" placeholder="<?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_CLARIFICATION'); ?>" value=""
                        data-column="clarification"
                        data-item_type="relation"
                        data-destination_type="relation"
                        data-relation_id="0"
                        data-item_id="0"
                    />
                </div>
                <div class='relation-relevance'>
                    <label><?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_RELEVANCE_LABEL'); ?></label>
                            <div class="label-description"><?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_RELEVANCE_DESCRIPTION'); ?></div>
                    <input type="number" placeholder="<?php echo JText::_('MOD_LUGAT_MANAGER_ENTER_RELEVANCE'); ?>" value="5"
                            data-column="relevance"
                            data-item_type="relation"
                            data-destination_type="relation"
                            data-relation_id="0"
                            data-relevance_rate="0.988"
                            data-item_id="0"
                    />/10
                 </div>
                <select class="pts-select" 
                        data-relation_id="0"
                        data-item_type="relation"
                        data-column="part_of_speech_id"
                        data-relation_id="0"
                        data-destination_type="relation"
                >
                    <?php foreach ($lugat_manager['parts_of_speech'] as $part_of_speech){ ?>
                    <option value="<?php echo $part_of_speech['part_of_speech_id']; ?>">
                        <?php echo $part_of_speech['part_of_speech_name']; ?>
                    </option>
                    <?php } ?>
                </select>     
                <div class="attribute-panel">
                    <div class="attribute-list">
                    </div>      
                    <button class="button button-mini button-add add-attribute"
                         data-action="add" 
                         data-item_type="attribute"
                         data-destination_type="relation"
                         data-relation_id="0">
                        <i class="fa fa-plus"></i> <?php echo JText::_('MOD_LUGAT_BUTTON_ATTRIBUTE'); ?>
                    </button> 
                </div>
                <div class="example-panel">
                    <div class="example-list">
                    </div>   
                    <button class="button button-mini button-add add-example"
                        data-action="add" 
                        data-item_type="example"
                        data-destination_type="relation"
                        data-relation_id="0">
                        <i class="fa fa-plus"></i> <?php echo JText::_('MOD_LUGAT_BUTTON_EXAMPLE'); ?>
                    </button> 
                </div>
            </div> 
        </div>

        <div id='attribute-empty' class='empty-block'>  
            <div class='attribute-block' data-item_id="0">
                <select 
                        data-relation_id="0"
                        data-column="attribute_id"
                        data-item_type="attribute"
                        data-destination_type="relation"
                        data-item_id="0"
                >
                    <?php foreach ($lugat_manager['attribute_list'] as $attribute_group){ ?>
                    <optgroup label="<?php echo $attribute_group['attribute_group_name']; ?>">
                        <?php foreach ($attribute_group['attributes'] as $child_attribute){ ?>
                        <option value="<?php echo $child_attribute['attribute_id']; ?>">
                            <?php echo $child_attribute['attribute_name']; ?>
                        </option>
                        <?php } ?>
                    </optgroup>
                   <?php } ?>
                </select>
                <button class="button button-mini button-negative delete-attribute"
                        data-action="delete" 
                        data-item_type="attribute"
                        data-destination_type="relation"
                        data-relation_id="0">
                    <i class="fa fa-close"></i>
                </button>
            </div> 
            
        </div>

        <div id="example-empty" class="empty-block">
            <div  class="example-block" 
                  data-item_id="0"
                  data-query_example_relation_id="<?php echo $lugat_manager['word_object']['query_object']['relation_id']; ?>"
                  data-related_example_relation_id="0"    
                  >
                <span>
                    <label><?php echo $lugat_manager['relation_example_label']; ?></label>
                    <input type="text" placeholder="<?php echo $lugat_manager['relation_example']; ?>"
                            data-relation_id="0"
                            data-item_type="example"
                            data-column="related_example"
                            data-destination_type="relation"
                            data-item_id="0"
                    />
                </span>
                <span>
                -
                </span>
                <span>
                    <label><?php echo $lugat_manager['query_example_label']; ?></label>
                    <input type="text"  placeholder="<?php echo $lugat_manager['query_example']; ?>"
                            data-relation_id="0"
                            data-item_type="example"
                            data-column="query_example"
                            data-destination_type="relation"
                            data-item_id="0"
                    />
                </span>
                <button class="button button-mini button-negative delete-example"
                        data-action="delete" 
                        data-item_type="example"
                        data-destination_type="relation"
                        data-relation_id="0">
                    <i class="fa fa-close"></i>
                </button>
            </div>
        </div>

<script>
    var $ = [];
    var mainObject = {};
    var changed = false;
    var button_save = false;
    var empty_objects = {
        empty_relation : {
            action: "",
            attributes: [],
            clarification: "",
            examples: [],
            relation_id: '',
            relevance: 5,
            transcription: '',
            toponymy_link: null,
            word: "",
            language_id: 0,
            word_id: 0,
            part_of_speech_id: 1,
            denotation_id: <?php echo $lugat_manager['word_object']['query_object']['denotation_id']; ?>
        },
        empty_attribute : {
            action: '',
            attribute_id: 0,
            attribute_value: null
        },
        empty_example : {
            action: "",
            example_id: 0,
            query_example: "",
            query_language_id: 0,
            query_example_relation_id: 0,
            related_example: "",
            related_language_id: 0,
            related_example_relation_id: 0,
            relation_id: 0
        }
    }
    jQuery(document).ready(function(){
        $ = jQuery;
        mainObject = composeMainObject(JSON.parse('<?php echo json_encode($lugat_manager['word_object']); ?>'));
        initControls();
    });
    function initControls(){
        $( ".button" ).click(function(e) {
            if(e.target.className === 'fa fa-close'){
                e.target = $(e.target).parent();
            }    
            var data = {
                action: $(e.target).attr('data-action'),
                destination_type: $(e.target).attr('data-destination_type'),
                relation_id: $(e.target).attr('data-relation_id'),
                item_type: $(e.target).attr('data-item_type'),
                value: false
            };
            if(data.action == 'add'){
                changed = true;
                if(data.item_type == 'relation'){
                    data.value = $("#new-relation-input").val();
                }    
                addElement(data);
                $("#new-relation-input").val('');
            }
            if(data.action == 'delete'){
                changed = true;
                deleteElement(e, data);
            }
        });
        $("input, select").change(function(e) {
            changed = true;
            if($(e.target).prop('id') == 'new-relation-input'){
                return;
            };
            var data={
                value: e.target.value,
                relation_id: $(e.target).attr('data-relation_id'),
                column: $(e.target).attr('data-column'),
                destination_type: $(e.target).attr('data-destination_type'),
                item_id: $(e.target).attr('data-item_id'),
                item_type: $(e.target).attr('data-item_type'),
                action: 'update'
            };
            var relevance_rate = $(e.target).attr('data-relevance_rate');
            if(relevance_rate){
                if(data.value<1 || data.value>10 || !Number.isInteger(data.value*1)){
                    $(e.target).val('1');
                    return;
                }
                data.value = (11-data.value*1)*(relevance_rate/(Math.ceil(relevance_rate*0.9)));
                $(e.target).attr('data-relevance_rate', data.value);
            }
            updateElement(e, data);
            updateWordObject(e, data);
        });
        $('button.save').click(function(e){
            button_save = true;
            saveChanges();
        });
        window.onbeforeunload = function (){
            if(!changed || button_save){
                return;
            } else {
                return "<?php echo JText::_('MOD_LUGAT_CONFIRM_RELOAD'); ?>";
            }
             
        };
    }
    
    function composeMainObject(remote_object){
        var translations = remote_object.translations;
        translations.unshift(remote_object.query_object);
        return translations;
    }
    function goBack(){
        window.history.back();
    }
    
    function saveChanges(){
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=lugat_manager&method=saveChanges&format=json",
            type: "POST",
            data: {word_object: mainObject},
            success: function (response){
                renderSuccessMsg();
                location.reload(); 
            }
        });
    }
    
    function addElement(data){
        data.new_id = getRandomId();
        var empty_element_class = '#'+data.item_type+'-empty .'+data.item_type+'-block';
        var empty_element = prepareEmptyDOM(empty_element_class, data);
        $("." + data.item_type + '-list.' + data.item_type + 's-' + data.relation_id).append(empty_element);
        addToWordObject(data, empty_element);
    }
    
    function deleteElement(e, data){
        data.item_id = $(e.target).parent().data('item_id');
        $(e.target).parent().remove();
        deleteFromWordObject(data);
    }
    
    function updateElement(e, data){
        if(data.item_type === 'attribute'){
            $(e.target).attr("data-item_id", data.value);
            $(e.target).parent().attr("data-item_id", data.value);
        }
    }
    
    function prepareEmptyDOM(emptyDomClassName, data){
        var relation_id = data.relation_id;
        if(data.relation_id == 'relation'){
            relation_id = data.new_id;
        }    
        if(data.item_type == 'attribute'){
            data.new_id = $(emptyDomClassName+' select').val();
            $(emptyDomClassName).attr("data-item_id", data.value);
        }    
        if(data.value){
            $(emptyDomClassName+' .relation-name').html(data.value);
        }    
        if(data.item_type == 'example'){
            $(emptyDomClassName).attr("data-related_example_relation_id", relation_id);
        }    
        $(emptyDomClassName).attr("data-item_id", data.new_id);
        $(emptyDomClassName+' .button').attr("data-relation_id", relation_id);
        $(emptyDomClassName+' input').attr("data-relation_id", relation_id);
        $(emptyDomClassName+' input').attr("data-item_id", data.new_id);
        $(emptyDomClassName+' select').attr("data-relation_id", relation_id);
        $(emptyDomClassName+' select').attr("data-item_id", data.new_id);
        $(emptyDomClassName+' .attribute-list').addClass("attributes-"+data.new_id);
        $(emptyDomClassName+' .example-list').addClass("examples-"+data.new_id);
        return $(emptyDomClassName).clone( true );
    }    
    
    function prepareObject(data){
        var empty_object = empty_objects['empty_'+data.item_type];
        empty_object[data.item_type + '_id'] = data.new_id;
        empty_object['action'] = 'add';
        if(data.value && data.item_type=='relation'){
            empty_object['word'] = data.value;
        } 
        return empty_object;
    }    
    
    
    function updateWordObject(e, data){
        for(var i = 0; i < mainObject.length; i++){
            if(mainObject[i]['relation_id'] == data.relation_id){
                var next_considerable = mainObject[i][data.item_type+'s'];
                if(data.item_type == 'relation'){
                    next_considerable = [mainObject[i]];
                }
                for(var k = 0; k < next_considerable.length; k++){
                    var item = next_considerable[k];
                    if(item[data.item_type+'_id'] == data.item_id){
                        item.action = data.action;
                        if(item.action == 'update'){
                            item[data.column] = data.value;
                        }
                        if(data.item_type == 'example'){
                            item['query_example_relation_id'] = $(e.target).parent().data('query_example_relation_id');
                            item['related_example_relation_id'] = $(e.target).parent().data('related_example_relation_id');
                        }
                    }
                }
            }
        }
    }
    
    function addToWordObject(data){
        var object = prepareObject(data);
        if(data.item_type == 'relation'){
            mainObject.push(object);
        } else {
            for(var i = 0; i < mainObject.length; i++){
                if(mainObject[i].relation_id == data.relation_id){
                    mainObject[i][data.item_type+'s'].push(object);
                }
            }
        }
    }
    
    function deleteFromWordObject(data){
        for(var i = 0; i < mainObject.length; i++){
            if(mainObject[i]['relation_id'] == data.relation_id){
                var next_considerable = mainObject[i][data.item_type+'s'];
                if(data.item_type == 'relation'){
                    next_considerable = [mainObject[i]];
                }
                for(var k = 0; k < next_considerable.length; k++){
                    var item = next_considerable[k];
                    if(item[data.item_type+'_id'] == data.item_id){
                        item.action = 'delete';
                    }
                }
            }
        }
    }
        
    function getRandomId(){
        return 'DIY'+Math.floor(Math.random() * 100000);
    }
    
    function renderSuccessMsg(success){
        var msg = '';
        if(success){
            msg = '<?php echo JText::_('MOD_LUGAT_MESSAGE_SUCCESS'); ?>';
        } else {
            msg = '<?php echo JText::_('MOD_LUGAT_MESSAGE_UNSUCCESS'); ?>';
        }
        return msg;
    }
</script>