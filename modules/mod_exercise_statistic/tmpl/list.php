<?php
defined('_JEXEC') or die;
$user = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
$active_language = JFactory::getLanguage()->get('tag');
?>

<ul id="tabs">
    <li><a id="tab1"><?php  echo JText::_('MOD_EXERCISE_STATISTIC_TEXT_RATING_LIST'); ?></a></li>
    <li><a id="tab2"><?php  echo JText::_('MOD_EXERCISE_STATISTIC_TEXT_RATING_CHART'); ?></a></li>
    <li><a id="tab3"><?php  echo JText::_('MOD_EXERCISE_STATISTIC_TEXT_EXERCISE_HISTORY'); ?></a></li>
</ul>
<div class="container statistic-common-list" id="tab1C">
    <?php if(!empty($exercise_statistic['statistic_common'])){ ?>
            <div class="first-row statistic-head">
                <div class="column">
                    <label>#</label>
                </div>
                <div class="column">
                    <label><?php  echo JText::_('MOD_EXERCISE_STATISTIC_TEXT_USER_NAME'); ?>: </label>
                </div>
                <div class="column">
                    <label><?php  echo JText::_('MOD_EXERCISE_STATISTIC_TEXT_POINTS'); ?>: </label>
                </div>
            </div> 
    <?php foreach($exercise_statistic['statistic_common'] as $common_statistic_row){ ?>
            <div class="statistic-common-block <?php if($common_statistic_row->user_id == $user->id){ echo 'current-user'; } ?>">
                <div class="diyar-row">
                    <div class="column">
                        <?php echo $common_statistic_row->rowNumber?>
                    </div>
                    <div class="column">
                        <img src="<?php echo $common_statistic_row->avatar_link; ?>" width="30px"/> 
                        <span class="username"><?php echo $common_statistic_row->name?></span>
                    </div>
                    <div class="column">
                        <?php echo $common_statistic_row->total_points; ?>
                    </div>
                </div>    
            </div>
        <?php } ?>
     <?php } else {?>
        <div class='exercise_empty_message' >
            You have not passed any exercise yet.
        </div>
     <?php } ?>
</div>

<div class="container" id="tab2C">
    <canvas id="myChart"></canvas>
</div>

<div class="container statistic-list" id="tab3C">
     <?php if(!empty($exercise_statistic['statistic_list'])){ ?>
            <div class="first-row statistic-head">
                <div class="column">
                    <label><?php  echo JText::_('MOD_EXERCISE_STATISTIC_TEXT_LESSON'); ?>: </label>
                </div>
                <div class="column exercise_name">
                    <label><?php  echo JText::_('MOD_EXERCISE_STATISTIC_TEXT_EXERCISE'); ?>: </label>
                </div>
                <div class="column">
                    <label><?php  echo JText::_('MOD_EXERCISE_STATISTIC_TEXT_POINTS'); ?>:</label>
                </div>
                <div class="column">
                    <label><?php  echo JText::_('MOD_EXERCISE_STATISTIC_TEXT_DATE'); ?>:</label>
                </div>
            </div>  
       <?php foreach($exercise_statistic['statistic_list'] as $statistic){ ?>
            <div class="statistic-block">
                <div class="diyar-row">
                    <div class="column">
                        <a class="" href="<?php echo JURI::base().'index.php?'.$statistic->article_url;?>"><?php echo $statistic->article_title?></a>  
                    </div>
                    <div class="column exercise_name">
                         <a class="" href="<?php echo JText::_('MOD_EXERCISE_STATISTIC_LINK_GO_EXERCISE'); ?><?php echo $statistic->exercise_id?>&action=view">
                        <?php  echo JText::_('MOD_EXERCISE_STATISTIC_SUPERIORITY_'.$statistic->is_basic).' '; ?>
                        <?php if(!empty($statistic->exercise_head->headvalues)){
                            foreach ($statistic->exercise_head->headvalues as $headvalue_id => $headvalue){ 
                            if(!empty($headvalue) && $headvalue->language == $active_language){  ?>   
                               <?php echo $headvalue->value ?>
                        <?php  } 
                        }}  echo JText::_('MOD_EXERCISE_STATISTIC_DIFFICULTY_TEXT_'.$statistic->exercise_difficulty).' ('.$statistic->question_quantity.' '.JText::_('MOD_EXERCISE_STATISTIC_TEXT_QUESTIONS_QUANTITY').')';?> 
                       </a>
                    </div> 
                    <div class="column">
                        <?php echo $statistic->points; ?>/<?php echo $statistic->max_possible_points; ?>
                    </div>
                    <div class="column">
                        <?php echo ModExerciseStatisticHelper::calculateDate($statistic->created_at); ?> 
                    </div>
                </div>    
            </div>
        <?php } ?>
     <?php } else {?>
        <div class='exercise_empty_message' >
            You have not passed any exercise yet.
        </div>
     <?php } ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    var $ = jQuery;
    var autocomplete_results = [];
    var current_letter = '';
    var keyboard_is_active = false;

    function init() {
        $('#tabs li a:not(:first)').addClass('inactive');
        $('.container').hide();
        $('.container:first').show();

        $('#tabs li a').click(function () {
            var t = $(this).attr('id');
            if ($(this).hasClass('inactive')) { //this is the start of our condition 
                $('#tabs li a').addClass('inactive');
                $(this).removeClass('inactive');

                $('.container').hide();
                $('#' + t + 'C').fadeIn('slow');
            }
        });
        chartInit();
    };
    
    function chartInit(){
        var chartData = composeChartData();
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($exercise_statistic['statistic_chart']['dates']['labels']) ?>,
                datasets: <?php echo json_encode($exercise_statistic['statistic_chart']['users']) ?>
            },
            options: {
                legend: {
                    display: true,
                    labels: {
                        usePointStyle: true,
                        fillStyle: 'rgb(255, 99, 132)',
                        boxWidth: 40
                    }
                },
                scales: {
                    pointLabels :{
                        fontStyle: "bold",
                    },
                    yAxes: [{
                        ticks: {
                            beginAtZero: false,
                            maxTicksLimit: 20
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            maxTicksLimit: 20,
                        },
                    }]
                }
            }
        });
    }
    
    function composeChartData(){
        var common_statistic = [<?php echo json_encode($exercise_statistic['statistic_chart']); ?>];
        var result = {
            labels: [],
            data: []
        };
        for(var i = 0; i < common_statistic[0].length; i++ ){
            result.labels.push(common_statistic[0][i].name);
            result.data.push(common_statistic[0][i].total_points);
        }
        return result;
    }
    
    
    init();
</script>

