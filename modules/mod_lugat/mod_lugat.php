<?php

    // No direct access
    defined('_JEXEC') or die;

    $document = JFactory::getDocument();
    
    $document->addStyleSheet('modules/mod_lugat/assets/mod_lugat.css');
    $document->addStyleSheet('modules/mod_lugat/assets/autocomplete.css');
    $document->addStyleSheet('modules/mod_lugat/assets/lugat_results.css');
    $document->addStyleSheet('modules/mod_lugat/assets/lugat_morphology.css');
    
    $lang = JFactory::getLanguage();
    $lang_tag = $lang->get('tag');
    // Include the syndicate functions only once
    require_once dirname(__FILE__) . '/helper.php';
    require_once dirname(__FILE__) . '/fillDiyarMorphology.php';
    
    $header_title = '';
    $input = JRequest::getVar('word', '', 'get');
    $lugat['not_found'] = false;
    $lugat['empty'] = false;
    $lugat['translation'] = [];
    if(!empty($input)){
        $lugat['input_value'] = $input;
        $lugat['translation'] = modLugatHelper::getTranslation($input);
        $lugat['morphology'] = modMorphologyHelper::init();
        if(empty($lugat['translation']['query_word_id'])){
            modLugatHelper::addNotFoundStatistic($input);
            $lugat['not_found'] = true;
        }  
        $header_title = $input .= ' - ';
    } else {
        $lugat['empty'] = true;
    }
    
    $header_title .= JText::_('MOD_LUGAT_HEADER_TITLE');
    
    $document->setTitle($header_title);
    require JModuleHelper::getLayoutPath('mod_lugat');
    
    
    
    