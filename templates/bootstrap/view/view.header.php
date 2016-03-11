<!-- 
		Available body classes: 
			smoothscroll			= enable chrome browser smooth scroll
			grey 					= grey content background
			boxed 					= boxed style
			pattern1 ... pattern10 	= background pattern

		Background Image - add to body: 
			data-background="assets/images/boxed_background/1.jpg"
-->

<div id="header"><!-- class="sticky" for sticky menu -->

    <?php
    	include_once("header/top_bar.php");
		
		include_once("header/top_nav.php");
		
		if(PAGE_VIEW=='home')
		{
			include_once("header/owl_slider.php");
		}
	?>

</div><!-- header ID end -->