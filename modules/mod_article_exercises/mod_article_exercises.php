<?php
      // No direct access
    defined('_JEXEC') or die;

    $document = JFactory::getDocument();
    
    $document->addStyleSheet('modules/mod_article_exercises/assets/mod_article_exercises.css');
    
    // Include the syndicate functions only once
    require_once dirname(__FILE__) . '/helper.php';
    $article_exercises = [];
    
    $header_title = '';
    $exercise_id = 0;
    $action = JRequest::getVar('action', '', 'get');
    
    
    $jinput = JFactory::getApplication()->input;
    $article_exercises['category_id'] = '';
    $article_exercises['article_id'] = '';
    $current_view = $jinput->get('view');
    if($current_view == 'category'){
        $article_exercises['category_id'] = $jinput->get('id');
    } else if($current_view == 'article'){
        $article_exercises['category_id'] = $jinput->get('catid');
        $article_exercises['article_id'] = $jinput->get('id');
    }
    if(!empty($article_exercises['article_id']) && $current_view == 'article'){
        $article_exercises['exercise_list'] =  ModArticleExercisesHelper::composeExerciseList($article_exercises['article_id']); 
    } 
    
    $header_title .= JText::_('HEADER_TITLE');
    
    $document->setTitle($header_title);
    
    require JModuleHelper::getLayoutPath('mod_article_exercises');
    
    
    
    