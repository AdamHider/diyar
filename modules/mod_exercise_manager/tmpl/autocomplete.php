<?php

defined('_JEXEC') or die;
?>

<div  class="autocomplete">
    <div id="special-symbols" style="display: none">
        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'autocomplete_input');" value='Гў'/>
        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'autocomplete_input');" value='Г¶'/>
        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'autocomplete_input');" value='Гј'/>
        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'autocomplete_input');" value='Д±'/>
        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'autocomplete_input');" value='Дџ'/>
        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'autocomplete_input');" value='Еџ'/>
        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'autocomplete_input');" value='Г§'/>
        <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'autocomplete_input');" value='Г±'/>
    </div>
    <input id="autocomplete_input" type="text" name="autocomplete_input" placeholder="<?php  echo  $autocomplete_config['input_placeholder'] ?>" 
        oninput="getResult(this.value, '<?php  echo  $autocomplete_config['module_name'] ?>', '<?php  echo  $autocomplete_config['get_data_method_name'] ?>')"
        onfocus="getResult(this.value, '<?php  echo  $autocomplete_config['module_name'] ?>', '<?php  echo  $autocomplete_config['get_data_method_name'] ?>')"
           value="<?php  echo  $autocomplete_config['input_value_to_render'] ?>"
           >
    <a id="keyboard-open" onclick="showKeyboard();"><i class="fa fa-keyboard-o"></i></a>     
</div>

<script>
    
    var $ = [];
    
    jQuery(document).ready(function(){
        $ = jQuery;
    });
    var autocomplete_results = [];
    var current_letter = '';
    var keyboard_is_active = false;
    
    function init(){
        document.addEventListener("click", function (e) {
            if(e.target.id !== 'autocomplete_input' && (e.target.id !== 'keyboard-open' && e.target.parentElement.id !== 'keyboard-open')){
                if(e.target.id !== 'special-symbols' && e.target.className !== 'input-letter button' && document.getElementById("special-symbols")){
                    document.getElementById("special-symbols").style.display = "none";
                }
                closeAllLists(document);
            }
        });
    }

    jQuery.noConflict();
    
    function getResult(search, module_name, method_name){
        renderSpecificLetters();
        jQuery.ajax({
            url: "index.php?option=com_ajax&module="+module_name+"&method="+method_name+"&format=json",
            type: "POST",
            data: {search: search},
            success: function (response){
                autocomplete_results = response.data;
                autocomplete(document.getElementById('autocomplete_input'), autocomplete_results);
            }
        });
    }
    function showKeyboard(){
        keyboard_is_active = !keyboard_is_active;
        document.getElementById("keyboard-open").classList.toggle('pressed');
        document.getElementsByClassName("autocomplete")[0].classList.toggle('with-keyboard');
        renderSpecificLetters();
    }
    
    function renderSpecificLetters(){
        var special_symbols = document.getElementById("special-symbols");
        if(!keyboard_is_active){
            special_symbols.style.display = "none";
            return;
        }
        special_symbols.style.display = "grid";
    }
    
    function enterSpecificLetter(letter, target_id){
        var inp = document.getElementById(target_id);
        inp.value += letter;
        inp.focus;
        if(target_id == 'add-word-input'){
            return;
        };
        getExercise(inp.value);
        return false;
    }
    
    
     function closeAllLists() {
        /*close all autocomplete lists in the document,
         except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
                x[i].parentNode.removeChild(x[i]);
        }
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
            renderEmptySuggest(a,inp.value );
            return;
        }
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = '<label>'+arr[i].title+'</label>';
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i].id + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function (e) {

                    /*insert the value for the autocomplete text field:*/
                    var id = this.getElementsByTagName("input")[0].value;
                    var title = this.getElementsByTagName("label")[0].innerHTML;
                    inp.value = title;
                    console.log(id);
                    console.log(title);
                    <?php if(!empty($autocomplete_config['click_action_method_name'])){ echo $autocomplete_config['click_action_method_name'].'(id)';} ?>
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
            console.log(x);
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
        function renderEmptySuggest(a, word){
            b = document.createElement("DIV");
            b.innerHTML += '<span>';
            b.innerHTML += "<i><?php echo JText::_('Nothing Found'); ?></i>";
            b.innerHTML += ' <label><b>'+word+'</b></label>';
            b.innerHTML += '</span>';

            a.appendChild(b);
        }


    }

   

init();
</script>


<style>
    /*=======AUTOCOMPLETE BLOCK========*/
#special-symbols{
    grid-template-columns: 12% 12% 12% 12% 12% 12% 12% 12%;
    border: 1px solid #66d82d;
    background-color: white;
    height: 44px;
    position: absolute;
    top: 100%;
    width: -moz-available;
    padding: 0 0.5em;
    margin-left: 1%;
    border-radius: 0 0 5px 5px;
    transition: 0.5s ease;
}
div#special-symbols input.input-letter.button{
    padding: 0 !important;
    height: 30px;
    margin: 0.2em;
}

#keyboard-open{
    position: absolute;
    z-index: 10;
    right: 0;
    padding: 0 10px;
    font-size: 21px;
    max-height: 40px;
    border-left: 1px solid #f4f4f4;
    transition: 0.5s ease;
}
#keyboard-open.pressed{
    background-color: #f4f5f7;
    box-shadow: inset 1px 1px 5px #1a1a1a73;
}

#keyboard-open.pressed a{
    color: #424242;
} 


.autocomplete{
    position: relative;
    height: 40px;
    width: 40%;
    display: grid;
}

.autocomplete-items {
    position: absolute;
    border: 1px solid #7ad520;
    z-index: 99;
    top: 100%;
    width: 99%;
    box-shadow: 0px 6px 10px #3e3e3e5e;
    margin-left: 1%;
    transition: 0.5s ease;
}

.with-keyboard .autocomplete-items{
    top:  90px !important;
}

.autocomplete-items div {
    padding: 6px;
    cursor: pointer;
    background-color: #fff; 
    border-bottom: 1px solid #d4d4d4; 
    padding-left: 10px;
}

/*when hovering an item:*/
.autocomplete-items div:hover {
    background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
    background-color: #7ad520 !important;
    color: #ffffff; 
}


</style>