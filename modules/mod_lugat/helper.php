
<?php

class ModLugatHelper {

    public static function autocompleteAjax() {
        $input = JRequest::getVar('word', '', 'post');
        $db = JFactory::getDbo();
        $query = "
                SELECT DISTINCT
                    word 
                FROM 
                   lgt_word_list
                WHERE 
                   word LIKE '$input%'
                ORDER BY language_id ASC
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
            $final_object['query_part_of_speech_id'] = $relation->word_query_part_of_speech_id;
            $final_object['query_toponymy_link'] = $relation->word_query_toponymy;
            $final_object['query_word_transcription'] = ModLugatHelper::composeTranscription($relation->word_query_transcription);
            
            $final_object['attributes'] = ModLugatHelper::getWordAttributes($relation->relation_query_relation_id);

            $final_relation_object['word_id'] = $relation->word_result_word_id;
            $final_relation_object['word'] = $relation->word_result_word;
            $final_relation_object['word_part_of_speech'] = $relation->word_result_part_of_speech;
            $final_relation_object['relation_id'] = $relation->relation_result_relation_id;
            $final_relation_object['clarification'] = $relation->relation_result_clarification;
            $final_relation_object['toponymy_link'] = $relation->word_result_toponymy;
            
            $final_relation_object['examples'] = ModLugatHelper::getWordExamples($relation->relation_result_relation_id);
            $final_relation_object['attributes'] = ModLugatHelper::getWordAttributes($relation->relation_result_relation_id);
            $final_relation_object['word_suggestion'] = ModLugatHelper::getWordRelated($relation->word_result_word, $relation->word_query_word);
            
            $final_relation_object['relevance'] = (50 * (1 - (ceil($relation->relation_result_relevance) / 7)));
            if ($final_relation_object['relevance'] < 0) {
                $final_relation_object['relevance'] = 5;
            };
            
            if ($relation->word_result_part_of_speech != $current_part_of_speech_id) {
                $current_part_of_speech_id = $relation->word_result_part_of_speech;
            }
            $final_object['translations'][$current_part_of_speech_id][] = $final_relation_object;
        }
        
        return $final_object;
    }
    
    private static function composeTranscription($transcription){
        $words = explode(' ', $transcription);
        $result = '';
        foreach($words as $word){
            $chunks = explode('-',$word);
            $replace = [
                'a' => 'á',
                'â' => 'ấ',
                'o' => 'ó',
                'ø' => 'ǿ',
                'u' => 'ú',
                'y' => 'ý',
                'ɯ' => 'ɯ́',
                'ɪ' => 'ɪ́',
                'ɛ' => 'ɛ́',
                '|' => ''
            ];
            foreach($chunks as &$chunk){
                if(strpos($chunk,'|') === 0){
                    $chunk = '<b>'.strtr($chunk, $replace).'</b>';
                }
            }
            $result .= ' '.implode('-',$chunks);
        }
        return trim($result);
    }
    
    
    
    private static function getObjectByWord($word) {
        $db = JFactory::getDbo();
        $lang_config = [
            'en-GB' => '1',
            'ru-RU' => '2'
        ];
        $lang = JFactory::getLanguage();
        $dict_lang_id = $lang_config[$lang->get('tag')];
        $sql = "
        SELECT 
            wl.word_id word_query_word_id,
            wl.word word_query_word,
            wl.part_of_speech_id word_query_part_of_speech_id,
            wl.transcription word_query_transcription,
            wl.relation_id relation_query_relation_id,
            wl.clarification relation_query_clarification,
            wl.toponymy_link word_query_toponymy,
            wl.denotation_id,
            wl.part_of_speech_id denotation_part_of_speech_id,
            wl1.relation_id relation_result_relation_id,
            wl1.relevance relation_result_relevance,
            wl1.word_id word_result_word_id,
            wl1.word word_result_word,
            wl1.transcription word_result_transcription,
            wl1.part_of_speech_id word_result_part_of_speech_id,
            IF(wl1.clarification IS NOT NULL, wl1.clarification, wl.clarification) relation_result_clarification,
            wl1.toponymy_link word_result_toponymy,
            pts.name word_result_part_of_speech
        FROM
            lgt_word_list wl
                JOIN
            lgt_word_list wl1 ON wl.denotation_id = wl1.denotation_id
                AND wl.language_id != wl1.language_id
                        JOIN
                lgt_parts_of_speech pts ON wl1.part_of_speech_id = pts.part_of_speech_id AND pts.language_id = $dict_lang_id
        WHERE
           wl.word = '$word'
        ORDER BY wl1.relevance  
    ";
        // Retrieve the shout
        $db->setQuery($sql);
        $result = $db->loadObjectList();
        
        return $result;
    }
    private static function getWordExamples($relation_id) {
        $db = JFactory::getDbo();
        $lang_config = [
            'en-GB' => '1',
            'ru-RU' => '2'
        ];
        $lang = JFactory::getLanguage();
        $dict_lang_id = $lang_config[$lang->get('tag')];
        $sql = "
            SELECT DISTINCT
                CONCAT((SELECT 
                                example
                            FROM
                                lgt_example_list dl
                            WHERE
                                ul.example_id = dl.example_id
                                    AND language_id != $dict_lang_id),
                        ' - ',
                        (SELECT 
                                example
                            FROM
                                lgt_example_list dl
                            WHERE
                                ul1.example_id = dl.example_id
                                    AND language_id = $dict_lang_id)) AS example
            FROM
                lgt_example_to_relation ul
                    JOIN
                lgt_example_to_relation ul1 ON ul.relation_id != ul1.relation_id
                    AND ul.example_id = ul1.example_id
            WHERE
                ul.relation_id = $relation_id
        ";
        $db->setQuery($sql);
        $result = $db->loadAssocList();
        return $result;
    }
    
    private static function getWordAttributes($relation_id) {
        $db = JFactory::getDbo();
        $lang_config = [
            'en-GB' => '1',
            'ru-RU' => '2'
        ];
        $lang = JFactory::getLanguage();
        $dict_lang_id = $lang_config[$lang->get('tag')];
        $sql = "
            SELECT 
                attrg.name attribute_group_name, attr.name attribute_name, attr2rel.attribute_value
            FROM
                lgt_attribute_to_relation attr2rel
                    LEFT JOIN
                lgt_attributes attr ON attr2rel.attribute_id = attr.attribute_id
                    LEFT JOIN
                lgt_attribute_groups attrg ON attrg.attribute_group_id = attr.attribute_group_id
            WHERE
                    attr2rel.relation_id = $relation_id
                    AND attr.system_language_id = $dict_lang_id
                    AND attrg.system_language_id = $dict_lang_id
        ";
        $db->setQuery($sql);
        $result = $db->loadAssocList();
        return $result;
    }
    
    private static function getWordRelated($word, $query_word) {
        $db = JFactory::getDbo();
        $lang_config = [
            'en-GB' => '1',
            'ru-RU' => '2'
        ];
        $lang = JFactory::getLanguage();
        $dict_lang_id = $lang_config[$lang->get('tag')];
        $sql = "
            SELECT 
                wl1.word_id suggested_word_id,
                wl1.word suggested_word
            FROM
                lgt_word_list wl
                    JOIN
                lgt_word_list wl1 ON wl.denotation_id = wl1.denotation_id
                    AND wl.language_id != wl1.language_id
            WHERE
                 wl1.word != '$query_word'
            ORDER BY wl1.relevance 
            LIMIT 5      
        ";
        $db->setQuery($sql);
        $result = $db->loadAssocList();
        return $result;
    }
    public static function addNotFoundStatistic($input_word) {
        $db = JFactory::getDbo();
        $lang_config = [
            'en-GB' => '1',
            'ru-RU' => '2'
        ];
        $lang = JFactory::getLanguage();
        $dict_lang_id = $lang_config[$lang->get('tag')];
         $sql = "
            INSERT INTO
                lgt_statistic
            SET
                statistic_word = '$input_word',
                statistic_action = 'not_found',
                created_date = NOW()
            ON DUPLICATE KEY UPDATE
                created_date = NOW()
        ";
        $db->setQuery($sql);
        return $db->query();
    }
}


