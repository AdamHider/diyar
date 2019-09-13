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
    <input id="input" type="text" placeholder=" <?php echo $lugat['input_placeholder']; ?> "/>
    <a target="_self" style="border-radius: 11px; padding: 1.5em;" class="button" onclick="goToDict()">Translate</a>
    <p> <?php echo $lugat['result']?></p>
</div>

<script>
    jQuery.noConflict();
    function goToDict() {
        var data = jQuery("#input").val();
        console.log(data);
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=lugat&method=getHello&format=json", 
            type: "POST",
            data: data, 
            success: function(data){ 
                alert(data); 
            }
        });
    };
</script>