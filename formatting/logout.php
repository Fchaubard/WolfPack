		<a href="#" data-icon="check" id="logout" data-transition="slide" data-direction="reverse" data-role="button" class="ui-btn-right logingout">Logout</a>
		<div id="fb-root"></div>
		<script type="text/javascript">
		  window.fbAsyncInit = function() {
    FB.init({
      appId      : '210452582423240', // App ID
      channelUrl : 'http://hungrylikethewolves.com/channel.php', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    FB.Event.subscribe('auth.statusChange', handleStatusChange);
  };


  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
   
   
     function handleStatusChange(response) {
      //document.body.className = response.authResponse ? 'connected' : 'not_connected';
      if (response.authResponse) {
        console.log(response);

        updateUserInfo(response);
      }
    }
	function handleResponseChange(response) {
		   alert(response);
		   
		   if (response.authResponse) {
		     console.log(response);
		      updateUserInfo(response);
		   }
		 }
		 
		 function updateUserInfo(response) {
		 	
		     FB.api('/me', function(response) {
		       document.getElementById('user-info').innerHTML = '<img src="https://graph.facebook.com/' + response.id + '/picture">' + response.name;
		     });
		   }

	(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=210452582423240";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		
		
		
		
		$( document ).bind( 'pageshow', function( event ) {
			
			$(".logingout").click(function() {
				
				localStorage.clear();
				FB.logout(function() { window.location='account/logout' });
				document.location = "login.php";
			});
			
		});
		</script>