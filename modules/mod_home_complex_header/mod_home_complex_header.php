<?php
   

    // No direct access
    defined('_JEXEC') or die;

    $document = JFactory::getDocument();
    
    $document->addStyleSheet('modules/mod_home_complex_header/assets/mod_home_complex_header.css');
    
    $lang = JFactory::getLanguage();
    $lang_tag = $lang->get('tag');
    
    $current_date = (int)date("H");
    
    if($current_date>=5 && $current_date<11){
        $background['img_prefix'] = 'Sunrise';
    } else 
    if($current_date>=11 && $current_date<17){
        $background['img_prefix'] = 'Day';
    } else 
    if($current_date>=17 && $current_date<19){
        $background['img_prefix'] = 'Sunset';
    } else {
        $background['img_prefix'] = 'Night';
    }  
    
    
    require JModuleHelper::getLayoutPath('mod_home_complex_header');
    
    
    
    