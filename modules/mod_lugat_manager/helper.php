<?php

class ModLugatManagerHelper {

    public static function init($params) {
        $input_word = JFactory::getApplication()->input->get('word', '', 'string');
        $param = [
            'header' => 'Lugat Manager',
            'input_type' => 'text',
            'input_value' => $input_word,
            'input_placeholder' => 'Type your text...'
        ];
        return $param;
    }

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

    public static function saveChangesAjax() {
        $word_object = JRequest::getVar('word_object', '', 'post');
        include "helperSave.php";
        $ModLugatManagerHelperSave = new ModLugatManagerHelperSave();
        foreach ($word_object as $index => $relation) {
            $new_relations = $ModLugatManagerHelperSave->checkRelation($relation, $word_object[0], $index);
            if (count($new_relations) == 1) {
                $word_object[0] = $new_relations['new_relation'];
                continue;
            }
            $query_relation_id = false;
            $query_language_id = $word_object[0]['language_id'];
            $new_relation_language_id = $relation['language_id'];
            if ($new_relations) {
                $query_language_id = $new_relations['query_relation']['language_id'];
                $new_relation_language_id = $new_relations['new_relation']['language_id'];
                $relation['relation_id'] = $new_relations['new_relation']['relation_id'];
                $query_relation_id = $new_relations['query_relation']['relation_id'];
            }
            if (!empty($relation['attributes'])) {
                $ModLugatManagerHelperSave->checkAttributes($relation['attributes'], $relation['relation_id']);
                ModLugatManagerHelperSave::addStatistic($word_object[0]['word'], 'update');
            }
            if (!empty($relation['examples'])) {
                $ModLugatManagerHelperSave->checkExamples($relation['examples'], $relation['relation_id'], $query_relation_id, $query_language_id, $new_relation_language_id);
                ModLugatManagerHelperSave::addStatistic($word_object[0]['word'], 'update');
            }
        }
    }

    public static function getTranslation($input_word) {
        $result = ModLugatManagerHelper::composeObject(ModLugatManagerHelper::getObjectByWord($input_word));
        if (empty($result)) {
            $result = ModLugatManagerHelper::getEmptyTranslation($input_word);
        }
        return $result;
    }

    private static function composeObject($relations) {
        $final_object = [];
        $translation = [];
        foreach ($relations as $relation) {
            $final_object['query_object']['relation_id'] = $relation->relation_query_relation_id;
            $final_object['query_object']['word'] = $relation->word_query_word;
            $final_object['query_object']['language_id'] = $relation->word_query_language_id;
            $final_object['query_object']['part_of_speech_id'] = $relation->word_query_part_of_speech_id;
            $final_object['query_object']['clarification'] = $relation->relation_query_clarification;
            $final_object['query_object']['relevance'] = $relation->relation_query_relevance;
            $final_object['query_object']['attributes'] = ModLugatManagerHelper::getWordAttributes($relation->relation_query_relation_id);
            $final_object['query_object']['transcription'] = $relation->word_query_transcription;
            $final_object['query_object']['denotation_id'] = $relation->denotation_id;
            $final_object['query_object']['action'] = '';
            $translation['word'] = $relation->word_result_word;
            $translation['part_of_speech_id'] = $relation->word_result_part_of_speech_id;
            $translation['query_relation_id'] = $relation->relation_query_relation_id;
            $translation['relation_id'] = $relation->relation_result_relation_id;
            $translation['denotation_id'] = $relation->result_denotation_id;
            $translation['language_id'] = $relation->relation_result_language_id;
            $translation['clarification'] = $relation->relation_result_clarification;
            $translation['examples'] = ModLugatManagerHelper::getWordExamples($relation->relation_result_relation_id, $relation->relation_query_relation_id);
            $translation['attributes'] = ModLugatManagerHelper::getWordAttributes($relation->relation_result_relation_id);
            $translation['relevance'] = $relation->relation_result_relevance;
            if ($translation['relevance'] < 0) {
                $translation['relevance'] = 5;
            };
            $translation['action'] = '';
            $final_object['translations'][] = $translation;
        }
        return $final_object;
    }

    public static function getEmptyTranslation($word) {
        $final_object = [];
        if ((bool) preg_match('/[а-яА-Я]/u', $word)) {
            $language_id = 2;
        } else {
            $language_id = 1;
        }
        $final_object['query_object']['relation_id'] = 'DIY' . rand(100, 1000);
        $final_object['query_object']['word'] = $word;
        $final_object['query_object']['language_id'] = $language_id;
        $final_object['query_object']['part_of_speech_id'] = 1;
        $final_object['query_object']['clarification'] = '';
        $final_object['query_object']['relevance'] = 1;
        $final_object['query_object']['attributes'] = [];
        $final_object['query_object']['transcription'] = '';
        $final_object['query_object']['denotation_id'] = 0;
        $final_object['query_object']['action'] = 'add';
        $final_object['translations'] = [];
        return $final_object;
    }

    private static function composeTranscription($transcription) {
        $words = explode(' ', $transcription);
        $result = '';
        foreach ($words as $word) {
            $chunks = explode('-', $word);
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
            foreach ($chunks as &$chunk) {
                if (strpos($chunk, '|') === 0) {
                    $chunk = strtr($chunk, $replace);
                }
            }
            $result .= ' ' . implode('-', $chunks);
        }
        return trim($result);
    }

    private static function getObjectByWord($word) {
        $db = JFactory::getDbo();
        $dict_lang_id = ModLugatManagerHelper::getCurrentLanguageId();
        $sql = "
SELECT
wl.word_id word_query_word_id,
wl.word word_query_word,
wl.language_id word_query_language_id,
wl.part_of_speech_id word_query_part_of_speech_id,
wl.transcription word_query_transcription,
wl.relation_id relation_query_relation_id,
wl.clarification relation_query_clarification,
wl.relevance relation_query_relevance,
wl.toponymy_link word_query_toponymy,
wl.denotation_id,
wl.part_of_speech_id denotation_part_of_speech_id,
wl1.relation_id relation_result_relation_id,
wl1.language_id relation_result_language_id,
wl1.relevance relation_result_relevance,
wl1.word_id word_result_word_id,
wl1.word word_result_word,
wl1.denotation_id result_denotation_id,
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
BINARY wl.word = BINARY '$word'
ORDER BY wl1.relevance
";
        $db->setQuery($sql);
        $result = $db->loadObjectList();
        return $result;
    }

    private static function getWordExamples($relation_id, $query_relation_id) {
        $db = JFactory::getDbo();
        $dict_lang_id = ModLugatManagerHelper::getCurrentLanguageId();
        $sql = "
SELECT
dl.example_id,
dl.language_id related_language_id,
dl.example related_example,
'$query_relation_id' as related_example_relation_id,

relation_id query_example_relation_id,
dl1.language_id query_language_id,
dl1.example query_example,
'' action
FROM
lgt_example_list dl
JOIN
lgt_example_to_relation ul USING (example_id)
JOIN
lgt_example_list dl1 ON dl1.example_id = dl.example_id
AND dl1.language_id != dl.language_id
JOIN
lgt_word_list wl USING (relation_id)
WHERE
ul.relation_id = $relation_id
AND dl.language_id = wl.language_id
";
        $db->setQuery($sql);
        $result = $db->loadAssocList();
        return $result;
    }

    private static function getWordAttributes($relation_id) {
        $db = JFactory::getDbo();
        $dict_lang_id = ModLugatManagerHelper::getCurrentLanguageId();
        $sql = "
SELECT
attr.attribute_id,
attrg.attribute_group_id,
attrg.name attribute_group_name,
attr.name
attribute_name,
attr2rel.attribute_value,
'' action
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

    public static function getAllAttributes() {
        $db = JFactory::getDbo();
        $dict_lang_id = ModLugatManagerHelper::getCurrentLanguageId();

        $sql = "
SELECT
a.attribute_id,
attribute_group_id,
a.name attribute_name,
ag.name attribute_group_name,
IF(attribute_group_id = 5, TRUE, FALSE) as has_value
FROM
lgt_attributes a
JOIN
lgt_attribute_groups ag USING (attribute_group_id)
WHERE
a.system_language_id = $dict_lang_id
AND ag.system_language_id = $dict_lang_id
GROUP BY a.attribute_id
";
        $db->setQuery($sql);
        $result_db = $db->loadAssocList();
        $result = ModLugatManagerHelper::composeAllAttributes($result_db);
        return $result;
    }

    private static function composeAllAttributes($all_attributes) {
        $result = [];
        foreach ($all_attributes as $attribute) {
            $result[$attribute['attribute_group_id']]['attribute_group_id'] = $attribute['attribute_group_id'];
            $result[$attribute['attribute_group_id']]['attribute_group_name'] = $attribute['attribute_group_name'];
            $result[$attribute['attribute_group_id']]['attributes'][] = $attribute;
        }
        return $result;
    }

    public static function getAllPartsOfSpeech() {
        $db = JFactory::getDbo();
        $dict_lang_id = ModLugatManagerHelper::getCurrentLanguageId();
        $sql = "
SELECT
part_of_speech_id,
abbreviation,
name part_of_speech_name
FROM
lgt_parts_of_speech
WHERE
language_id = $dict_lang_id
";
        $db->setQuery($sql);
        $result = $db->loadAssocList();
        return $result;
    }

    private static function getCurrentLanguageId() {
        $lang_config = [
            'en-GB' => '1',
            'ru-RU' => '2'
        ];
        $lang = JFactory::getLanguage();
        return $lang_config[$lang->get('tag')];
    }

}
