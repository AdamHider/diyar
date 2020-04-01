<?php

    // No direct access
    defined('_JEXEC') or die;

    $document = JFactory::getDocument();
    
    $document->addStyleSheet('modules/mod_classroom_manager/assets/mod_classroom_manager.css');
    
    $lang = JFactory::getLanguage();
    $lang_tag = $lang->get('tag');
    // Include the syndicate functions only once
    require_once dirname(__FILE__) . '/helper.php';
    
    $header_title = '';
    $user   = JFactory::getUser();
    $user_levels = JAccess::getGroupsByUser($user->id);
    $action = JRequest::getVar('action', '', 'get');
    $classroom_id = JRequest::getVar('item_id', '', 'get');
    
    if(!empty($action)){
        if($action === 'edit'){
            
        }
    }
    $class_exists = false;
    
    $classroom_manager['classroom'] = ModClassroomManagerHelper::getClassroom($user->id)[0];
    $classroom_manager['student_list'] = ModClassroomManagerHelper::getStudentList($classroom_manager['classroom']->classroom_id);
    $classroom_manager['top_students'] = ModClassroomManagerHelper::getTopStudents($classroom_manager['classroom']->classroom_id);
    $classroom_manager['student_rating'] = ModClassroomManagerHelper::getStudentsRatingChartView($classroom_manager['classroom']->classroom_id);
  
    $header_title .= JText::_('Classroom');
    
    $document->setTitle($header_title);
    
    require JModuleHelper::getLayoutPath('mod_classroom_manager');
    
    
    
    