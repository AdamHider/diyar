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

    public static function getTranslation($input_word) {
        $result = ModLugatHelper::composeObject(ModLugatHelper::getObjectByWord($input_word));
        return $result;
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
            $final_object['query_word_id'] = $relation->word_query_word_id;
            $final_object['query_word'] = $relation->word_query_word;
            
            if(!empty($relation->relation_query_attributes)){
                $query_attributes_array = explode('|',$relation->relation_query_attributes);
                $final_object['query_attributes'] =  ModLugatHelper::composeAttributes($query_attributes_array);
            }
            
            $final_object['query_part_of_speech_id'] = $relation->word_query_part_of_speech_id;
            $final_object['query_word_transcription'] = $relation->word_query_transcription;

            $final_relation_object['word_id'] = $relation->word_result_word_id;
            $final_relation_object['word'] = $relation->word_result_word;
            $final_relation_object['word_part_of_speech'] = $relation->word_result_part_of_speech;
            $final_relation_object['relation_id'] = $relation->relation_result_relation_id;
            $final_relation_object['clarification'] = $relation->relation_result_clarification;
            
            if(!empty($relation->relation_result_attributes)){
                $result_attributes_array = explode('|',$relation->relation_result_attributes);
                $final_relation_object['attributes'] = ModLugatHelper::composeAttributes($result_attributes_array);
            }  
            
            $final_relation_object['relevance'] = (50 * (1 - (ceil($relation->relation_result_relevance) / 7)));
            if ($final_relation_object['relevance'] < 0) {
                $final_relation_object['relevance'] = 5;
            };
            if (!empty($relation->word_result_suggestion)) {
                $final_relation_object['word_suggestion'] = array_slice(explode(',', $relation->word_result_suggestion), 0, 6);
            }

            if ($relation->word_result_part_of_speech != $current_part_of_speech_id) {
                $current_part_of_speech_id = $relation->word_result_part_of_speech;
            }
            $final_object['translations'][$current_part_of_speech_id][] = $final_relation_object;
        }
        return $final_object;
    }
    
    private static function composeAttributes($attribute_array){
        if(empty($attribute_array)){
            return [];
        }
        $result_array = [];
        foreach($attribute_array as $attribute_row){
            $attribute_items = explode(':',$attribute_row);
            $attribute_object = [
                'attribute_group' => $attribute_items[0],
                'attribute_name' => $attribute_items[1],
                'attribute_value' => $attribute_items[2],
            ];
            $result_array[] = $attribute_object;
        }
        
        return $result_array;
    }
    
    private static function getObjectByWord($word) {
        $db = JFactory::getDbo();
        $db->setQuery($sql);

        $result = $db->loadObjectList();

        return $result;
    }
    
    private static function createMixedTable (){
        $db = JFactory::getDbo();
        $sql = "
            CREATE TABLE IF NOT EXISTS lgt_mixed 
            SELECT 
                wl.word_id query_word_id,
                wl.word query_word,
                wl.part_of_speech_id query_part_of_speech_id,
                wl.transcription query_transcription,
                r1.relation_id query_relation_id,
                r1.clarification query_clarification,
                (SELECT 
                    CONCAT('{',
                        GROUP_CONCAT('\"attribute_group_name\":\"',
                            attrg.name,
                            '\",\"attribute_name\":\"',
                            attr.name,
                            '\",\"attribute_value\":\"',
                            IF(attr2rel.attribute_value IS NOT NULL,
                                attr2rel.attribute_value,
                                ''),
                            '\",\"lang_id\":',
                            attrg.language_id
                            SEPARATOR ';'),
                        '}') t
                    FROM
                        lgt_attribute_to_relation attr2rel
                            LEFT JOIN
                        lgt_attributes attr ON attr2rel.attribute_id = attr.attribute_id
                            LEFT JOIN
                        lgt_attribute_groups attrg ON attrg.attribute_group_id = attr.attribute_group_id
                    WHERE
                        r1.relation_id = attr2rel.relation_id
                            AND attrg.language_id = attr.language_id) AS query_attributes,
                dl.denotation_id,
                dl.denotation_description,
                dl.denotation_number,
                r2.relation_id result_relation_id,
                r2.relevance result_relevance,
                (SELECT 
                    CONCAT('{',
                        GROUP_CONCAT('\"attribute_group_name\":\"',
                            attrg.name,
                            '\",\"attribute_name\":\"',
                            attr.name,
                            '\",\"attribute_value\":\"',
                            IF(attr2rel.attribute_value IS NOT NULL,
                                attr2rel.attribute_value,
                                ''),
                            '\",\"lang_id\":',
                            attrg.language_id
                            SEPARATOR ';'),
                        '}') t
                    FROM
                        lgt_attribute_to_relation attr2rel
                            LEFT JOIN
                        lgt_attributes attr ON attr2rel.attribute_id = attr.attribute_id
                            LEFT JOIN
                        lgt_attribute_groups attrg ON attrg.attribute_group_id = attr.attribute_group_id
                    WHERE
                        r2.relation_id = attr2rel.relation_id
                            AND attrg.language_id = attr.language_id) AS result_attributes,
                wl2.word_id result_word_id,
                wl2.word result_word,
                wl2.part_of_speech_id result_part_of_speech_id,
                GREATEST(wl.tstamp,
                        r1.tstamp,
                        dl.tstamp,
                        r2.tstamp,
                        wl2.tstamp) tstamp
            FROM
                word_list wl
                    JOIN
                relation_list r1 ON wl.word_id = r1.word_id
                    JOIN
                denotation_list dl ON dl.denotation_id = r1.denotation_id
                    JOIN
                relation_list r2 ON dl.denotation_id = r2.denotation_id
                    AND r1.language_id != r2.language_id
                    JOIN
                word_list wl2 ON wl2.word_id = r2.word_id";
        $db->setQuery($sql);
        return;
    }
    
    public static function getMixedTableAjax() {
        ini_set('memory_limit', '512M');
        $db = JFactory::getDbo();
        $db->setQuery("SELECT * FROM lgt_mixed");

        $result = $db->loadObjectList();

        return json_encode($result);
    }
    /*----------
private static function getObjectByWord($word) {
        $db = JFactory::getDbo();
        $lang_config = [
            'en-GB' => '1',
            'ru-RU' => '2'
        ];
        $lang = JFactory::getLanguage();
        $dict_lang_id = $lang_config[$lang->get('tag')];
        $sql = "
        SELECT DISTINCT
            wl.word_id word_query_word_id,
            wl.word word_query_word,
            wl.part_of_speech_id word_query_part_of_speech_id,
            wl.transcription word_query_transcription,
            r1.relation_id relation_query_relation_id,
            r1.clarification relation_query_clarification,
            (SELECT 
                    GROUP_CONCAT(attrg.name, ':', attr.name, ':', IF(attr2rel.attribute_value IS NOT NULL, attr2rel.attribute_value, '')
                            SEPARATOR '|') t
                FROM
                    lgt_attribute_to_relation attr2rel
                        LEFT JOIN
                    lgt_attributes attr ON attr2rel.attribute_id = attr.attribute_id
                        LEFT JOIN
                    lgt_attribute_groups attrg ON attrg.attribute_group_id = attr.attribute_group_id
                WHERE
                    r1.relation_id = attr2rel.relation_id
                        AND attr.language_id = $dict_lang_id
                        AND attrg.language_id = $dict_lang_id) relation_query_attributes,
            dl.denotation_id,
            dl.denotation_description,
            dl.part_of_speech_id denotation_part_of_speech_id,
            r2.relation_id relation_result_relation_id,
            IF(wl.language_id = 1,
                r2.clarification,
                r1.clarification) relation_result_clarification,
            (SELECT 
                    GROUP_CONCAT(attrg.name, ':', attr.name, ':', IF(attr2rel.attribute_value IS NOT NULL, attr2rel.attribute_value, '')
                            SEPARATOR '|') t
                FROM
                    lgt_attribute_to_relation attr2rel
                        LEFT JOIN
                    lgt_attributes attr ON attr2rel.attribute_id = attr.attribute_id
                        LEFT JOIN
                    lgt_attribute_groups attrg ON attrg.attribute_group_id = attr.attribute_group_id
                WHERE
                    r2.relation_id = attr2rel.relation_id
                        AND attr.language_id = $dict_lang_id
                        AND attrg.language_id = $dict_lang_id) relation_result_attributes,
            r2.relevance relation_result_relevance,
            wl2.word_id word_result_word_id,
            wl2.word word_result_word,
            wl2.part_of_speech_id word_result_part_of_speech_id,
            pts.name word_result_part_of_speech,
            GROUP_CONCAT(wl3.word) word_result_suggestion
        FROM
            word_list wl
                JOIN
            relation_list r1 ON wl.word_id = r1.word_id
                JOIN
            denotation_list dl ON dl.denotation_id = r1.denotation_id
                JOIN
            relation_list r2 ON dl.denotation_id = r2.denotation_id
                JOIN
            word_list wl2 ON wl2.word_id = r2.word_id
                JOIN
            parts_of_speech pts ON wl2.part_of_speech_id = pts.part_of_speech_id AND pts.language_id = $dict_lang_id
                LEFT JOIN
            word_list wl4 ON wl4.word = wl2.word
                LEFT JOIN
            relation_list r3 ON wl4.word_id = r3.word_id
                LEFT JOIN
            denotation_list dl2 ON dl2.denotation_id = r3.denotation_id
                LEFT JOIN
            relation_list r4 ON dl2.denotation_id = r4.denotation_id
                AND r4.language_id = wl.language_id
                AND r4.word_id != wl.word_id
                LEFT JOIN
            word_list wl3 ON wl3.word_id = r4.word_id
        WHERE
            wl.word = '$word'
                AND wl.language_id != wl2.language_id
        GROUP BY relation_result_relation_id
        ORDER BY r2.relevance  
    ";
        // Retrieve the shout

        $db->setQuery($sql);

        $result = $db->loadObjectList();

        return $result;
    }
     * 
     */
}
