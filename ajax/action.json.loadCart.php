<?php 
	require_once("_ajax_boot.php");
?>
 <link href="<?php echo RS ?>assets/css/layout-shop.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo RS ?>assets/css/essentials.css" rel="stylesheet" type="text/css" />
<!-- CONTENT -->
			<section>
				<div class="container">

					<form class="cartContent w400" method="post" action="#">

						<!-- cart content -->
						<div id="cartContent">
							<!-- cart header -->
							<div class="">
								<span class="cart_img"></span>
								<span class="product_name fsize13 bold">PRODUCT NAME</span>
								<span class="remove_item fsize13 bold"></span>
								<span class="total_price fsize13 bold">TOTAL</span>
								<span class="qty fsize13 bold">QUANTITY</span>
								<div class="clearfix"></div>
							</div>
							<!-- /cart header -->

							<!-- cart item -->
							<div class="item">
								<div class="cart_img"><img src="/assets/images/demo/shop/1.jpg" alt="" width="60" /></div>
								<a href="shop-page-full-product.html" class="product_name">
									<span>Man shirt XL</span>
									<small>Color: Brown, Size: XL</small>
								</a>
								<a href="#" class="remove_item"><i class="fa fa-times"></i></a>
								<div class="total_price">$<span>32.00</span></div>
								<div class="qty"><input type="text" value="1" name="qty" maxlength="3" /> &times; $21.00</div>
								<div class="clearfix"></div>
							</div>
							<!-- /cart item -->

							<!-- cart item -->
							<div class="item">
								<div class="cart_img"><img src="/assets/images/demo/shop/2.jpg" alt="" width="60" /></div>
								<a href="shop-page-full-product.html" class="product_name">
									<span>Great Black Shoes For Man and Only Man...</span>
									<small>Color: Black, Size: 8.5</small>
								</a>
								<a href="#" class="remove_item"><i class="fa fa-times"></i></a>
								<div class="total_price">$<span>32.00</span></div>
								<div class="qty"><input type="text" value="1" name="qty" maxlength="3" /> &times; $32.56</div>
								<div class="clearfix"></div>
							</div>
							<!-- /cart item -->

							<!-- cart item -->
							<div class="item">
								<div class="cart_img"><img src="/assets/images/demo/shop/4.jpg" alt="" width="60" /></div>
								<a href="shop-page-full-product.html" class="product_name">
									<span>Pink Lady Perfect Shoes</span>
									<small>Color: Pink, Size: 6.5</small>
								</a>
								<a href="#" class="remove_item"><i class="fa fa-times"></i></a>
								<div class="total_price">$<span>32.00</span></div>
								<div class="qty"><input type="text" value="1" name="qty" maxlength="3" /> &times; $67.19</div>
								<div class="clearfix"></div>
							</div>
							<!-- /cart item -->


							<!-- cart total -->
							<div class="total pull-right">
								<small>
									Shipping: Free
								</small>

								<span class="totalToPay">
									TOTAL: $64.00
								</span>

							</div>
							<!-- /cart total -->

							<div class="clearfix"></div>
						</div>
						<!-- /cart content -->

					</form>


					<div class="">

						<div class="">



						</div>

						<div class="">

							<!-- cart totals -->
							<div class="sky-form boxed cartContent">
								<header class="styleColor">Cart Totals</header>
								
								<fieldset>					
									
									<section class="clearfix cart_totals">
										<span class="pull-right fsize16">$64.00</span>
										<span class="bold">Cart Subtotal</span>
									</section>

									<section class="clearfix cart_totals">
										<span class="pull-right fsize16">Free</span>
										<span class="bold">Shipping</span>
									</section>

									<section class="clearfix cart_totals noborder">
										<span class="pull-right fsize20 bold styleColor">$54.00</span>
										<span class="bold fsize18">ORDER TOTAL</span>
									</section>

								</fieldset>

								<footer>
									<a href="shop-page-checkout.html" class="btn btn-primary pull-right">Оформить заказ</a>
								</footer>
							</div>
							<!-- /cart totals -->

						</div>

					</div>


				</div>
			</section>
			<!-- /CONTENT -->

