<?php
/**
 * @package Joomla.Site
 * @subpackage mod_firstmodule
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
?>

<div class="lugat-input-container">
        <input id="search-input" type="text"  placeholder="Type your text... " oninput="autocompleteGo(this.value)"
         <?php if(!empty($lugat['translation']['query_word'])){  ?>
           value="<?php  echo  $lugat['translation']['query_word'] ?>"
         <?php }  ?>   
           >
</div>

<button  id='search-button'  class="button" onclick="goToDict(); return false">
    translate
    <i class="fa fa-search fa-lg"></i> 
</button> 

<script>
    
    var countries = [];
    var current_letter = '';
    

    jQuery.noConflict();
    function goToDict() {
        var word = jQuery('#search-input').val();
        if(word == ''){
            alert('Enter a word');
            return;
        }
        location.replace(location.pathname+"/language/dictionary?word=" + word);
        return;
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
    a.setAttribute("id", inp.id + "autocomplete-list");
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
        var x = document.getElementById(inp.id + "autocomplete-list");
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

