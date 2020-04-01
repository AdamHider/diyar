<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>

<div class="lugat">
    <div id="lugat-head<?php if(empty($lugat['translation'] && !$lugat['not_found'])){ echo '-empty'; }?>">
        <div class="lugat-head-block">
            <form autocomplete="off" action="" class="search-row" onsubmit="getWord(); return false">
                <?php 
                    $autocomplete_config = [
                        'module_name' => 'lugat',
                        'get_data_method_name' => 'autocomplete',
                        'input_value_to_render' => $lugat['input_value'],
                        'input_placeholder' =>  'Enter value' ,
                        'click_action_method_name' => 'getWord'
                    ];
                    include 'autocomplete.php';    
                ?>  
                <button  id='search-button' style="border-radius: 11px; padding: 1.5em;" type="submit" class="button">
                    <i class="fa fa-search fa-lg"></i> 
                </button>
            </form>
            <?php if(!empty($lugat['translation']) && !$lugat['not_found']){ ?>
            <div class="add-word-block">
                <button id="add_new_word" class="button"><i class="fa fa-plus"></i>
                <span>
                    <?php echo JText::_('MOD_LUGAT_ADD_WORD'); ?>
                </span>
                </button>
                <div id="add-word-group" style="display: none;">
                    <div id="special-symbols" >
                        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='â'/>
                        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ö'/>
                        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ü'/>
                        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ı'/>
                        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ğ'/>
                        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ş'/>
                        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ç'/>
                        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ñ'/>
                    </div>
                    <input id="add-word-input" type="text" placeholder="<?php echo JText::_('MOD_LUGAT_ENTER_NEW_WORD'); ?>" value=""/>
                    <button id="submit_add" class="button"><i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
            <?php } ?>
        </div>      
        <div class="lugat-header-description" ><?php echo JText::_('MOD_LUGAT_HEADER_DESCRIPTION'); ?></div>
    </div>    
    
    <div id="lugat-body<?php if($lugat['not_found']){ echo '-not-found'; }?>">
        <?php if(!empty($lugat['translation'] && !$lugat['not_found'])){  ?>
        <ul id="tabs">
                <li><a id="tab1">Translation</a></li>
                <li><a id="tab2">Morphology</a></li>
            </ul>
            <div class="container" id="tab1C">
                <?php include 'results_main.php'; ?>
            </div>
            <div class="container" id="tab2C">
                <?php include 'results_morphology.php'; ?>
            </div>
        
        <?php } else { 
            if($lugat['empty']){ 
                include 'empty.php';  
            };
            if($lugat['not_found']){ 
                include 'not_found.php';  
            };
        } ?>  
    </div>
</div>

<script>
    var autocomplete_results = [];
    var current_letter = '';
    var keyboard_is_active = false;
    
    function init(){
        var $ = jQuery;
        document.addEventListener("click", function (e) {
            if(e.target.id !== 'search-input' && (e.target.id !== 'keyboard-open' && e.target.parentElement.id !== 'keyboard-open')){
                if(e.target.id !== 'special-symbols' && e.target.className !== 'input-letter button'){
                    document.getElementById("special-symbols").style.display = "none";
                }
                closeAllLists(document);
            }
        });
        document.getElementById("add_new_word").addEventListener("click", function (e) {
            var add_block = document.getElementById("add-word-group");
            if (add_block.style.display === "none") {
              add_block.style.display = "block";
            } else {
              add_block.style.display = "none";
            }
        });
        document.getElementById("submit_add").addEventListener("click", function (e) {
            var word = document.getElementById("add-word-input").value;
            if(word === ''){
                return;
            }
            goToEditor(word);
        });
        $('#tabs li a:not(:first)').addClass('inactive');
        $('.container').hide();
        $('.container:first').show();
        $('#tabs li a').click(function () {
            var t = $(this).attr('id');
            if ($(this).hasClass('inactive')) { //this is the start of our condition 
                $('#tabs li a').addClass('inactive');
                $(this).removeClass('inactive');
                $('.container').hide();
                $('#' + t + 'C').fadeIn('slow');
            }
        });
    }

    function goToEditor(word){
        window.history.pushState("", "", window.location.href);
        window.location.href = window.location.protocol+"<?php echo JText::_('MOD_LUGAT_EDITOR_LINK'); ?>?word="+word;
    }
    
    jQuery.noConflict();
    
    function getWord(word) {
        if(!word){
            word = $("#autocomplete_input").val();
        }
        if(word == ''){
            $('#autocomplete_input').css('border', '1px solid #ff7373');
            $('#autocomplete_input').css('box-shadow', '0px 0px 7px #f25e5e');
            return;
        }
        var url = window.location.href + "?word=" + word;
        window.history.pushState("", "", url);
        location.replace("?word=" + word);
        return;
    };
   

init();
</script>

