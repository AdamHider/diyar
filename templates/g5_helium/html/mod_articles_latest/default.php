<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="latestnews<?php echo $moduleclass_sfx; ?> mod-list">
<?php 

foreach ($list as $item) : 
    $url_string = urldecode($_SERVER['REQUEST_URI']);
    $alias_plus_id = trim(mb_substr($url_string, mb_strripos($url_string, '/')),'/');
    $clear_alias = trim(mb_substr($alias_plus_id, mb_strpos($alias_plus_id, '-')),'-');
    if($item->alias == $clear_alias){
	    continue;
	}
    ?>
	<div class="latest-item">
	    
		<a href="<?php echo $item->link; ?>" itemprop="url">
		    <span class="image-container">
	            <img src="<?php echo json_decode($item->images)->image_intro; ?>" alt="<?php echo $item->title; ?>" title="<?php echo $item->title; ?>">
		    </span>	
		    <span itemprop="name" class="article-title">
				<?php echo $item->title; ?>
			</span>
		</a>
	</div>
<?php endforeach; ?>
</div>
