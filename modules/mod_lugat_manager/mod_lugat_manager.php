<?php
      // No direct access
    defined('_JEXEC') or die;

    $document = JFactory::getDocument();
    
    $document->addStyleSheet('modules/mod_lugat_manager/assets/mod_lugat_manager.css');
    $lang = JFactory::getLanguage();
    $lang_tag = $lang->get('tag');
    // Include the syndicate functions only once
    require_once dirname(__FILE__) . '/helper.php';
    $lugat_manager = modLugatManagerHelper::init($params);
    
    $header_title = '';
    $word = JRequest::getVar('word', '', 'get');
    $lugat_manager['word'] = [];
    if(!empty($word)){
        $lugat_manager['word_object'] =  modLugatManagerHelper::getTranslation($word); 
    }
    
    $query_language_id = $lugat_manager['word_object']['query_object']['language_id'];
    if($query_language_id == 1){
        $relation_language_id = 2;
    } else {
        $relation_language_id = 1;
    }
    
    $lugat_manager['query_example_label'] = JText::_('MOD_LUGAT_MANAGER_ENTER_EXAMPLE_WITH_LANG_ID_'.$query_language_id.'_LABEL');
    $lugat_manager['query_example'] = JText::_('MOD_LUGAT_MANAGER_ENTER_EXAMPLE_WITH_LANG_ID_'.$query_language_id);
    $lugat_manager['relation_example_label'] = JText::_('MOD_LUGAT_MANAGER_ENTER_EXAMPLE_WITH_LANG_ID_'.$relation_language_id.'_LABEL');
    $lugat_manager['relation_example'] = JText::_('MOD_LUGAT_MANAGER_ENTER_EXAMPLE_WITH_LANG_ID_'.$relation_language_id);
    
    $lugat_manager['attribute_list'] =  modLugatManagerHelper::getAllAttributes();
    $lugat_manager['parts_of_speech'] =  modLugatManagerHelper::getAllPartsOfSpeech();
    
    
    $header_title .= JText::_('HEADER_TITLE');
    
    $document->setTitle($header_title);
    
    require JModuleHelper::getLayoutPath('mod_lugat_manager');
    
    
    
    