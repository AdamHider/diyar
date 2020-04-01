<?php

defined('_JEXEC') or die;
$user   = JFactory::getUser();
$user_levels = JAccess::getGroupsByUser($user->id);
?>

<div class="user-dashboard" >
    <div class="user-info-block">
        <div class="username"><h4><?php echo $user_dashboard->name; ?></h4></div>
    </div>
    <div class="user-avatar-block">
        <img class="avatar-image" src="<?php echo $user_dashboard->avatar_link; ?>" width="150px" />
        <div class="edit-block">
            <button id="myBtn" class=""><i class="fa fa-pencil"></i></button>
        </div>
    </div>
    
    <img class="background-image" src="<?php echo $user_dashboard->background_link; ?>"  />
</div>

<!-- The Modal -->
<div id="dashboardModal" class="modal-custom">
    <!-- Modal content -->
    <span class="close">&times;</span>
    <div class="modal-content" >
        <form action=""  method="post" enctype="multipart/form-data" id="dashboard_form">
            <div class="upload-avatar-block">
                <div class="mini-avatar" >
                    <img class="avatar-image"  src="<?php echo $user_dashboard->avatar_link; ?>" width="150px" />
                </div>
                <div class="upload-avatar">
                    <label>Avatar:</label>
                    <p>Must be squared</p>
                    <div class="upload-btn-wrapper">
                        <button class="button button-mini"><i class="fa fa-upload"></i> Avatar</button>
                        <input type="file" name="avatar" id="avatarToUpload" accept="image/*" onchange="jQuery('#dashboard_form').submit()">
                    </div>
                </div>
            </div>
            <div class="upload-background-block">
                <div class="mini-background">
                    <img class="background-image" src="<?php echo $user_dashboard->background_link; ?>"  />
                </div>
                <div class="upload-background">
                    <label>Background:</label>
                    <p>Should be at least 1920px*400px</p>
                    <div class="upload-btn-wrapper">
                        <button class="button button-mini"><i class="fa fa-upload"></i> Background</button>
                        <input type="file" name="background" id="backgroundToUpload" accept="image/*" onchange="jQuery('#dashboard_form').submit()">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    
    var autocomplete_results = [];
    var current_letter = '';
    var keyboard_is_active = false;
    
    // Get the modal
    var modal = document.getElementById("dashboardModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
   
    
    function init(){
        btn.onclick = function() {
            modal.style.display = "block";
        }
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        } 
        jQuery('#dashboard_form').submit(
            function( e ) {
                $.ajax( {
                    url: 'index.php?option=com_ajax&module=user_dashboard&method=uploadPhotos&format=json',
                    type: 'POST',
                    data: new FormData( this ),
                    processData: false,
                    contentType: false,
                    success: function(result){
                        for(var i = 0; i< result.data.length; i++){
                            if(result.data[i].error){
                                jQuery('#dashboard_form #'+result.data[i].target+'ToUpload').val('');
                                console.log(result.data[i].error);
                                return;
                            }
                            jQuery('.'+result.data[i].target+'-image').attr("src", '/diyar/'+result.data[i].link+'?'+Math.floor(Math.random() * 1000));
                        }
                    }
                } );
                e.preventDefault();
            } 
        );
    }
init();
</script>

