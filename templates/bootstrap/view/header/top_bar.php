				<!-- Top Bar -->
				
	
<!--Modal window-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
       <div class="modal-content">

        <div class="modal-header"><!-- modal header -->
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title" id="myModalLabel">Обратная связь</h4>
        </div><!-- /modal header -->

        <!-- modal body -->
        <div class="modal-body">
         <form action="#" class="sky-form" method="POST" id="feedBackForm">
          <fieldset>
           <section>
            <label class="label">Представьтесь, пожалуйста</label>
            <label class="input">
             <i class="icon-append fa fa-user"></i>
             <input type="text" name="name" placeholder="Ваше имя">
            </label>
           </section>

           <section>
            <label class="label">Укажите номер телефона</label>
            <label class="input">
             <i class="icon-append fa fa-phone"></i>
             <input type="email" name="phone" placeholder="Ваш телефон">
            </label>
           </section>
          </fieldset>
         </form>
        </div>
        <!-- /modal body -->

        <div class="modal-footer"><!-- modal footer -->
                                    <span class="response color-red" id="FeedBackResponse"></span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
         <button type="button" onclick="sendFeedBack();" class="btn btn-primary">Отправить сообщение</button>
        </div><!-- /modal footer -->

       </div>
      </div>
    </div>



				<header id="topBar" class="styleBackgroundColor">
					<div class="container">

						<!-- Logo -->
						
						<a class="logo" href="<?php echo RS ?>">
							<img src="<?php echo RS ?>assets/images/demo/logo/parquet-board-logo.png" height="50" alt="" />
						</a>


							<div class="headSocial">
							<a href="#" class="social fa fa-facebook"></a>
							<a href="#" class="social fa fa-vk"></a>
							</div>
							<div class="cont">	
							
							<!--social-->	


							<!--contacts-->

							<div class="info">
								<li><i class="fa fa-phone"></i> <?php echo $info[0]['phone_number']?></li></br>
								<li><i class="fa fa-envelope"></i><a href="mailto:<?php echo $info[0]['support_email']?>"> <?php echo $info[0]['support_email']?></a></li>
							</div>
							<div class="login">
								<nav>
									<ul>
										<li>
										<?php
										if(ONLINE)
										{
											?>
											<a href="<?php echo RS."account/" ?>">
												<i class="fa fa-user">
												</i>
												Личный кабинет
											</a>
											<?php
										}else
										{
											?>
											<a href="<?php echo RS."login/" ?>">
												<i class="fa fa-user-secret">
												</i>
												Войти
											</a>
											<?php
										}
										?>	
										</li>
										<li>
											<a href="" class="ptn ptn-primary" data-toggle="modal" data-target="#myModal">
												<i class="fa fa-comments">
												</i>
												Обратная связь
											</a>
										</li>
									</ul>
								</nav>
							</div>
						</div>
						<div id="barMain">
							<nav class="nav-second">
								<ul class="nav nav-pills nav-second">
								<?php
									$cnt = 0;
									foreach($topMenu as $item)
									{
										$dop_class = "";
										if($cnt%2==0)
										{
											$dop_class = "hidden-xs";
										}
										?>
											<li class="<?php echo $dop_class ?>"><a href="<?php echo RS.$item['alias'].'/' ?>"><i class="fa fa-angle-right"></i> <?php echo $item['name'] ?></a></li>
										<?php
										$cnt++;
									}
								?>
                                    <?php $summaryPrice = 0; foreach($cartProdList as $item){$summaryPrice += $item['product_price']*$item['quant'];}?>
                                    <li class="quick-cart dropdown pull-right">
										<a href="javascript:void" class="dropdown-toggle"><i class="fa fa-shopping-cart"></i>Товаров: <span id="quick-cart-quant"><?php echo $cartTotals['cart_quant']?></span> на: <span id="quick-cart-summ"><?php echo $cartTotals['cart_price']?></span> грн<i class="fa fa-angle-down"></i></a>
										<ul class="dropdown-menu pull-right">
											<li>
											

												<!-- CART CONTENT -->
												<div class="quick-cart-content" id="quick-cart-content">
														
															<?php
															if($cartProdList)
															{
															foreach($cartProdList as $item)
																{?>
																	<a class="quick-cart-item" href="<?php echo RS.$item['product_alias'].'/'?>">
																		<img class="pull-left" src="<?php echo PRODUCT_IMG_PATH.$item['product_image'] ?>" width="40" alt="quick cart">
																		<div class="inline-block">
																			<span class="title block"><?php echo $item['product_name']?> &nbsp;x&nbsp;<?php echo $item['quant']?></span>
																			<span class="price block">
																			<?php echo ($item['product_price']*$item['quant'])?><strong> &nbsp;<?php echo $item['product_currency']?></strong>
																			</span>
																		</div>
																	</a>
																<?php
																}
															}else{
																echo "<center style='color:black;'>Ваша корзина пуста</center>";
															}
															?>
														
														<!-- cart footer -->
													<div class="row cart-footer">
														<div class="col-md-6 nopadding-right">
															<a href="<?php echo RS.cart.'/' ?>" class="btn btn-primary fullwidth">Корзина <i class="fa fa-angle-right"></i></a>
														</div>
														<div class="col-md-6 nopadding-left">
														<span id="emptyQuickCart">
															<?php 
															if($cartProdList)
															{
															?>
																<a href="<?php echo RS.checkout.'/' ?>" class="btn btn-info fullwidth">Заказ <i class="fa fa-angle-right"></i></a>
															<?php
															}else{
															?>
																<a disabled="disabled" href="javascript:void" class="btn btn-info fullwidth">Заказ <i class="fa fa-angle-right"></i></a>
															<?
															}
															?>
														</span>
														</div>
													</div><!-- /cart footer -->

												</div>
												<!-- /CART CONTENT -->

											</li>
										</ul>
									</li>
								</ul>
							</nav>
						<!-- Search -->
						<form class="search" name="search" method="POST" action="<?php echo RS.searchPage."/"?>">
							<input type="text" class="form-control" name="search" placeholder="Поиск по каталогу...">
							<button type="submit" class="fa fa-search"></button>
						</form>
						<!-- /Search -->
						</div>


					</div><!-- /.container -->
				</header>
				<!-- /Top Bar -->

