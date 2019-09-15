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
    <input id="input" type="text" placeholder=" <?php echo $lugat['input_placeholder']; ?> " value="<?php echo $lugat['input_value']; ?>"/>
    <a target="_self" style="border-radius: 11px; padding: 1.5em;" class="button" onclick="goToDict()">Translate</a>
    <div>
        <?php if(!empty($lugat['result'])){?>
        <div class="block">
            <span class="name">Word: </span>
            <span class="value">
                <a onclick="getWord('<?php echo $lugat['result']['output_result']; ?>')"><?php echo $lugat['result']['output_result']; ?></a>
            </span>
        </div>
        <?php } else {?>
        <div class="block">
            <span class="name">Word is not defined!</span>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    jQuery.noConflict();
    function goToDict() {
        var data = jQuery("#input").val();
        location.replace("?word="+data);
        return;
        console.log(data);
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=lugat&method=getHello&format=json", 
            type: "GET",
            data: {data: data},
            success: function(response){ 
                jQuery("#text").html(response.data);
            }
        });
    };
    function getWord(word) {
        location.replace("?word="+word+'_from_a');
        return;
    };
</script>