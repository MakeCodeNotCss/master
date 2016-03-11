	<!-- JAVASCRIPT FILES -->
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/jquery.isotope.js"></script>
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/masonry.js"></script>

    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/knob/js/jquery.knob.js"></script>
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/flexslider/jquery.flexslider-min.js"></script>

    <!-- REVOLUTION SLIDER -->
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="<?php echo RS ?>assets/js/revolution_slider.js"></script>

    <script type="text/javascript" src="<?php echo RS ?>assets/js/scripts.js"></script>
    <?php
    if(PAGE_VIEW == 'home')
	{
		?>
		<script type="text/javascript" src="<?php echo RS ?>assets/plugins/styleswitcher/styleswitcher.js"></script>
		<?php
	}
    if(PAGE_VIEW=='shopProduct')
    {
        ?>
        <!-- SHOP OPTIONS -->
        <script type="text/javascript">

            /* 
                SHOP COLOR/SIZE/QTY SELECTOR EXAMPLE 
                If you use this script, keep it here, under jQuery.
                Or move it to your custom.js (after scripts.js)
            */

            /**
                @COLOR SELECTOR
            **/
            jQuery('section.product-view-colors a').bind("click", function(e) {
                e.preventDefault();

                /** Reset the selected thumbnail **/
                jQuery('.product-view-colors a').removeClass('active');  
                jQuery(this).addClass('active');

                /** add the color (value) to the hidden input, inside the form **/
                jQuery("input#color").val(jQuery(this).attr('data-color').trim());


                /** CHANGE BIG IMAGE **/
                jQuery("#product-main-image").attr('src', jQuery(this).attr('data-src'));


                /**
                    @CHANGE STOCK INFO 
                **/
                /* stock color */
                var data_stock = jQuery(this).attr('data-stock').trim();
                jQuery("#product-view-stock-info").removeClass('stock-yes stock-no');
                jQuery("#product-view-stock-info").addClass('stock-' + data_stock);

                /* stock icon */
                jQuery("#product-view-stock-info i").removeClass('fa-check fa-times');
                if(data_stock == 'yes') {
                    jQuery("#product-view-stock-info i").addClass('fa-check');
                } else {
                    jQuery("#product-view-stock-info i").addClass('fa-times');
                }

            });


            /**
                @SIZE SELECTOR 
            **/
            jQuery("#product-size-dd li a").bind("click", function(e) {
                e.preventDefault();

                var data_val = jQuery(this).attr('data-val').trim();

                /* change visual value and hidden input */
                jQuery("#product-selected-size>span").empty().append(data_val);
                jQuery("#size").val(data_val);

                /* change visual selected */
                jQuery("#product-size-dd li").removeClass('active');
                jQuery(this).parent().addClass('active');
            });


            /**
                @QTY SELECTOR 
            **/
            jQuery("#product-qty-dd li a").bind("click", function(e) {
                e.preventDefault();
                
                var data_val = jQuery(this).attr('data-val').trim();

                /* change visual value and hidden input */
                jQuery("#product-selected-qty>span").empty().append(data_val);
                jQuery("#qty").val(data_val);

                /* change visual selected */
                jQuery("#product-qty-dd li").removeClass('active');
                jQuery(this).parent().addClass('active');
            });

        </script>


        <?php
    }
    if(PAGE_VIEW=='shopCategory')
    {
        ?>
<!-- ION RANGE LIDERS -->
        <script type="text/javascript" src="<?php echo RS ?>assets/plugins/ion-range-slider/js/ion.rangeSlider.min.js"></script>
        <script type="text/javascript">
            jQuery("#range_3").ionRangeSlider({
                type: "double",
                postfix: " грн",
                step: 10,
                <?php
                if($price_filter)
                {
                    ?>
                    from: <?php echo $min_price ?>,
                    to: <?php echo $max_price ?>,
                    <?php
                }
                ?>
                onFinish: function(obj){
                    var t = "";
                    for(var prop in obj) {
                        t += prop + ": " + obj[prop] + "\r\n";
                    }
                    jQuery("#result").html(t);
                    mainScript.catProductsFilterReload();
                }
            });
        </script>
        <?php
    }
	?>