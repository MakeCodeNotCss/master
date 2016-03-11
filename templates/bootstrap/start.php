<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once("_head.php") ?>
</head>
<body class="<?php echo $body_class ?>">
	<div id="wrapper">

		<?php
        require_once("view/view.header.php");
    
        // Page content
        if(file_exists("templates/".TEMPLATE_NAME."/view/view.".PAGE_VIEW.".php")) {
            require_once("view/view.".PAGE_VIEW.".php");
        }else{
            die("View Error 404");
        }
        
        require_once("view/view.footer.php");
    	?>

	<a href="#" id="toTop"></a>

	</div><!-- /#wrapper -->

    <?php require_once("_bottom.php") ?>
</body>


<!-- MainScript JS -->
<script src="<?php echo JS_PATH."main.js"; ?>" type="text/javascript"></script>
<!-- Document OnReady JS -->
<script src="<?php echo JS_PATH."ready.js"; ?>" type="text/javascript"></script>
</html>