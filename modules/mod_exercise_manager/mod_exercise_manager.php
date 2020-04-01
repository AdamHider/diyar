<?php
      // No direct access
    defined('_JEXEC') or die;

    $document = JFactory::getDocument();
    
    $document->addStyleSheet('modules/mod_exercise_manager/assets/mod_exercise_manager.css');
    
    // Include the syndicate functions only once
    require_once dirname(__FILE__) . '/helper.php';
    $exercise_manager = [];
    
    $header_title = '';
    $exercise_id = 0;
    $action = JRequest::getVar('action', '', 'get');
    
    $exercise_id = JRequest::getVar('exercise_id', '', 'get');
    
    if(!empty($action)){
        $exercise_manager['action'] = $action;
        $exercise_manager['exercise'] =  ModExerciseManagerHelper::getExercise($exercise_id); 
        $exercise_manager['language_list'] = ModExerciseManagerHelper::getLanguageList();
        $exercise_manager['article'] = ModExerciseManagerHelper::getExerciseArticle($exercise_id);
    } else {
        $exercise_manager['exercise_list'] =  ModExerciseManagerHelper::getExerciseList(); 
    }
    
    $header_title .= JText::_('HEADER_TITLE');
    
    $document->setTitle($header_title);
    
    require JModuleHelper::getLayoutPath('mod_exercise_manager');
    
    
    
    