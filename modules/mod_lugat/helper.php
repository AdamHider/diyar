<?php
   /**
      * Helper class for Hello World! module
      *
      * @package    Joomla.Tutorials
      * @subpackage Modules
      * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
      * @license        GNU/GPL, see LICENSE.php
      * mod_helloworld is free software. This version may have been modified pursuant
      * to the GNU General Public License, and as distributed it includes or
      * is derivative of works licensed under the GNU General Public License or
      * other free or open source software licenses.
   */
		
   class ModLugatHelper {
        /**
           * Retrieves the hello message
           *
           * @param   array  $params An object containing the module parameters
           *
          * @access public
        */

        public static function init($params) {
            
            $input_word = JFactory::getApplication()->input->get('word', '', 'string');
            // Return the Hello
            $param = [
                'header' => 'Lugat',
                'input_type' => 'text',
                'input_value' => $input_word,
                'input_placeholder' => 'Type your text...'

            ];
            
            if(!empty($input_word)){
                $param['result'] = [
                    'output_result' => $input_word,
                    'output_description' => $input_word,
                    'output_meaning' => $input_word,
                    'output_suggest' => $input_word
                ];
            }
             return $param;
        }
        
        
        public static function getHelloAjax() {
            $input_word = JRequest::getVar('data', '', 'get');
            
            $db = JFactory::getDbo();
            // Retrieve the shout
            $query = "
               SELECT 
                   hello 
               FROM 
                   joom_helloworld
               WHERE 
                   lang LIKE '$input_word'
               ";
            $db->setQuery($query);
            
            $result = $db->loadResult();
            
            return $result;
        }
        
        public static function autocompleteAjax() {
            $input = JRequest::getVar('word', '', 'post');
            $db = JFactory::getDbo();
            // Retrieve the shout
            $query = "
                SELECT 
                   word 
                FROM 
                   word_list
                WHERE 
                   word LIKE '$input%'
                LIMIT 7
               ";
            $db->setQuery($query);
            
            $result = $db->loadObjectList();
            
            return $result;
        }
        
   }
	
