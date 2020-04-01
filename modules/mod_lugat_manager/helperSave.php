<?php
class ModLugatManagerHelperSave {


public static function checkRelation($relation, $query_object, $index) {
if($relation['action'] == ''){
return;
}
if($relation['action'] == 'delete'){
if(strpos($relation['relation_id'], 'DIY') > -1){
return 0;
}
ModLugatManagerHelperSave::deleteRelation($relation['relation_id']);
} else {

if(strpos($relation['relation_id'], 'DIY') > -1 && !empty($relation['word'])){
ModLugatManagerHelperSave::addStatistic($query_object['word'],'insert');
$new_relations = ModLugatManagerHelperSave::insertRelation($relation, $query_object);
}
if(isset($new_relations)){
$relation['relation_id'] = $new_relations['new_relation']['relation_id'];
} else {
$new_relations = false;
}
if($relation['action'] == 'update'){
ModLugatManagerHelperSave::addStatistic($query_object['word'],$relation['action']);
ModLugatManagerHelperSave::updateRelation($relation);
}
return $new_relations;
}
return 0;
}

private static function deleteRelation($old_relation_id){
$db = JFactory::getDbo();
$result = false;
$relation_ids_array = ModLugatManagerHelperSave::getIdOfEmptyRelation($old_relation_id);
if(empty($relation_ids_array)){
$relation_ids_array = [$old_relation_id];
}
foreach($relation_ids_array as $relation_id){
ModLugatManagerHelperSave::deleteRelationAttributes($relation_id);
ModLugatManagerHelperSave::deleteRelationExamples($relation_id);
$sql = "
DELETE FROM
lgt_word_list
WHERE
relation_id = ".$relation_id."
";
$db->setQuery($sql);
$result = $db->query();
}
return $result;
}

private static function updateRelation($relation){
$db = JFactory::getDbo();
$transcription = '';
if(isset($relation['transcription'])){
$transcription = $relation['transcription'];
}

$sql = "
UPDATE
lgt_word_list
SET
word = '".$relation['word']."',
transcription = '".$transcription."',
part_of_speech_id = ".$relation['part_of_speech_id'].",
clarification = '".$relation['clarification']."',
relevance = '".$relation['relevance']."'
WHERE
relation_id = ".$relation['relation_id']."
";
$db->setQuery($sql);
$result = $db->query();
return $result;
}

private static function insertRelation($in_relation, $query_object){
$db = JFactory::getDbo();
$new_relations = ModLugatManagerHelperSave::composeForInsert($in_relation, $query_object);


foreach($new_relations as &$relation){
$sql = "
INSERT INTO
lgt_word_list
SET
word_id = 0,
word = '".$relation['word']."',
language_id = ".$relation['language_id'].",
transcription = '".$relation['transcription']."',
relevance = '".$relation['relevance']."',
part_of_speech_id = ".$relation['part_of_speech_id'].",
clarification = '".$relation['clarification']."',
denotation_id = ".$relation['denotation_id']."
";
$db->setQuery($sql);
$db->query();
$relation['relation_id'] = $db->insertid();

if($in_relation['relation_id'] === $query_object['relation_id']){
return ['new_relation'=>$relation];
}
}
return $new_relations;
}

private static function deleteRelationAttributes($relation_id){
$db = JFactory::getDbo();
$sql = "
DELETE FROM
lgt_attribute_to_relation
WHERE
relation_id = ".$relation_id."
";
$db->setQuery($sql);
$result = $db->query();
return $result;
}

private static function deleteRelationExamples($relation_id){
$db = JFactory::getDbo();
$sql = "
DELETE FROM
lgt_example_to_relation
WHERE
relation_id = ".$relation_id."
";
$db->setQuery($sql);
$result = $db->query();
return $result;
}

public static function checkAttributes($attributes, $relation_id) {
ModLugatManagerHelperSave::deleteAllAttributes($relation_id);
if(!empty($attributes)){
ModLugatManagerHelperSave::insertAllAttributes($attributes, $relation_id);
}
}

private static function deleteAllAttributes($relation_id){
$db = JFactory::getDbo();
$sql = "
DELETE FROM
lgt_attribute_to_relation
WHERE
relation_id = ".$relation_id."
";
$db->setQuery($sql);
$result = $db->query();
return $result;
}

private static function insertAllAttributes($attributes, $relation_id){
$db =
JFactory::getDbo();
$result = false;
for($i = 0; $i < count($attributes); $i++){
if($attributes[$i]['action'] == 'delete'){
continue;
}
$value = " attribute_value = NULL,";
if(!empty($attributes[$i]['attribute_value'])){
$value = " attribute_value = '".$attributes[$i]['attribute_value']."',";
}
$sql = "
INSERT INTO
lgt_attribute_to_relation
SET
relation_id = ".$relation_id.",
attribute_id = ".$attributes[$i]['attribute_id'].",
$value
tstamp = NOW()
";
$db->setQuery($sql);
$result = $db->query();
}
return $result;
}

public static function checkExamples($examples, $relation_id, $query_relation_id, $query_language_id, $relation_language_id) {
foreach($examples as $example){
if($example['action'] == ''){
continue;
}
$example_composed = ModLugatManagerHelperSave::composeExample($example, $relation_id, $query_relation_id, $query_language_id, $relation_language_id);
if($example['action'] == 'delete'){
if(strpos($example['example_id'], 'DIY') > -1){
return;
}
ModLugatManagerHelperSave::deleteExample($example_composed);
} else {

if(strpos($example['example_id'], 'DIY') > -1){
ModLugatManagerHelperSave::insertExample($example_composed);
} else {
ModLugatManagerHelperSave::updateExample($example_composed);
}
}
}
}

private static function deleteExample($example_composed){
$db = JFactory::getDbo();
$sql_relation_result = false;
$sql_self = "
DELETE FROM
lgt_example_list
WHERE
example_id = ".$example_composed[0]['example_id']."
";
$db->setQuery($sql_self);
$sql_self_result = $db->query();
foreach($example_composed as $example){
$sql_relation = "
DELETE FROM
lgt_example_to_relation
WHERE
example_id = ".$example['example_id']."
AND relation_id = ".$example['relation_id']."
";
$db->setQuery($sql_relation);
$sql_relation_result = $db->query();
}
return $sql_relation_result;
}

private static function updateExample($example_composed){
$db = JFactory::getDbo();
$result = false;
foreach($example_composed as $example){
$sql = "
UPDATE
lgt_example_list
SET
example = '".$example['example']."'
WHERE
example_id = ".$example['example_id']."
AND language_id = '".$example['language_id']."'
";
$db->setQuery($sql);
$result = $db->query();
}

return $result;
}

private static function insertExample($example_composed){
$db = JFactory::getDbo();
$result = false;
$last_example = ModLugatManagerHelperSave::getLastExampleId()+1;
foreach($example_composed as $example){

$sql = "
INSERT INTO
lgt_example_list
SET
example_id = ".$last_example.",
language_id = ".$example['language_id'].",
example = '".$example['example']."'
";
$db->setQuery($sql);
$db->query();

$sql1 = "
INSERT INTO
lgt_example_to_relation
SET
relation_id = '".$example['relation_id']."',
language_id = ".$example['language_id'].",
example_id = ".$last_example."
";
$db->setQuery($sql1);
$result = $db->query();
}

return $result;
}

private static function composeExample($example, $relation_id, $query_relation_id, $query_language_id, $relation_language_id){
if($relation_id){
$example['related_example_relation_id'] = $relation_id;
}
if($query_relation_id){
$example['query_example_relation_id'] = $query_relation_id;
}

return [
0 => [
'relation_id' => $example['query_example_relation_id'],
'example_id' => $example['example_id'],
'language_id' => $query_language_id,
'example' => $example['query_example']
],
1 => [
'relation_id' => $example['related_example_relation_id'],
'example_id' => $example['example_id'],
'language_id' => $relation_language_id,
'example' => $example['related_example']
]
];

}

private static function getLastDenotationId(){
$db = JFactory::getDbo();
$sql = "
SELECT
MAX(denotation_id) as last_denotation
FROM
lgt_word_list
";
$db->setQuery($sql);
$result = $db->loadAssocList();
return $result[0]['last_denotation'];
}

private static function getLastExampleId(){
$db = JFactory::getDbo();
$sql = "
SELECT
MAX(example_id) as last_example
FROM
lgt_example_list
";
$db->setQuery($sql);
$result =
$db->loadAssocList();
return $result[0]['last_example'];
}

private static function getIdOfEmptyRelation($relation_id){
$db = JFactory::getDbo();
$sql = "
SELECT
wl.relation_id relation_id_needed, wl1.relation_id related_relation_id
FROM
lgt_word_list wl
LEFT JOIN
lgt_word_list wl1
ON wl.denotation_id = wl1.denotation_id
AND wl.language_id != wl1.language_id
WHERE wl.relation_id = $relation_id
";
$db->setQuery($sql);
$result = $db->loadAssocList();
return $result[0];
}

private static function composeForInsert($relation, $query_object){
$last_denotation = ModLugatManagerHelperSave::getLastDenotationId()+1;
$relation['denotation_id'] = $last_denotation;
$query_object['denotation_id'] = $last_denotation;
if($query_object['language_id'] == 1){
$relation['language_id'] = '2';
} else {
$relation['language_id'] = 1;
}
if($relation['part_of_speech_id'] == 0){
$relation['part_of_speech_id'] = 1;
}
if(!isset($query_object['relevance'])){
$query_object['relevance'] = 1;
}
return ['new_relation'=>$relation, 'query_relation'=>$query_object];
}
public static function addStatistic($query_word, $action) {
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
statistic_word = '$query_word',
statistic_action = '$action',
created_date = NOW()
ON DUPLICATE KEY UPDATE
created_date = NOW()
";
$db->setQuery($sql);
return $db->query();
}
}