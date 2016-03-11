				<!-- Top Bar -->
				
	
        <!--MODAL-->
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
		             <input type="email" name="phone" placeholder="Ваш e-mail">
		            </label>
		           </section>
		          </fieldset>
		         </form>
		        </div>
		        <!-- /modal body -->

		        <div class="modal-footer">
		        <!-- modal footer -->
		                                    <span class="response color-red" id="FeedBackResponse"></span>
		                                    &nbsp;&nbsp;&nbsp;&nbsp;
		         <button type="button" onclick="sendFeedBack();" class="btn btn-primary">Отправить сообщение</button>
		        </div>
		        <!-- /modal footer -->



				<header id="topBar" class="styleBackgroundColor">
					<div class="container">

						<!-- Logo -->
						
						<a class="logo" href="<?php echo RS ?>">
							<img src="<?php echo RS ?>assets/images/demo/logo/parquet-board-logo.png" height="50" alt="" />
						</a>
						<div class="cont">	
							
							<!--social-->	

							<div class="headSocial">
							<a href="#" class="social fa fa-facebook"></a>
							<a href="#" class="social fa fa-vk"></a>
							</div>

							<!--contacts-->

							<div class="info">
								<li>(000) 000-00-00 /</li>
								<li> (000) 000-00-00 </li><br/>
								<li><i class="fa fa-envelope"></i>   my.mail@gmail.com</li>
							</div>
							<div class="login">
								<nav>
									<ul>
										<li>
											<a href="/login">
												<i class="fa fa-user-secret">
												</i>
												Войти
											</a>	
										</li>
										<li>
											<a href="#" class="ptn ptn-primary" data-toggle="modal" data-target="#myModal">
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
                                    <li class="quick-cart dropdown pull-right">
										<a href="#" class="dropdown-toggle"><i class="fa fa-shopping-cart"></i> 3 товара - 10389 грн <i class="fa fa-angle-down"></i></a>
										<ul class="dropdown-menu pull-right">
											<li>
												<p><i class="fa fa-warning"></i> Всего товаров: 3</p>

												<!-- CART CONTENT -->
												<div class="quick-cart-content">

													<a class="quick-cart-item" href="shop-page-cart.html"><!-- item 1 -->
														<img class="pull-left" src="/assets/images/demo/shop/thumb/1.jpg" width="40" alt="quick cart">
														<div class="inline-block">
															<span class="title block">Man shirt XL</span>
															<span class="price block">2 &times; $44.00</span>
														</div>
													</a><!-- /item 1 -->

													<a class="quick-cart-item" href="shop-page-cart.html"><!-- item 2 -->
														<img class="pull-left" src="/assets/images/demo/shop/thumb/2.jpg" width="40" alt="quick cart">
														<div class="inline-block">
															<span class="title block">Great Black Shoes For Man and Only Man...</span>
															<span class="price block">2 &times; $44.00</span>
														</div>
													</a><!-- /item 2 -->

													<a class="quick-cart-item" href="shop-page-cart.html"><!-- item 3 -->
														<img class="pull-left" src="/assets/images/demo/shop/thumb/4.jpg" width="40" alt="quick cart">
														<div class="inline-block">
															<span class="title block">Pink Lady Perfect Shoes</span>
															<span class="price block">1 &times; $67.32</span>
														</div>
													</a><!-- /item 3 -->
														
														<!-- cart footer -->
													<div class="row cart-footer">
														<div class="col-md-6 nopadding-right">
															<a href="<?php echo RS.cart.'/' ?>" class="btn btn-primary fullwidth">Корзина <i class="fa fa-angle-right"></i></a>
														</div>
														<div class="col-md-6 nopadding-left">
															<a href="<?php echo RS.checkout.'/' ?>" class="btn btn-info fullwidth">Заказ <i class="fa fa-angle-right"></i></a>
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
						<form class="search" method="get" action="#">
							<input type="text" class="form-control" name="s" value="" placeholder="Поиск">
							<button class="fa fa-search"></button>
						</form>
						<!-- /Search -->
						</div>


					</div><!-- /.container -->
				</header>
				<!-- /Top Bar -->

