			<!-- CONTENT -->
			<section>
				<div class="container">

<?php 
include_once("view.noveltiesCarousel.php");
?>

					<!-- POPULAR PRODUCTS -->
					<div class="row margin-top60"></div>
					<h2 class="owl-featured"><strong>Популярные</strong> товары</h2>

				
			
					<!-- PRODUCT LIST -->
					<div class="row">

					<?php
					foreach ($popular_prods as $item) 
					{
						$prod_id = $item['id'];

						if($item['quant']>0)
						{
							$dop_class = "shop-stock-info stock-yes";
							$dop_class2 = "fa fa-check";
							$dop_class3 = "В наличии";
						}else{
							$dop_class = "shop-stock-info stock-no";
							$dop_class2 = "fa fa-times";
							$dop_class3 = "Нет в наличии";
						}
					?>
				
						<div class="col-md-4 col-sm-6"><!-- item -->
							<div class="shop-item-list">
								<a href="<?php echo $item['alias'].'/' ?>">
									<figure><!-- image -->
										<img class="img-responsive" src="<?php echo PRODUCT_CROP_PATH.$item['file'] ?>" alt="<?php echo $item['name']?>" />
									</figure><!-- /image -->
									<span class="<?php echo $dop_class?>"><!-- stock -->
										<i class="<?php echo $dop_class2?>"></i><?php echo $dop_class3 ?>
									</span><!-- /stock -->
								</a>
								<div class="product-info"><!-- title and price -->
								<span class="product-name pull-left"><?php echo $item['name']?></span>
								<div class="clearfix"></div>
								<button  id="addToCartBtn" type="button" onclick="mainScript.quickAddToCart(<?php echo $item['id']?>);" class="btn-sm btn-primary pull-right">
										<span id="in-cart-message<?php echo $item['id']?>">
										<?php 
											echo (isset($item['quant_in_cart']) && $item['quant_in_cart']
											? 
											'<i class="fa fa-check"></i> Товар в корзине</button>'
											: 
											'<i class="fa fa-shopping-cart"></i> В Корзину</button>'
											); 
										?>
										</span>

									<h2>
										<span class="bold"><strong><?php echo $item['price'].' '?></strong><?php echo $item['currency']?></span>
									</h2>
									<div class="clearfix"></div>
								</div><!-- /title and price -->
								
							</div>
						</div><!-- /item -->
					<?php	
					}
					?>	

					

					</div>
					<!-- /PRODUCT LIST -->




			
			</section>
			<!-- /CONTENT -->