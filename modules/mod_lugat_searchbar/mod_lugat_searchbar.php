<?php
 

    // No direct access
    defined('_JEXEC') or die;

    $document = JFactory::getDocument();
    
    $document->addStyleSheet('modules/mod_lugat_searchbar/assets/mod_lugat_searchbar.css');
    
    $lang = JFactory::getLanguage();
    // Include the syndicate functions only once
    require_once dirname(__FILE__) . '/helper.php';
    
    $lugat = modLugatSearchbarHelper::init($params);
    
    
    
    require JModuleHelper::getLayoutPath('mod_lugat_searchbar');
    
    
    
    