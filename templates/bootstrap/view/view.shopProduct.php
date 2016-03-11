			<!-- PAGE TOP -->
			<section class="page-title">
				<div class="container">

					<header>

						<ul class="breadcrumb"><!-- breadcrumb -->
							<li><a href="<?php echo RS ?>">Home</a></li>
							<?php
								$curr_link = "";
								foreach($categoryBreadcrumbs as $i => $item)
								{
									$curr_link = $item['alias'] . "/";
									
									?>
									<li><a href="<?php echo RS.$curr_link ?>"><?php echo $item['name'] ?></a></li>
									<?php	
								}
							?>
							<li class="active"><?php echo $product['name'] ?></li>
						</ul><!-- /breadcrumb -->

						<h2><!-- Page Title -->
							<?php echo $product['name'] ?> <!--GONNA BE  DB REQUEST-->
						</h2><!-- /Page Title -->

					</header>

				</div>			
			</section>
			<!-- /PAGE TOP -->
	

			<!-- CONTENT -->
			<section>
				<div class="container">

					<div class="row">

						<div class="col-md-6 col-sm-6">

							<figure class="product-view-image"><!-- product image -->
								<img id="product-main-image" class="img-responsive" src="<?php echo PRODUCT_IMG_PATH.$images[0]['file'] ?>" width="620" height="620" alt="" />
							</figure>

						</div>

						<div class="col-md-6 col-sm-6">

							<h1 class="product-view-title"><?php echo $product['name']?></h1>
							<h3 class="product-view-price"><em><?php echo $product['price']?></em><sup><?php echo $product['currency']?></sup><small class="pull-right fsize14">Код товара: <?php echo $product['sku']?></small></h3>
							<div class="clearfix"></div>
							<p><?php echo $product['details']?>
								<?php 
								if($product['model'])
								{	
								?>
									Модель: <strong><?php echo $product['model']?></strong>
								<?php
								}else{
									
								}
								?>
							</p>

							<p>
								Площадь в упаковке: <strong><span id="product_square"><?php echo $product['square']?></span></strong> кв.м.
							</p>

							<p>
								Ширина: <strong><?php echo $product['width']?></strong> мм.  
								Высота: <strong><?php echo $product['height']?></strong> мм.  
								Толщина: <strong><?php echo $product['depth']?></strong> мм.  
								Вес упаковки: <strong><?php echo $product['weight']?></strong> кг.
							</p>


							<hr class="half-margins" />

							<?php	
								if($product['quant']>0)
								{
									$dop_class = "shop-stock-info stock-yes";
									$dop_class2 = "fa fa-check";
									$dop_class3 = "В наличии";
								 	$dop_class4 = "yes";
								 	$dop_class5 = "green";
								}else{
									$dop_class = "shop-stock-info stock-no";
									$dop_class2 = "fa fa-times";
									$dop_class3 = "Нет в наличии";
									$dop_class4 = "no";
									$dop_class5 = "red";
								}
							?>
	
							<span id="product-view-stock-info" class="<?php echo $dop_class ?>"><!-- stock -->
								<i class="<?php echo $dop_class2 ?>"></i><?php echo $dop_class3 ?></span><!-- /stock -->

							<!-- see the bottom of the page for the script -->
							<section class="product-view-colors">
							<?php
							foreach($images as $item)
							{
								?>
								<a data-color="<?php echo $dop_class5?>" data-stock="<?php echo $dop_class4?>" data-src="<?php echo PRODUCT_IMG_PATH.$item['file'] ?>" href="javascript:void(0);">
									<img src="<?php echo PRODUCT_CROP_PATH.$item['file'] ?>" style="height:70px; width:auto;" alt="" />
								</a>
								<?php
							}
							?>
							</section>

							<form id="addToCartForm" name="addToCartForm" action="#" method="POST" class="form-inline margin-top30 nopadding clearfix">

								<!-- see the bottom of the page for the script -->
								<input type="hidden" id="prod_id" name="prod_id" value="<?php echo $product['id']?>" />

								
								<input type="hidden" id="prod_price" name="prod_price" value="<?php echo $product['price']?>" />
								<input type="hidden" id="prod_currency" name="prod_currency" value="<?php echo $product['currency']?>" />
								<input type="hidden" id="prod_name" name="prod_name" value="<?php echo $product['name']?>" /> 

										
								
								<div class="btn-group pull-left product-opt-qty">
									
									<button type="button" name="qty" class="btn btn-default dropdown-toggle product-qty-dd" data-toggle="dropdown">
										<span class="caret"></span>
										Кол-во: <small id="product-selected-qty"><span id="selectedQty">1</span></small>
									</button>

									<ul id="product-qty-dd" class="dropdown-menu clearfix" role="menu">
										<li class="active"><a data-val="1" href="javascript:void">1</a></li>
										<li><a data-val="2" href="javascript:void">2</a></li>
										<li><a data-val="3" href="javascript:void">3</a></li>
										<li><a data-val="4" href="javascript:void">4</a></li>
										<li><a data-val="5" href="javascript:void">5</a></li>
										<li><a data-val="6" href="javascript:void">6</a></li>
										<li><a data-val="7" href="javascript:void">7</a></li>
										<li><a data-val="8" href="javascript:void">8</a></li>
										<li><a data-val="9" href="javascript:void">9</a></li>
										<li><a data-val="10" href="javascript:void">10</a></li>
										<li><a data-val="11" href="javascript:void">11</a></li>
										<li><a data-val="12" href="javascript:void">12</a></li>
										<li><a data-val="13" href="javascript:void">13</a></li>
										<li><a data-val="14" href="javascript:void">14</a></li>
										<li><a data-val="15" href="javascript:void">15</a></li>
										<li><a data-val="16" href="javascript:void">16</a></li>
										<li><a data-val="17" href="javascript:void">17</a></li>
										<li><a data-val="18" href="javascript:void">18</a></li>
										<li><a data-val="19" href="javascript:void">19</a></li>
										<li><a data-val="20" href="javascript:void">20</a></li>


										<input type="hidden" id="prod_qty" name="prod_qty" value="" onchange="mainScript.calcMyQuant();"></input>


									</ul>
								</div><!-- /btn-group -->

								<button type="button" class="btn btn-primary pull-left appear-animation" onclick="mainScript.addToCart();" data-animation="bounceIn">
									<span id="in-cart-message">
										<?php 
											echo (isset($inCartItem) && $inCartItem
											? 
											'<i class="fa fa-check"></i> Товар в корзине</button>'
											: 
											'<i class="fa fa-cart-plus"></i> В Корзину</button>'
											); 
										?>
									</span>
								<button id="quickOrderBtn" type="button" class="btn btn-warning pull-left appear-animation" data-toggle="modal" data-target="#quickOrderModal" data-animation="bounceIn">
									<span></span><i class="fa fa-shopping-cart"></i> Быстрый заказ</button>


									<div class="clearfix"></div>

								<hr class="half-margins" />

								<h4><center>Хотите узнать сколько упаковок вам необходимо?</center></h4>
								<p class="fsize10"><center>Введите нужную площадь в поле, наш калькулятор посчитает это за Вас.</center></p>
									<div class="pull-left ">
										<input class="form-control"  id="needed_square" type="number" min="1" name="countQuery" placeholder="Ваша площадь в кв.м." value="<?php echo $product['square']?>" onchange="mainScript.calcMyQuant();" />
									</div>

									<div class="pull-right">
										<p>Количество упаковок: <strong><span id="resultSpan">1</span></strong> шт.</p>
												
										<input type="hidden" name="square" value="<?php echo $product['square']?>"></input>
										<p>Запас составляет: <strong><span id="resultRest"> 0</span></strong> кв.м.</p>
									</div>

									<div class="clearfix"></div>
							</form>
							


							<hr class="half-margins" />





						</div>

					</div>

					<hr />


<?php 
include_once("view.noveltiesCarousel.php");
include_once("view.quickOrderModal.php");
?>



				</div>
			</section>
			<!-- /CONTENT -->



