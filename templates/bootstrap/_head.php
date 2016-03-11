	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    
    <?php if(!SITE_INDEX){ ?><meta name="robots" content="noindex,nofollow" ><?php } ?>
    
    <!-- Favicon -->
    <link href="/assets/images/favicon.png" rel="shortcut icon" />
    
    <link rel="canonical" href="<?php echo ( $_SERVER['SERVER_PORT']==80 ? "http://" : "https://" ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" />
    
    <!-- mobile settings -->
	<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
	
    <title><?php echo $meta_title ?></title>
    
    <meta name="keywords" content="parquet, online, store" />
	<meta name="description" content="Parquet Online Store" />
    
	<meta name="Author" content="Outsource Coder [www.outsource-coder.com]" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <!-- WEB FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

    <!-- CORE CSS -->
    <link href="<?php echo RS ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/css/sky-forms.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/css/weather-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/css/line-icons.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/plugins/owl-carousel/owl.pack.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/css/account.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/css/flexslider.css" rel="stylesheet" type="text/css" />

    <!-- REVOLUTION SLIDER -->
    <link href="<?php echo RS ?>assets/css/revolution-slider.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/css/layerslider.css" rel="stylesheet" type="text/css" />

    <!-- SHOP 
    <link href="<?php echo RS ?>assets/css/layout-shop.css" rel="stylesheet" type="text/css" />
    -->

    <?php
        foreach($uni_styles as $link)
        {
            ?>
            <link href="<?php echo RS ?>assets/css/<?php echo $link ?>.css" rel="stylesheet" type="text/css" />
            <?php
        }
    ?>
    

    <!-- THEME CSS -->
    <link href="<?php echo RS ?>assets/css/essentials.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/css/header-3.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RS ?>assets/css/footer-default.css" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo RS ?>assets/css/color_scheme/darkgreen.css" rel="stylesheet" type="text/css" id="color_scheme" />

    <!-- Morenizr -->
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/modernizr.min.js"></script>

    <!--[if lte IE 8]>
        <script src="<?php echo RS ?>assets/plugins/respond.js"></script>
    <![endif]-->