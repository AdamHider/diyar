<?php
class modMorphologyHelper {

    private static $tenses_list = [
        'verb' => [
            's'
        ]
    ];
    public static function init(){
        $word_list = modMorphologyHelper::getwords();
        foreach($word_list as $word){
            $morphology = modMorphologyHelper::getMorph($word->word, $word->part_of_speech_id);
            modMorphologyHelper::update($word->word, $word->part_of_speech_id, $morphology);
        }
    }
    
    public static function getMorph($word, $part_of_speech_id){
        include 'fillDiyarMorphology_alphabet.php';
        modMorphologyHelper::initiateVariables($part_of_speech_id);
        $tense_combined = [];
        foreach(modMorphologyHelper::$tenses_list as $glob_tense){
            foreach($glob_tense as $key => $tense){
                $tense_unified = [];
                $tense_combined[$key] = $tense;
            }
        }
        $result = [];
        foreach($tense_combined as $key => $tense){
            $inflection_object = 
            $result[$key]['data'] = modMorphologyHelper::composeInflection($word, $tense);
            $result[$key]['template'] = $tense['template'];
            $result[$key]['group'] = $tense['group'];
        }
        
        return $result;
    }

    public static function getwords(){
        $db = JFactory::getDbo();
         $sql = "
            SELECT 
                word, part_of_speech_id
            FROM
                diyar_db.lgt_word_list
            WHERE
                language_id = 1
                    AND part_of_speech_id IN (1 , 2, 26, 10)
                    AND word NOT LIKE '% %'
                    AND toponymy IS NULL
            GROUP BY BINARY word
        ";
        $db->setQuery($sql);
        $result = $db->loadObjectList();
        return $result;
    }
    
    public static function update($word, $part_of_speech_id, $result){
        $db = JFactory::getDbo();
         echo $sql = "
            INSERT INTO
                lgt_morphology
            SET
                word = '$word', 
                part_of_speech_id = '$part_of_speech_id', 
                morphology = '".(json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES  ))."'
        ";
         die;
        $db->setQuery($sql);
        return $db->query();
    }
    
    public static function initiateVariables($part_of_speech_id){
        include 'fillDiyarMorphology_tenses.php';
        include 'fillDiyarMorphology_tenses_negative.php';
        include 'fillDiyarMorphology_moods.php';
        include 'fillDiyarMorphology_moods_negative.php';
        include 'fillDiyarMorphology_noun_plurality.php';
        include 'fillDiyarMorphology_noun_cases.php';
        if($part_of_speech_id == '26'){
            modMorphologyHelper::$tenses_list  = [$tenses, $tenses_negative, $moods, $moods_negative];
        } else if ($part_of_speech_id == '1'
                || $part_of_speech_id == '2'
                || $part_of_speech_id == '3'
                || $part_of_speech_id == '10'){
            modMorphologyHelper::$tenses_list  = [$noun_plurality, $noun_cases];
        } else if ($part_of_speech_id == '18'){
            return;
            //modMorphologyHelper::$tenses_list  = [$tenses, $tenses_negative, $moods, $moods_negative];
        }
    }
    
    public static function composeInflection($word,$tense){
        include 'fillDiyarMorphology_alphabet.php';
        include 'fillDiyarMorphology_tenses.php';
        include 'fillDiyarMorphology_tenses_negative.php';
        include 'fillDiyarMorphology_moods.php';
        include 'fillDiyarMorphology_moods_negative.php';
        include 'fillDiyarMorphology_noun_plurality.php';
        include 'fillDiyarMorphology_noun_cases.php';
        $word_analysis = modMorphologyHelper::getWordAnalysis($word);
        $last_letter = mb_substr($word_analysis['word_base'], -1);
        $sonority_type = '';

        if($qt_alphabet[$last_letter]['type'] == 'vowel'){
            $sonority_type = 'vowel';
        } else {
            if($qt_alphabet[$last_letter]['sonorous']){
                $sonority_type = 'sonorous';
            } else {
                $sonority_type = 'non_sonorous';
            }
        }
        if($word_analysis['syllable_quantity'] == 1){
            $syllable_quantity = 'single_syllable';
        } else {
            $syllable_quantity = 'multi_syllable';
        }
        $result = [];
        $plurality_result = [];
        $inflection_template = $tense[$word_analysis['agglutination_mark']][$sonority_type][$syllable_quantity];
        foreach ($inflection_template as $plurality){
            foreach($plurality as &$person){
                $word_base = modMorphologyHelper::checkLastLetter($word_analysis['word_base'], $person,$syllable_quantity);
                $last_syllable = array_reverse($word_analysis['syllables_list'])[0];
                if(strpos($person,'|')>-1){
                    $person_variants = explode('|', $person);
                    if(strpos($last_syllable, 'o')>-1 || strpos($last_syllable, 'u')>-1){
                        $person = $person_variants[1];
                    } else{
                        $person = $person_variants[0];
                    }
                }
                //$stress = '́';
                $stress = '\'';
                if(mb_strpos($person, '*') === false && mb_strpos($word_base, '\'') === false){
                    $word_base = str_replace($last_syllable, modMorphologyHelper::setStressOnSyllable($last_syllable, $stress), $word_base);
                }

                $person = str_replace('*', $stress, $person);
                $plurality_result[] = $word_base.$person;
            }

        }
        return $plurality_result;


    }

    public static function getWordAnalysis($word){
        $word_analysis = [
            'word_base' => $word,
            'agglutination_mark' => '',
            'syllables_list' => '',
            'syllable_quantity' => ''
        ];
        if(strpos($word, 'maq')>-1){
            $word_analysis['word_base'] = str_replace('maq', '', $word);
        } else if (strpos($word,'mek')>-1){
            $word_analysis['word_base'] = str_replace('mek', '', $word);
        }
        $word_syllables = modMorphologyHelper::getSyllables($word_analysis['word_base']);
        $word_analysis['syllables_list'] = $word_syllables;
        $word_analysis['agglutination_mark'] = modMorphologyHelper::getAgglutinationMark(array_reverse($word_analysis['syllables_list'])[0]);
        $word_analysis['syllable_quantity'] = count($word_syllables);
        return $word_analysis;
    }
    //morphologyNormalize(['et','ke','niñ','ni']);
    //die;
    public static function morphologyNormalize($word_chunks){
        $translated_word = modMorphologyHelper::findWord(implode('', $word_chunks));
        if($translated_word){
            return $translated_word;
        }
        if(is_array($word_chunks) &&  count($word_chunks)>0 && !$translated_word){
            $last_chunk = array_pop($word_chunks);


            if(strpos($last_chunk, 'ey') >-1  && strpos($last_chunk, 'mek') == -1){
                array_push($word_chunks, str_replace('ey','mek',$last_chunk));
            }
            if(substr($last_chunk, -1) === 'e' && strpos($last_chunk, 'mek') == -1){
                array_push($word_chunks, str_replace('e','mek',$last_chunk));
            }




            return morphologyNormalize($word_chunks);
        }else {
            return false;
        }
    }


    public static function checkLastLetter($word_base, $person, $syllable_quantity){
        include 'fillDiyarMorphology_alphabet.php';
        $first_person_letter = mb_substr($person, 0, 1);
        if($first_person_letter == '*'){
            $first_person_letter = mb_substr($person, 1, 1);
        }
        if(!empty($first_person_letter) && $qt_alphabet[$first_person_letter]['type'] == 'vowel'){
            $last_letter = mb_substr($word_base, -1, 1);
          /*  if($qt_alphabet[$last_letter]['type'] == 'vowel'){
                $word_base .= 'y';
            }*/
            $exit = ['tüp', 'cep', 'yaq'];
            if(!in_array($word_base, $exit) && $syllable_quantity == 'single_syllable'){
                return $word_base;
            }
            if($last_letter == 'q' ){
                $word_base = mb_substr($word_base, 0, -1);
                $word_base .= 'ğ';
            } else if($last_letter == 'k' ){
                $word_base = mb_substr($word_base, 0, -1);
                $word_base .= 'g';
            } else if($last_letter == 'p' ){
                $word_base = mb_substr($word_base, 0, -1);
                $word_base .= 'b';
            }
        }
        return $word_base;
    }

    public static function getSyllables($word_string){
        include 'fillDiyarMorphology_alphabet.php';
        $word_string = '['.$word_string;
        $word_string .= ']';
        $word_array = modMorphologyHelper::str_split_unicode($word_string, 1);
        $chunk_array = [];
        $new_chunk = '';

        for($i = 1; $i < count($word_array); $i++){
            if($word_array[$i] == ']'){
                continue;
            }

            $prev_letter = '';
            $prev_type = '';
            if($word_array[$i-1] != '['){
                $prev_letter = key($qt_alphabet[mb_strtolower($word_array[$i-1])]);
                $prev_type = $qt_alphabet[mb_strtolower($word_array[$i-1])]['type'];
            }
            $curr_letter = key($qt_alphabet[mb_strtolower($word_array[$i])]);
            $curr_type = $qt_alphabet[mb_strtolower($word_array[$i])]['type'];


            $next_letter = '';
            $next_type = '';
            if($word_array[$i+1] != ']'){
                $next_letter = key($qt_alphabet[mb_strtolower($word_array[$i+1])]);
                $next_type = $qt_alphabet[mb_strtolower($word_array[$i+1])]['type'];
            }
            $ultra_next_letter = '';
            $ultra_next_type = '';
            if(isset($word_array[$i+2]) && $word_array[$i+2] != ']'){
                $ultra_next_letter = key($qt_alphabet[mb_strtolower($word_array[$i+2])]);
                $ultra_next_type = $qt_alphabet[mb_strtolower($word_array[$i+2])]['type'];
            }
            $new_chunk .= $word_array[$i];
            if($curr_type == 'vowel'){
                if($next_type == 'consonant' && $ultra_next_type == 'vowel'){
                    $chunk_array[] = $new_chunk;
                    $new_chunk='';
                    continue;
                } else
                if($next_type == 'vowel' && $ultra_next_type == 'consonant'){
                    $chunk_array[] = $new_chunk;
                    $new_chunk='';
                    continue;
                } else
                if($prev_type == ''){
                    if($next_type == 'consonant' && $ultra_next_type == 'vowel'){
                        $chunk_array[] = $new_chunk;
                        $new_chunk='';
                    continue;
                    } else
                    if($next_type == 'vowel' && $ultra_next_type == 'consonant'){
                        $chunk_array[] = $new_chunk;
                        $new_chunk='';
                        continue;
                    }
                }
            } else
            if($curr_type == 'consonant'){
                if($next_type == 'consonant' && $ultra_next_type == 'vowel' && $prev_type != ''){
                    $chunk_array[] = $new_chunk;
                    $new_chunk='';
                    continue;
                }
            }
            if($next_letter == '' ){
                $chunk_array[] = $new_chunk;
                break;
            }
        }
        return $chunk_array;
    }

    public static function findWord($word_string){
        global $mysqli;
         $sql = "
            SELECT
                article
            FROM
                qirim_english_dictionary.tmp_final
            WHERE BINARY
                LCASE(word)  = '$word_string'
            ORDER BY relevance
            ";
        $result = mysqli_fetch_all($mysqli->query($sql));
        return array_column($result, 0);
    }

    public static function checkAffiks($chunk){
         global $mysqli;
         $sql = "
            SELECT
                article, word
            FROM
                qirim_english_dictionary.tmp_final
            WHERE
                word = CONCAT('-','$chunk')
            ";
        $result = mysqli_fetch_all($mysqli->query($sql));
        return array_column($result, 0);
    }

    public static function setStressOnSyllable($syllable, $stress){
        include 'fillDiyarMorphology_alphabet.php';
        $syllable_array = modMorphologyHelper::str_split_unicode($syllable, 1);
        foreach($syllable_array as &$letter){
            if($qt_alphabet[$letter]['type'] == 'vowel'){
                $letter = $stress.$letter;
            }
        }
        return implode('', $syllable_array);
    }

    public static function getAgglutinationMark($syllable){
        include 'fillDiyarMorphology_alphabet.php';
        $syllable_array = modMorphologyHelper::str_split_unicode($syllable, 1);
        foreach($syllable_array as &$letter){
            if($qt_alphabet[$letter]['type'] == 'vowel'){
                if($qt_alphabet[$letter]['soft']){
                    return 'soft';
                }
                return 'hard';
            }
        }
    }

    public static function str_split_unicode($str, $l = 0) {
        if ($l > 0) {
            $ret = array();
            $len = mb_strlen($str, "UTF-8");
            for ($i = 0; $i < $len; $i += $l) {
                $ret[] = mb_substr($str, $i, $l, "UTF-8");
            }
            return $ret;
        }

    }
}