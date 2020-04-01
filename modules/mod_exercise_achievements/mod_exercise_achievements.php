<?php

    // No direct access
    defined('_JEXEC') or die;

    $document = JFactory::getDocument();
    
    $document->addStyleSheet('modules/mod_exercise_statistic/assets/mod_exercise_statistic.css');
    
    $lang = JFactory::getLanguage();
    $lang_tag = $lang->get('tag');
    // Include the syndicate functions only once
    require_once dirname(__FILE__) . '/helper.php';
    $classroom_homeworks = [];
    
    $header_title = '';
    $action = JRequest::getVar('action', '', 'get');
    $homework_id = JRequest::getVar('homework_id', '', 'get');
    
    $user   = JFactory::getUser();
    $user_levels = JAccess::getGroupsByUser($user->id);
    $class_exists = false;
    $exercise_statistic['statistic_list'] = ModExerciseStatisticHelper::getStatisticListView();
    $exercise_statistic['statistic_common'] = ModExerciseStatisticHelper::getStatisticCommonView();
    $exercise_statistic['statistic_chart'] = ModExerciseStatisticHelper::getStatisticChartView();
    
    if($class_exists){
        if(empty($action)){
                $classroom_homeworks['homeworks_list'] = ModClassroomHomeworksHelper::getHomeworksList($classroom_homeworks['classroom']->classroom_id);  
        } else {
            if($action === 'edit'){
                $classroom_homeworks['homework'] = ModClassroomHomeworksHelper::getHomework($homework_id, $classroom_homeworks['classroom']->classroom_id);    
            }
        }
    }
    
    
    
    $header_title .= JText::_('Homeworks');
    
    $document->setTitle($header_title);
    
    require JModuleHelper::getLayoutPath('mod_exercise_statistic');
    
    
    
    