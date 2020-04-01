
<?php

class ModHomeComplexHeaderHelper {

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

        return $param;
    }

}


