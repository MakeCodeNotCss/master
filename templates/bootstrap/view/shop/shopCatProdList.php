							<div class="row">

								<?php 
									//echo "<pre>"; print_r($prodList); echo "</pre>";

									foreach ($prodList as $item) {

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
										
											<div class="col-md-4 col-sm-4"><!-- item -->
												<div class="shop-item-list">
													<a href="<?php echo $item['alias'].'/' ?>">
													<figure><!-- image -->
														<img class="img-responsive" src="<?php echo PRODUCT_CROP_PATH.$item['file'] ?>" alt="" />
													</figure><!-- /image -->
													
													<span class="<?php echo $dop_class ?>">
														<i class="<?php echo $dop_class2 ?>"></i><?php echo $dop_class3 ?>
													</span>
													</a>
														<div class="product-info"><!-- title and price -->
														<h2><span class="product-name pull-left"><?php echo wordwrap($item['name'], 40 ,'<br />'); ?></span></h2>
																<button  id="addToCartBtn" type="button" onclick="mainScript.quickAddToCart(<?php echo $item['id']?>);" class="btn-sm btn-primary pull-right">
																<div  class="clearfix"></div>
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

																<span class="bold pull-left"><?php echo $item['price'].' '.$item['currency'] ?></span> <span class="line-through"></span>
															</h2>
																

														</div><!-- /title and price -->
												
												</div>
											</div><!-- /item -->
									<?php
									}

								?>

							</div>
							<!-- /PRODUCT LIST -->