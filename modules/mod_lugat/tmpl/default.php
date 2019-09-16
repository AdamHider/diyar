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
    <form autocomplete="off" action="" class="search-row">
        <div  class="autocomplete" style="width: 100%;">
            <input id="search-input" type="text" name="search-input" placeholder="Type your text... " oninput="autocompleteGo(this.value)">
        </div>
        <button  id='search-button' style="border-radius: 11px; padding: 1.5em;" type="submit" class="button">
            translate
            <i class="fa fa-arrow-circle-right fa-lg"></i> 
        </button>
    </form>


    <div class='info-row'>
        <div class='query-word_block'>
            <div class="query-word">Query word</div>
            <div class="query-word-transcription">
                [ transcription ]
            </div>
        </div>
        <div class='translations-block'>
            <div class='part-of-speech-list'>
                <div class='part-of-speech-block'>
                    <div class='part-of-speech-name'>noun</div>
                    <div class='denotations-list'>
                        <div class='denotation-block'>
                            <div class='denotation-info'>
                                <span class='denotation-number'>1)</span>
                                <span class='denotation-description'>Smth. that is put to tea</span>
                                <span class='denotation-etymology tag'>arab.</span>
                            </div>
                            <div class='referents-list'>
                                <div class='referent-block'>
                                    <span class='referent-name'>distinguish</span>
                                    <span class='referent-clarification'>( clarification one )</span>
                                    <span class='referent-details tag'>scope_of_use</span>
                                    <div class="referent-suggestions">
                                        <span>see also: </span>
                                        <a class="suggestion">suggestion1</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery.noConflict();
    function goToDict() {
        var data = jQuery("#input").val();
        location.replace("?word=" + data);
        return;
        console.log(data);
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=lugat&method=getHello&format=json",
            type: "GET",
            data: {data: data},
            success: function (response) {
                jQuery("#text").html(response.data);
            }
        });
    }
    ;
    function getWord(word) {
        location.replace("?word=" + word + '_from_a');
        return;
    }
    ;

    function autocompleteGo(word){
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=lugat&method=autocomplete&format=json",
            type: "POST",
            data: {word: word},
            success: function (response){
                renderAutocomplete(response);
                return;
            }
        });
    }
    
    function renderAutocomplete(response){
         var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) {
            return false;
        }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        var limit = 0;
        for (i = 0; i < response.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (response[i].word.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + response[i].word.substr(0, val.length) + "</strong>";
                b.innerHTML += response[i].word.substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + response[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function (e) {
                    /*insert the value for the autocomplete text field:*/
                    //inp.value = this.getElementsByTagName("input")[0].value;
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
        }
    }
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


</script>

