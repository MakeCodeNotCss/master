	<!-- JAVASCRIPT FILES -->
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/jquery.isotope.js"></script>
    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/masonry.js"></script>

    <script type="text/javascript" src="<?php echo RS ?>assets/plugins/bootstrap/js/bootstrap.js"></script>
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
                jQuery("#prod_qty").val(data_val);

                

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
                
				<script type="text/javascript" language="javascript">
										
					function sendFeedBack()
					{
						$('#FeedBackResponse').html('Отправка данных...');
						$.post("/ajax/action.json.SendMessage.php",$('#feedBackForm').serialize(),function(data,status){
								if(status=='success')
								{
									if(data.status=='success')
									{
										$('#feedBackForm').html('<p>'+data.message+'</p>');
										$('#FeedBackResponse').html("");
									}else
									{
										$('#FeedBackResponse').html(data.message);
									}
								}else{
									$('#FeedBackResponse').html('Ошибка сервера, пожалуйста повторите попытку позже.');
									}
							},"json");
					}
					
					function contactFeedBack()
					{
						$('#contactfBform .response').html('Отправка данных...');
						$.post("/ajax/action.json.ContactMessage.php",$('#contactfBform').serialize(),function(data,status){
								if(status=='success')
								{
									if(data.status=='success')
									{
										$('#contactfBform').html('<p>'+data.message+'</p>');
									}else
									{
										$('#contactfBform .response').html(data.message);
									}
								}else{
									$('#contactfBform .response').html('Ошибка сервера, пожалуйста повторите попытку позже.');
									}
							},"json");
					}
					
					function sendProductComment()
					{
						$('#product-comment-form .response').html('Отправка данных...');
						$.post("/ajax/action.json.productComment.php",$('#product-comment-form').serialize(),function(data,status){
								if(status=='success')
								{
									if(data.status=='success')
									{
										$('#product-comment-form').html('<p class="alert">'+data.message+'</p>');
									}else
									{
										$('#product-comment-form .response').html(data.message);
									}
									
								}else{
									$('#product-comment-form .response').html('Ошибка сервера, пожалуйста повторите попытку позже.');
									}
							},"json");
					}
					
					function sendArticleComment()
					{
						$('#article-comment-form .response').html('Отправка данных...');
						$.post("/ajax/action.json.articleComment.php",$('#article-comment-form').serialize(),function(data,status){
								if(status=='success')
								{
									if(data.status=='success')
									{
										$('#article-comment-form').html('<p class="alert">'+data.message+'</p>');
									}else
									{
										$('#article-comment-form .response').html(data.message);
									}
									
								}else{
									$('#article-comment-form .response').html('Ошибка сервера, пожалуйста повторите попытку позже.');
									}
							},"json");
					}
				</script>