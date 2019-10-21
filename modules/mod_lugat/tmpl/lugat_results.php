<?php
/**
 * @package Joomla.Site
 * @subpackage mod_firstmodule
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
?>
<div class='info-row'>
            <div class='query-word_block'>
                 <?php if(!empty($lugat['translation']['query_word'])){ ?>
                    <div class="query-word"><?php echo $lugat['translation']['query_word']?></div>
                 <?php  } ?> 
                <?php if(!empty($lugat['translation']['query_word_transcription'])){ ?>
                <div class="query-word-transcription">
                    <?php echo  $lugat['translation']['query_word_transcription'] ?>
                </div>
                <?php  } ?> 
                <?php if(!empty($lugat['translation']['query_attributes'])){ 
                    foreach ($lugat['translation']['query_attributes'] as $attribute){ 
                        if(!empty($attribute)){  ?> 
                            <span class='referent-details tag'>
                                <?php echo $attribute['attribute_name']?>
                        <?php if(!empty($attribute['attribute_value'])){ echo  ' ('.$attribute['attribute_value'].')'; }?>    
                            
                        <?php if(!empty($attribute['attribute_group'])){ ?>
                            <span class='tag-description'><?php echo $attribute['attribute_group'] ?></span>
                        <?php  } ?>   
                            
                            </span>     
                <?php } } } ?>     
            </div>
            <?php  if(isset($lugat['translation']['translations'])){ ?>

                <div class='translations-block'>
                    <div class='part-of-speech-list'>

            <?php  foreach($lugat['translation']['translations'] as $key=>$parts_of_speech){  ?>

                 <div class='part-of-speech-block'>
                            <div class='part-of-speech-name'><?php echo $key ?></div>

            <?php  foreach($parts_of_speech as $key=>$translation){  ?>

                            <div class='denotations-list'>
                                <div class='denotation-block'>
                                    <div class='denotation-info'>
           <!-- <?php if(count($parts_of_speech) > 1){ ?>                               
                                        <span class='denotation-number'><?php echo $key*1+1 ?>)</span>
            <?php  } ?>                         
                                        <span class='denotation-description'></span>
            -->   

                                    </div>

                                    <div class='referents-list'>
                                        <div class='referent-block'>
                                            <div class="relevance">
                                                <div class="relevance-container">
                                                     <div class="relevance-content" style="width: <?php echo $translation['relevance'] ?>px;"></div>
                                                </div>
                                            </div>
            <?php if(!empty($translation['word'])){ ?>                                          
                                            <a class='referent-name' onclick="getWord('<?php echo $translation['word'] ?>'); return false"><?php echo $translation['word'] ?></a>
            <?php  } ?>            
                                            
                                           <!--
                                            <span>
                                                <a class='referent-to-map' target="_blank" href="https://www.google.com/maps/place/Гвардейское+Крым">
                                                    <i class='fa fa-globe'></i>
                                                </a>
                                            </span>   
                                            -->
                                            
            <?php if(!empty($translation['attributes'])){ 
                foreach ($translation['attributes'] as $attribute){ 
                    if(!empty($attribute)){  ?> 
                            <span class='referent-details tag'>
                                <?php echo $attribute['attribute_name']?>
                        <?php if(!empty($attribute['attribute_value'])){ echo  ' ('.$attribute['attribute_value'].')'; }?>    
                            
                            <?php if(!empty($attribute['attribute_group'])){ ?>
                                <span class='tag-description'><?php echo $attribute['attribute_group'] ?></span>
                            <?php  } ?> 
                            
                            </span> 
            <?php  } }  }?> 
            <?php if(!empty($translation['clarification'])){ ?>                                   
                                            <div class='referent-clarification'>( <?php echo $translation['clarification'] ?> )</div>
            <?php  } ?>                  
            <?php if(!empty($translation['word_suggestion'])){ ?>         
                                            <div class="referent-suggestions">
                                                (
                                                <?php foreach($translation['word_suggestion'] as $key=>$suggestion){ ?> 
                                                <a class="suggestion" onclick="getWord('<?php echo $suggestion ?>'); return false"><?php echo $suggestion ?></a> 
                                                <?php 
                                                    if( isset($translation['word_suggestion'][$key+1])){
                                                        echo ',';
                                                    }
                                                
                                                } ?>  
                                                )
                                            </div>
              <?php  } ?>                                  
                                        </div>
                                    </div>
                                </div>
                            </div>
            <?php  } ?>                

                        </div>
             <?php  } ?>              
                    </div>
                </div>
             <?php  } ?>  
        </div>


<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("lugat-head");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>

