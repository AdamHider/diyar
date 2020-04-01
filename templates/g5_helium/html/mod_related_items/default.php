<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_related_items
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="related-items<?php echo $moduleclass_sfx; ?> mod-list">
<?php  foreach ($list as $item) : ?>
<div class="related-item">
        <span class="image-container">
            <img src="<?php echo json_decode($item->images)->image_intro; ?>" alt="<?php echo $item->title; ?>" title="<?php echo $item->title; ?>">
	    </span>	
		<?php if ($showDate) echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')) . ' - '; ?>
		<span itemprop="name" class="article-title">
		    <?php echo $item->title; ?>
		</span>
		<div class="introtext-container">
    		<div class="article-introtext">
    		    <?php echo strip_tags($item->introtext); ?>
    		</div>
		</div>
    		<a class="button button-dark button-mini" href="<?php echo $item->route; ?>">
    		    <?php echo JText::_('COM_CONTENT_READ_MORE_TITLE'); ?>
    		</a>
</div>
<?php endforeach; ?>
</div>
