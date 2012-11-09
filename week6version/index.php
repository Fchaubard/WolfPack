<?php
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

?> 

<body> 

<!-- Start of first page: #one -->
<div data-role="page" id="one">

	<div data-role="header">
		<h1>Multi-Page</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<h2>Welcome <span id="username"></span></h2>
		
		<p>The neat thing about this example is that you can swipe right and left to navigate between pages, and you can also see in the code that the entire three page sequence within here is bundled into one page.</p>	

		<h3>Show internal pages:</h3>
		<p><a href="#two" data-role="button">Show page "two"</a></p>	
		<p><a href="#popup" data-role="button" data-rel="dialog" data-transition="pop">Show page "popup" (as a dialog)</a></p>
	</div><!-- /content -->
	
	<?php include("formatting/footer.php") ?>
</div>
	
</div><!-- /page one -->


<!-- Start of second page: #two -->
<div data-role="page" id="two" data-add-back-btn="true">

	<div data-role="header">
		<h1>Two</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<h2>Two</h2>
		<p>I have an id of "two" on my page container. I'm the second page container in this multi-page template.</p>	
		<p>Notice that the theme is different for this page because we've added a few <code>data-theme</code> swatch assigments here to show off how flexible it is. You can add any content or widget to these pages, but we're keeping these simple.</p>	
		<p><a href="#one" data-direction="reverse" data-role="button" data-theme="b">Back to page "one"</a></p>	
		
	</div><!-- /content -->
	
	<?php include("formatting/footer.php") ?>
</div>
</div><!-- /page two -->


<!-- Start of third page: #popup -->
<div data-role="page" id="popup">

	<div data-role="header" data-theme="e">
		<h1>Dialog</h1>
	</div><!-- /header -->

	<div data-role="content" data-theme="d">	
		<h2>Popup</h2>
		<p>I have an id of "popup" on my page container and only look like a dialog because the link to me had a <code>data-rel="dialog"</code> attribute which gives me this inset look and a <code>data-transition="pop"</code> attribute to change the transition to pop. Without this, I'd be styled as a normal page.</p>		
		<p><a href="#one" data-rel="back" data-role="button" data-inline="true" data-icon="back">Back to page "one"</a></p>	
	</div><!-- /content -->
	<?php include("formatting/footer.php") ?>
</div>
</div><!-- /page popup -->

<script type="text/javascript">
// This handles all the swiping between each page. You really
// needn't understand it all.
$(document).on('pageshow', 'div:jqmData(role="page")', function(){

     var page = $(this), nextpage, prevpage;
     // check if the page being shown already has a binding
      if ( page.jqmData('bound') != true ){
            // if not, set blocker
            page.jqmData('bound', true)
            // bind
                .on('swipeleft.paginate', function() {
                    console.log("binding to swipe-left on "+page.attr('id'));
                    nextpage = page.next('div[data-role="page"]');
                    if (nextpage.length > 0) {
                       $.mobile.changePage(nextpage,{transition: "slide"}, false, true);
                        }
                    })
                .on('swiperight.paginate', function(){
                    console.log("binding to swipe-right "+page.attr('id'));
                    prevpage = page.prev('div[data-role="page"]');
                    if (prevpage.length > 0) {
                        $.mobile.changePage(prevpage, {transition: "slide",
	reverse: true}, true, true);
                        };
                     });
            }
        });

</script>

</body>
</html>