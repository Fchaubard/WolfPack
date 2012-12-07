		<a href="#" data-icon="check" id="logout" data-transition="slide" data-direction="reverse" data-role="button" class="ui-btn-right logingout">Logout</a>
		<script type="text/javascript">
		$( document ).bind( 'pageshow', function( event ) {
			
			$(".logingout").click(function() {
				
				document.location = "login.php";
			});
			
		});
		</script>