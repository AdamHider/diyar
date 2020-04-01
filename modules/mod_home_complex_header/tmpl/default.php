<?php
/**
 * @package Joomla.Site
 * @subpackage mod_firstmodule
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>

<div class="background-container">
    <div class="background-image-holder background-image parallax-background" 
        style="background-image: url('modules/mod_home_complex_header/images/Ai_Petri_Flat_Design_<?php echo $background['img_prefix']; ?>_Height.jpg')">
   </div>
    <div class="background-image-holder foreground-image" 
        style="background-image: url('modules/mod_home_complex_header/images/Ai_Petri_Flat_Design_Foreground_Height.png')">
    </div>
</div>


