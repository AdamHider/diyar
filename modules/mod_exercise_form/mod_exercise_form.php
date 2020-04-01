<?php
      // No direct access
    defined('_JEXEC') or die;

    $document = JFactory::getDocument();
    
    $document->addStyleSheet('modules/mod_exercise_form/assets/mod_exercise_form.css');
    
    // Include the syndicate functions only once
    require_once dirname(__FILE__) . '/helper.php';
    $article_exercises = [];
    
    $header_title = '';
    
    $jinput = JFactory::getApplication()->input;
    $exercise_id = JRequest::getVar('exercise_id', '', 'get');
    $action = JRequest::getVar('action', '', 'get');
    
    $exercise_form['language'] = JFactory::getLanguage()->get('tag');
    
    if(!empty($exercise_id)){
        if(!empty($action) ){
            if($action === 'form'){
                $exercise_form['exercise'] =  ModExerciseFormHelper::getExercise($exercise_id)[0]; 
            } 
            if($action === 'view'){
                $exercise_form['exercise'] =  ModExerciseFormHelper::getExerciseValidated($exercise_id)[0]; 
            }
        }
        
    } 
    $header_title .= JText::_('HEADER_TITLE');
    
    $document->setTitle($header_title);
    
    require JModuleHelper::getLayoutPath('mod_exercise_form');
    
    
    
    