<?php
/**
 * @package Joomla.Site
 * @subpackage mod_firstmodule
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
?>
<div class="notfound-message">
    <div class="notfound-title"><?php echo JText::_('MOD_LUGAT_NOTFOUND_TITLE_P1'); ?> <span>"<b><?php echo $lugat['input_value'] ?></b>"</span> <?php echo JText::_('MOD_LUGAT_NOTFOUND_TITLE_P2'); ?></div>
    <div class="notfound-description"><?php echo JText::_('MOD_LUGAT_NOTFOUND_TEXT_P1'); ?> <span>"<?php echo $lugat['input_value'] ?>"</span> <?php echo JText::_('MOD_LUGAT_NOTFOUND_TEXT_P2'); ?></div>
    
    <div class="notfound-adding-suggest"> <?php echo JText::_('MOD_LUGAT_NOTFOUND_ADDING_SUGGEST'); ?></div>
    <?php if($lugat['not_found']){ ?>
    <div class="add-word-block">
        <button id="add_new_word" class="button"><i class="fa fa-plus"></i>
        <span>
            <?php echo JText::_('MOD_LUGAT_ADD_WORD'); ?>
        </span>
        </button>
        <div id="add-word-group" style="display: none;">
                <div id="special-symbols" >
                    <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='â'/>
                    <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ö'/>
                    <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ü'/>
                    <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ı'/>
                    <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ğ'/>
                    <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ş'/>
                    <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ç'/>
                    <input class='input-letter button' type='button' onclick="enterSpecificLetter(this.value, 'add-word-input');" value='ñ'/>
                </div>
            <input id="add-word-input" type="text" placeholder="<?php echo JText::_('MOD_LUGAT_ENTER_NEW_WORD'); ?>" value="<?php echo $lugat['input_value'] ?>"/>
            <button id="submit_add" class="button"><i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
    <?php } ?>
</div>