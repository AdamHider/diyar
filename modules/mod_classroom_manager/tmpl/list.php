<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>

<div class="classroom">
    <div id="classroom_manager_body">
            <div class='classroom_info' >
                <?php if(in_array(10, $user_levels)){ ?>
                    <a class="button button-positive button-mini" href="index.php/ru/мой-профиль/мой-класс?item_id=<?php echo $classroom_manager['classroom']->classroom_id?>&action=edit"><i class="fa fa-pencil"></i></a>
                <?php } ?>
                <div><?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_CLASSROOM_NAME'); ?>: <?php echo $classroom_manager['classroom']->classroom_name; ?> </div>
                <div><?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_CLASSROOM_CODE'); ?>: <?php echo $classroom_manager['classroom']->classroom_code; ?> </div>
                <div><?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_CLASSROOM_INSTITUTION_NAME'); ?>: <?php echo $classroom_manager['classroom']->classroom_institution; ?> </div>
                <div><?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_CLASSROOM_ADDRESS'); ?>: <?php echo $classroom_manager['classroom']->classroom_address; ?> </div>
            </div>
        
            <ul id="tabs">
                <li><a id="tab1"><?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_STUDENT_LIST'); ?></a></li>
                <li><a id="tab2"><?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_STUDENT_RATING'); ?></a></li>
            </ul>
            <div class="container student-list" id="tab1C">
                <?php if(!empty($classroom_manager['student_list'])){ ?>
                <div class="first-row student-list-head">
                    <div class="column">
                        <label>#: </label>
                    </div>
                    <div class="column exercise_name">
                        <label><?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_STUDENT_NAME'); ?>: </label>
                    </div>
                    <div class="column">
                        <label><?php  echo JText::_('MOD_CLASSROOM_MANAGER_TEXT_STUDENT_LAST_VISIT'); ?>:</label>
                    </div>
                </div>  
                <?php     foreach($classroom_manager['student_list'] as $student ){?>
                <div class='diyar-row <?php if($student->id == $user->id){ echo 'current-user'; } ?>'>
                    <div class="column">
                        <?php echo $student->rowNumber; ?> 
                    </div>
                    <div class="column">
                        <img src="<?php echo $student->avatar_link; ?>" width="30px"/> 
                        <span class="username"><?php echo $student->student_name; ?></span>
                    </div>
                    <div class="column">
                        <?php 
                            echo ModClassroomManagerHelper::calculateDate($student->last_visit);
                        ?> 
                    </div>
                </div>
                <?php }} ?>
            </div>
            <div class="container" id="tab2C">
                <canvas id="myChart"></canvas>
            </div>

            
            
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    
    var $ = jQuery;
    
    function init(){
        jQuery('.edit_homework').on('click', function(e){
            var homework_id = jQuery(e.target).attr('data-homework_id');
            openEditor(homework_id);
        })
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
    }
    function chartInit(){
        var ctx = document.getElementById('myChart').getContext('2d');
        var gradient_common = ctx.createLinearGradient(0, 0, 0, 400);
        var gradient_user = ctx.createLinearGradient(0, 0, 0, 400);
        gradient_common.addColorStop(0, '#63e9d5');   
        gradient_common.addColorStop(1, '#2488ad');
        gradient_user.addColorStop(0, '#f9e122');
        gradient_user.addColorStop(1, '#d78329');   
        var chart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: <?php echo json_encode($classroom_manager['student_rating']['labels']); ?>,
                datasets: [
                {
                    barPercentage: 0.5,
                    barThickness: 6,
                    maxBarThickness: 8,
                    minBarLength: 2,
                    backgroundColor: <?php echo str_replace('"','',json_encode($classroom_manager['student_rating']['backgroundColor'])); ?>,
                    borderColor: gradient_common,
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(179,181,198,1)",
                    data: <?php echo json_encode($classroom_manager['student_rating']['data']); ?>
                }]
            },
            options: {
                legend: {
                    display: false,
                    labels: {
                        usePointStyle: true,
                        fillStyle: 'rgb(255, 99, 132)',
                        boxWidth: 40
                    }
                },
                scales: {
                    pointLabels :{
                        fontStyle: "bold"
                    },
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 20,
                            stacked: true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            maxTicksLimit: 20, 
                            beginAtZero: true,
                            min: 0
                        },
                        gridLines: {
                            offsetGridLines: true
                        }
                    }]
                }
            }
        });
    }
    
    function openEditor(homework_id) {
        var url = window.location.href + "?action=edit";
        if(homework_id > 0){
            url += '&homework_id='+homework_id;
        }
        window.history.pushState("", "", url);
        location.replace(url);
        return;
    };
    function editClassroom(){
        var classroom = jQuery('#classroomForm').serialize(); 
        jQuery.ajax({
            url: "index.php?option=com_ajax&module=classroom_manager&method=createClassroom&format=json",
            type: "POST",
            data: {classroom: classroom},
            success: function (response){
                location.replace('');
            }
        });
    }

   

init();
</script>

