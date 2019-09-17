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

        if (!empty($input_word)) {
            $param['result'] = [
                'output_result' => $input_word,
                'output_description' => $input_word,
                'output_meaning' => $input_word,
                'output_suggest' => $input_word
            ];
        }
        return $param;
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
                GROUP BY word
                LIMIT 7
               ";
        $db->setQuery($query);

        $result = $db->loadObjectList();

        return $result;
    }

    public static function getTranslationsAjax() {
        $input_word = JRequest::getVar('data', '', 'get');
        return composeObject(getObjectByWord($input_word));
    }

    private static function composeObject($relations) {
        $final_object = [
            'query_word_id' => '',
            'query_word_id' => '',
            'query_part_of_speech_id' => '',
            'query_word_transcription' => ''
        ];
        $final_relation_object = [
            'relation_id' => '',
            'word_id' => '',
            'word' => '',
            'word_part_of_speech_id' => '',
            'clarification' => '',
            'dialectality' => '',
            'scope_of_use' => '',
            'expressivity' => '',
            'stylistic_status' => '',
            'etymology_lang' => '',
            'etymology_word' => '',
            'modernity' => '',
        ];
        $result_object = [
            'result_word_id' => '',
            'result_word' => '',
            'result_part_of_speech_id' => '',
            'denotations' => []
        ];
        $current_part_of_speech_id = '';
        foreach ($relations as $relation) {
            $final_object['query_word_id'] = $relation['word_query_word_id'];
            $final_object['query_word'] = $relation['word_query_word'];
            $final_object['query_part_of_speech_id'] = $relation['word_query_part_of_speech_id'];
            $final_object['query_word_transcription'] = $relation['word_query_transcription'];

            $final_relation_object['word_id'] = $relation['word_result_word_id'];
            $final_relation_object['word'] = $relation['word_result_word'];
            $final_relation_object['word_part_of_speech'] = $relation['word_result_part_of_speech'];
            $final_relation_object['relation_id'] = $relation['relation_result_relation_id'];
            $final_relation_object['clarification'] = $relation['relation_result_clarification'];
            $final_relation_object['dialectality'] = $relation['relation_result_dialectality'];
            $final_relation_object['scope_of_use'] = $relation['relation_result_scope_of_use'];
            $final_relation_object['expressivity'] = $relation['relation_result_expressivity'];
            $final_relation_object['stylistic_status'] = $relation['relation_result_stylistic_status'];
            $final_relation_object['etymology_lang'] = $relation['relation_result_etymology_lang'];
            $final_relation_object['etymology_word'] = $relation['relation_result_etymology_word'];


            if ($relation['word_result_part_of_speech'] != $current_part_of_speech_id) {
                $current_part_of_speech_id = $relation['word_result_part_of_speech'];
            }
            $final_object['translations'][$current_part_of_speech_id][] = $final_relation_object;
        }
        return $final_object;
    }

    private static function getObjectByWord($word) {

        $db = JFactory::getDbo();

        $sql = "
        SELECT DISTINCT
            wl.word_id              word_query_word_id,
            wl.word                 word_query_word,
            wl.part_of_speech_id    word_query_part_of_speech_id,
            wl.transcription        word_query_transcription,
            r1.relation_id          relation_query_relation_id,
            r1.clarification        relation_query_clarification,
            r1.dialectality         relation_query_dialectality,
            r1.scope_of_use         relation_query_scope_of_use,
            r1.expressivity         relation_query_expressivity,
            r1.stylistic_status     relation_query_stylistic_status,
            r1.etymology_lang       relation_query_etymology_lang,
            r1.etymology_word       relation_query_etymology_word,
            r1.modernity            relation_query_modernity,
            dl.denotation_id,
            dl.denotation_description,
            dl.part_of_speech_id    denotation_part_of_speech_id,
            r2.relation_id          relation_result_relation_id,
            r2.clarification        relation_result_clarification,
            r2.dialectality         relation_result_dialectality,
            r2.scope_of_use         relation_result_scope_of_use,
            r2.expressivity         relation_result_expressivity,
            r2.stylistic_status     relation_result_stylistic_status,
            r2.etymology_lang       relation_result_etymology_lang,
            r2.etymology_word       relation_result_etymology_word,
            r2.modernity            relation_result_modernity,
            wl2.word_id             word_result_word_id,
            wl2.word                word_result_word,
            wl2.part_of_speech_id   word_result_part_of_speech_id,
            pts.eng_part_descr      word_result_part_of_speech
        FROM
            qirim_english_dictionary.word_list wl
                JOIN
            relation_list r1 ON wl.word_id = r1.word_id 
                JOIN
            denotation_list dl ON dl.denotation_id = r1.denotation_id
                JOIN
            relation_list r2 ON dl.denotation_id = r2.denotation_id
                JOIN
            word_list wl2 ON wl2.word_id = r2.word_id
                JOIN
            parts_of_speech pts ON wl2.part_of_speech_id = pts.part_of_speech_id
        WHERE
            wl.word = '$word'
                AND wl.language_id != wl2.language_id
    ";
        // Retrieve the shout

        $db->setQuery($sql);

        $result = $db->loadResult();

        return $result;
    }

}
