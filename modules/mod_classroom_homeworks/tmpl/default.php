<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>


<div class="homeworks-main">
    <div id="homeworks-body">
        <?php 
        if(empty($action)){
            include 'list.php';
        } else {
            include 'edit.php'; 
        } 
?>   
    </div>
</div>

<script>
    var $ = [];
    
    jQuery(document).ready(function(){
        $ = jQuery;
    });
</script>


