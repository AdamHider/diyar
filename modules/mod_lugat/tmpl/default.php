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
    <div id="lugat-head<?php if(empty($lugat['translation'] && !$lugat['not_found'])){ echo '-empty'; }?>">
        <form autocomplete="off" action="" class="search-row" onsubmit="getWord(this[0].value); return false">
            <div  class="autocomplete">
                <input id="search-input" type="text" name="search-input" placeholder="<?php echo JText::_('MOD_LUGAT_ENTER_WORD'); ?> " oninput="autocompleteGo(this.value)"
                     <?php if(!empty($lugat['input_value'])){  ?>
                       value="<?php  echo  $lugat['input_value'] ?>"
                     <?php }  ?>   
                       >
                <input type="submit" style="visibility: hidden;" />
            </div>
            
            <button  id='search-button' style="border-radius: 11px; padding: 1.5em;" type="submit" class="button">
                <i class="fa fa-search fa-lg"></i> 
            </button>
        </form>
        <div class="lugat-header-description" ><?php echo JText::_('MOD_LUGAT_HEADER_DESCRIPTION'); ?></div>
        <div class="lugat-actions">
            <i class="fa fa-retweet fa-2" aria-hidden="true" id="syncronizeIndexedDb" onclick="syncronizeIndexedDb()"></i>
        </div>
        
        <div id="sync_progress">
            <div class="loading-from-server" style="display: none">Loading data from server...</div>
            <div class="loading-row-counter" style="display: none">
                <span class="sync-counter">0</span> <span>of</span> <span class="sync-total">0</span>
            </div>
            
        </div>
    </div>    
    
    <div id="lugat-body">
        <?php if(!empty($lugat['translation'] && !$lugat['not_found'])){  
            include 'lugat_results.php';  
        } else { 
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
    var db;
    var request;
    jQuery.noConflict();
    jQuery(document).ready(function(){
        createDb();
    });
    
    function getWord(word) {
        if(word == ''){
            jQuery('#search-input').css('border', '1px solid #ff7373');
            jQuery('#search-input').css('box-shadow', '0px 0px 7px #f25e5e');
            return;
        }
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
                autocomplete_results = response.data;
                autocomplete(document.getElementById('search-input'), autocomplete_results);
            }
        });
        
    }
    
    function syncronizeIndexedDb(){


        
        var mixed_table = getMixedTable();
        
    }
   
    function getMixedTable(){
        var start = new Date().getTime();
        jQuery('.loading-from-server').show();
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=lugat&method=getMixedTable&format=json",
            type: "POST",
            data: {},
            success: function (response){
                jQuery('.loading-from-server').hide();
                jQuery('.loading-row-counter').show();
                addData(JSON.parse(response.data));
                var end = new Date().getTime();
                var time = end - start;
                alert('Execution time: ' + time);
                return;
            }
        });
    }
    
    function getDataFromDb(word){
        var transaction = db.transaction(["word_list"], "readwrite");
        var invStore = transaction.objectStore("word_list");
        var invIndex = invStore.index("word");
        var getRequestIdx = invIndex.getAll(word);
        getRequestIdx.onsuccess = () => {
            console.log(getRequestIdx.result); 
        };  
    }
    
    function addData(mixedTable) {
        var rowsTotal = mixedTable.length;
        jQuery('.sync-total').html(rowsTotal);
        // Start a database transaction and get the notes object store
        var tx = db.transaction(['word_list'], 'readwrite');
        for(var i = 0; i<rowsTotal; i++){
            var store = tx.objectStore('word_list');  // Put the sticky note into the object store
            var table = {
                query_word_id: mixedTable[i].query_word_id, 
                query_word: mixedTable[i].query_word, 
                query_part_of_speech_id: mixedTable[i].query_part_of_speech_id, 
                query_transcription: mixedTable[i].query_transcription, 
                query_relation_id: mixedTable[i].query_relation_id, 
                query_clarification: mixedTable[i].query_clarification, 
                query_attributes: mixedTable[i].query_attributes, 
                denotation_id: mixedTable[i].denotation_id, 
                denotation_description: mixedTable[i].denotation_description, 
                denotation_number: mixedTable[i].denotation_number, 
                result_relation_id: mixedTable[i].result_relation_id, 
                result_relevance: mixedTable[i].result_relevance, 
                result_attributes: mixedTable[i].result_attributes, 
                result_word_id: mixedTable[i].result_word_id, 
                result_word: mixedTable[i].result_word, 
                result_part_of_speech_id: mixedTable[i].result_part_of_speech_id, 
                tstamp: mixedTable[i].tstamp
            };
            store.add(table);  
            jQuery('.sync-counter').html(i);
            // Wait for the database transaction to complete
        }
            tx.oncomplete = function() { 
                console.log('stored note!'); 
            };
            tx.onerror = function(event) {
                alert('error storing note ' + event.target.errorCode);
                return;
            };

        
       

    };
   
   function createDb(){
        request = window.indexedDB.open("lugat", 1);

        // Create schema
        request.onupgradeneeded = event => {
            db = event.target.result;

            var invoiceStore = db.createObjectStore("word_list", { autoIncrement: true });
            invoiceStore.createIndex("word", "query_word");
        };

        request.onsuccess = () => {
            db = request.result;
            
            /*

            // Update an item
            itemStore.put({invoiceId: "123", row: "1", item: "Dish washer", cost: 1300});

            // Delete an item
            itemStore.delete(["123", "2"]);

            // Get an item by key
            const getRequest = invStore.get("123");
            getRequest.onsuccess = () => {
                console.log(getRequest.result); // {invoiceId: "123", vendor: "Whirlpool", paid: false}
            };
*/
            // Get an item by index
                                               //   {invoiceId: "580", vendor: "Whirlpool", paid: true} ]
        };
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
                getWord(inp.value);
                /*close the list of autocompleted values,
                 (or any other open lists of autocompleted values:*/
                closeAllLists();
                return;
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

