<?php

    // No direct access
    defined('_JEXEC') or die;

    $document = JFactory::getDocument();
    
    $document->addStyleSheet('modules/mod_user_dashboard/assets/mod_user_dashboard.css');
    
    $lang = JFactory::getLanguage();
    $lang_tag = $lang->get('tag');
    // Include the syndicate functions only once
    require_once dirname(__FILE__) . '/helper.php';
    
    $header_title = '';
    $user   = JFactory::getUser();
    $user_levels = JAccess::getGroupsByUser($user->id);
    $action = JRequest::getVar('action', '', 'get');
    $classroom_id = JRequest::getVar('item_id', '', 'get');
    
    $user_dashboard = ModUserDashboardHelper::getUserDashboard($user->id);
    if(empty($user_dashboard)){
        ModUserDashboardHelper::createUserDashboard($user->id);
        $user_dashboard = ModUserDashboardHelper::getUserDashboard($user->id)[0];
    } else {
        $user_dashboard = $user_dashboard[0];
    }
    
    
    $header_title .= JText::_('Classroom');
    
    $document->setTitle($header_title);
    
    require JModuleHelper::getLayoutPath('mod_user_dashboard');
    
    
    
    