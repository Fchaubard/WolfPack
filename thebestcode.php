<style type="text/css">
		#popupPanel-popup {
	    right: 0 !important;
	    left: auto !important;
		}
		#popupPanel {
		    /*width: 320px;*/
		    border: 1px solid #000;
		    border-right: none;
		    background: rgba(0,0,0,.5);
		    margin: -1px 0;
		}
		#helper {
			position:absolute;
			color:#fff;
			top:70px;
			left:20px;
		}
		#popupPanel .ui-btn {
		    margin: 2em 15px;
		}
	</style>


<script type="text/javascript">	
    $(document).unbind('pageshow');
    $(document).bind('pageshow', function(event){ 
            $( "#popupPanel" ).on({
        popupbeforeposition: function() {
                    var h = $( window ).height(); //window
                    var w = $( document ).width(); //window
                    $( ".popupPanel" ).css( "height", h );
                    $( ".popupPanel" ).css( "width", w );
            }
            });
            
    });
</script> 


<div data-role="popup" class="popupPanel" id="popupPanel" data-corners="false" data-theme="none" data-shadow="false" data-tolerance="0,0">
    <!-- <button data-theme="a" data-icon="back" data-mini="true">Back</button>
    <button data-theme="a" data-icon="grid" data-mini="true">Menu</button>
    <button data-theme="a" data-icon="search" data-mini="true">Search</button> -->
    <div class="groupInviteInfo" data-theme="a" style="margin-top: 40px; background: transparent;" id="groupInviteInfo" data-role="content" width="80%">
        Your Group Info Will Go Here!
    </div>
    <a href="#" class="inviteDecline" data-rel="back" data-role="button" data-transition="slide" data-role="button" data-theme="a">Decline Invitation</a>
    
    
</div>

<?php
    if(file_exists("./formatting/master_push_client.php"))
    {
            include "./formatting/master_push_client.php";
    }
?>