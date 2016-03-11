			<!-- PAGE TOP -->
			<section class="page-title">
				<div class="container">

					<header>

						<ul class="breadcrumb"><!-- breadcrumb -->
							<li><a href="<?php echo RS ?>">Home</a></li>
							<li class="active">Корзина</li>
						</ul><!-- /breadcrumb -->

						<h2><!-- Page Title -->
							Корзина
						</h2><!-- /Page Title -->

					</header>

				</div>			
			</section>
			<!-- /PAGE TOP -->


	<!-- CONTENT -->
			<section>
				<div class="container">

					<form id="cartRecalcForm" class="cartContent clearfix" method="post" action="#">

						<!-- cart content -->
						<div id="cartContent">
							<!-- cart header -->
							<div class="item head">
								<span class="cart_img"></span>
								<span class="product_name fsize13 bold">Наименование</span>
								<span class="remove_item fsize13 bold"></span>
								<span class="total_price fsize13 bold">Сумма</span>
								<span class="product_square fsize13 bold">Площадь</span>
								<span class="qty fsize13 bold">Количество</span>
								<div class="clearfix"></div>
							</div>
							<!-- /cart header -->
							<?php
							if(!$cartProdList)
							{
								echo "<center id='emptyCart' class='fsize20'>Ваша корзина пуста</center>";
							}else{
								echo "<center id='emptyCart' class='fsize20'></center>";
							}
							?>
							<div id="cartTable">
							<?php
							$summaryPrice = 0;
							foreach ($cartProdList as $item) 
							{
							?>
								<div class="item" id="cartItem-<?php echo $item['id'] ?>">
									<div class="cart_img"><img src="<?php echo PRODUCT_IMG_PATH.$item['product_image'] ?>" alt="" width="60" /></div>
									<a href="<?php echo RS.$item['product_alias']."/"?>" class="product_name">
										<span><?php echo $item['product_name']?></span>
										<small><?php echo $item['product_model']?></small>
									</a>
								

									<button type="button" class="remove_item" onclick="mainScript.delFromCart(<?php echo $item['id'] ?>);"><i class="fa fa-times"></i></button>
									<div class="total_price"><?php echo ($item['product_price']*$item['quant'])?><span>&nbsp;<?php echo $item['product_currency']?></span></div>
									<span class="product_square"><?php echo round(($item['product_square']*$item['quant']),2)?> кв.м.</span>
									<div class="qty">
									<input onchange="mainScript.recalcCart();" type="number" value="<? echo $item['quant']?>" name="qty[<?php echo $item['id']?>]" maxlength="3" /> &times; 
									<?php echo $item['product_price']?>&nbsp;<?php echo $item['product_currency']?>
									</div>
									<div class="clearfix"></div>
								</div>
								
							<?php
								$summaryPrice += $item['product_price']*$item['quant'];
							}
							?>
							</div>

							<!-- cart total -->
							<div class="total pull-right">
								<span class="totalToPay">
									К оплате: <span id="cart-summ"><?php echo $summaryPrice?></span>&nbsp;<?php echo $item['product_currency']?></span>
								</span>

							</div>
							<!-- /cart total -->


							<!-- update cart -->
							<!-- /update cart -->

							<div class="clearfix"></div>
						</div>
						<!-- /cart content -->

					</form>


					<div class="row margin-top60">



					</div>
								<footer>
										<?php 
										if(!$cartProdList)
										{
											?>
											<span id="cartButton"><a href="javascript:void" class="btn btn-primary pull-right">В корзине нет товаров :(</a></span>
											<?php
										}else{
											?>
											<span id="cartButton"><a href="<?php echo RS.'checkout/'?>" class="btn btn-primary pull-right">Перейти к оформлению &rarr;</a></span>
											<span id="tranquateCart">
											<button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#tranqCartModal">Очистить корзину</button>
											</span>
								
										<?php
										}			 //onclick="mainScript.tranqCart();" 
										?>
								</footer>

				</div>
			</section>
			<!-- /CONTENT -->

							<div id="tranqCartModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">

										<div class="modal-header"><!-- modal header -->
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel">Очистить корзину</h4>
										</div><!-- /modal header -->

										<!-- modal body -->
										<div class="modal-body">
											Вы действительно хотите удалить все товары из корзины?
										</div>
										<!-- /modal body -->

										<div class="modal-footer"><!-- modal footer -->
											 <button class="btn btn-primary" onclick="mainScript.tranqCart();" data-dismiss="modal" >Удалить</button><button class="btn btn-default" data-dismiss="modal">Отмена</button>
										</div><!-- /modal footer -->

									</div>
								</div>
							</div>