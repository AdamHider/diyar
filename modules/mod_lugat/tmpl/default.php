<?php
/**
 * @package Joomla.Site
 * @subpackage mod_firstmodule
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
?>

<div class="lugat">
    <div id="lugat-head">
        <form autocomplete="off" action="" class="search-row" onsubmit="getWord(this[0].value); return false">
            <div  class="autocomplete" style="width: 100%;">
                <input id="search-input" type="text" name="search-input" placeholder="Type your text... " oninput="autocompleteGo(this.value)"
                     <?php if(!empty($lugat['translation']['query_word'])){  ?>
                       value="<?php  echo  $lugat['translation']['query_word'] ?>"
                     <?php }  ?>   
                       >
            </div>
            <button  id='search-button' style="border-radius: 11px; padding: 1.5em;" type="submit" class="button">
                <i class="fa fa-search fa-lg"></i> 
            </button>
        </form>
    </div>    
    <div id="lugat-body">
        <div class='info-row'>
            <div class='query-word_block'>
                 <?php if(!empty($lugat['translation']['query_word'])){ ?>
                    <div class="query-word"><?php echo $lugat['translation']['query_word']?></div>
                 <?php  } ?> 
                <?php if(!empty($lugat['translation']['query_word_transcription'])){ ?>
                <div class="query-word-transcription">
                    <?php echo  $lugat['translation']['query_word_transcription'] ?>
                </div>
                <?php  } ?> 
                <?php if(!empty($lugat['translation']['query_attributes'])){ 
                    foreach ($lugat['translation']['query_attributes'] as $attribute){ 
                        if(!empty($attribute)){  ?> 
                        <span class='referent-details tag'><?php echo $attribute ?></span>
                <?php } } } ?>     
            </div>
            <?php  if(isset($lugat['translation']['translations'])){ ?>

                <div class='translations-block'>
                    <div class='part-of-speech-list'>

            <?php  foreach($lugat['translation']['translations'] as $key=>$parts_of_speech){  ?>

                 <div class='part-of-speech-block'>
                            <div class='part-of-speech-name'><?php echo $key ?></div>

            <?php  foreach($parts_of_speech as $key=>$translation){  ?>

                            <div class='denotations-list'>
                                <div class='denotation-block'>
                                    <div class='denotation-info'>
           <!-- <?php if(count($parts_of_speech) > 1){ ?>                               
                                        <span class='denotation-number'><?php echo $key*1+1 ?>)</span>
            <?php  } ?>                         
                                        <span class='denotation-description'></span>
            -->   

                                    </div>

                                    <div class='referents-list'>
                                        <div class='referent-block'>
                                            <div class="relevance">
                                                <div class="relevance-container">
                                                     <div class="relevance-content" style="width: <?php echo $translation['relevance'] ?>px;"></div>
                                                </div>
                                            </div>
            <?php if(!empty($translation['word'])){ ?>                                          
                                            <a class='referent-name' onclick="getWord('<?php echo $translation['word'] ?>'); return false"><?php echo $translation['word'] ?></a>
            <?php  } ?>            
                                            
                                            
                                            <span>
                                                <a class='referent-to-map' target="_blank" href="https://www.google.com/maps/place/Гвардейское+Крым">
                                                    <i class='fa fa-globe'></i>
                                                </a>
                                            </span>   
                                            
                                            
            <?php if(!empty($translation['attributes'])){ 
                foreach ($translation['attributes'] as $attribute){ 
                    if(!empty($attribute)){  ?>  
                                            <span class='referent-details tag'><?php echo $attribute ?></span>
            <?php  } } } ?> 
            <?php if(!empty($translation['clarification'])){ ?>                                   
                                            <div class='referent-clarification'>( <?php echo $translation['clarification'] ?> )</div>
            <?php  } ?>                  
            <?php if(!empty($translation['word_suggestion'])){ ?>         
                                            <div class="referent-suggestions">
                                                (
                                                <?php foreach($translation['word_suggestion'] as $key=>$suggestion){ ?> 
                                                <a class="suggestion" onclick="getWord('<?php echo $suggestion ?>'); return false"><?php echo $suggestion ?></a> 
                                                <?php 
                                                    if( isset($translation['word_suggestion'][$key+1])){
                                                        echo ',';
                                                    }
                                                
                                                } ?>  
                                                )
                                            </div>
              <?php  } ?>                                  
                                        </div>
                                    </div>
                                </div>
                            </div>
            <?php  } ?>                

                        </div>
             <?php  } ?>              
                    </div>
                </div>
             <?php  } ?>  
        </div>
    </div>
</div>

<script>
    
    var countries = [];
    var current_letter = '';
    

    jQuery.noConflict();
    function goToDict(word) {
        console.log(word);
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=lugat&method=getWord&format=raw",
            type: "GET",
            data: {word: word},
            success: function (response) {
                jQuery("#text").html(response.data);
            }
        });
    }
    ;
    function getWord(word) {
        location.replace("?word=" + word);
        return;
    }
    ;

    function autocompleteGo(word){
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=lugat&method=autocomplete&format=json",
            type: "POST",
            data: {word: word},
            success: function (response){
                countries = response.data;
                autocomplete(document.getElementById('search-input'), countries);
            }
        });
        
    }
    
   
function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
     the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    var a, b, i, val = inp.value;
    /*close any already open lists of autocompleted values*/
    closeAllLists();
    currentFocus = -1;
    /*create a DIV element that will contain the items (values):*/
    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    /*append the DIV element as a child of the autocomplete container:*/
    inp.parentNode.appendChild(a);
    /*for each item in the array...*/
    var limit = 0;
    
    if(arr.length < 1){
        renderEmptySuggest(a);
        return;
    }
    for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = arr[i].word;
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i].word + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function (e) {
                
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                /*close the list of autocompleted values,
                 (or any other open lists of autocompleted values:*/
                closeAllLists();
            });
            if (limit > 6) {
                break;
            }
            limit++;
            a.appendChild(b);
    }
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x)
            x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
             increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
             decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x)
                    x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x)
            return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length)
            currentFocus = 0;
        if (currentFocus < 0)
            currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
         except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    function renderEmptySuggest(a){
        b = document.createElement("DIV");
        b.innerHTML = '<i>No results!</i>';
        a.appendChild(b);
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
    
}
</script>
<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("lugat-head");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>

