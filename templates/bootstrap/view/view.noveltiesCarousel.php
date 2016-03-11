



					<!-- FEATURED PRODUCTS -->
					<h2 class="owl-featured"><strong>Наши</strong> новинки</h2>
					<div class="owl-carousel featured" data-plugin-options='{"singleItem": false, "stopOnHover":true, "autoPlay":true, "autoHeight": false, "navigation": true, "pagination": false}'>
						
					<?php 
					foreach($novelties as $item)
					{ 
						$prod_id = $item['id'];
						?>

						<div>
							<div class="owl-featured-item">
								<a class="figure" href="<?php echo RS.$item['alias'].'/' ?>">
									<span><i class="fa fa-plus"></i></span>
									<img alt="<?php echo $item['alias']?>" src="<?php echo PRODUCT_IMG_PATH.$item['file'] ?>" width="230" height="212"/>
								</a>
								<div class="owl-featured-detail">
									<a class="featured-title" href="#"><?php echo $item['name']?></a>
									<span class="price"><span class=""><strong><?php echo $item['price'].' '?></strong><?php echo $item['currency']?></span></br>
									<div>
										<button type="button" onclick="mainScript.quickAddToCart(<?php echo $item['id']?>);" class="btn btn-warning btn-sm">
											<span id="in-cart-message<?php echo $item['id']?>">
											<?php 
												echo (isset($item['quant_in_cart']) && $item['quant_in_cart']
												? 
												'<i class="fa fa-check"></i>Товар в корзине</button>'
												: 
												'<i class="fa fa-shopping-cart"></i>В Корзину</button>'
												); 
											?>
											</span>
									</div>
								</div>
							</div>
						</div>
					<?php	
					}
					?>	

					</div>
					<!-- /FEATURED PRODUCTS -->