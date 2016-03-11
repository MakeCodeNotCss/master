			<!-- PAGE TOP -->
			<section class="page-title">
				<div class="container">

					<header>

						<ul class="breadcrumb"><!-- breadcrumb -->
							<li><a href="<?php echo RS ?>">Home</a></li>
							<li class="active">Оформление заказа</li>
						</ul><!-- /breadcrumb -->

						<h2><!-- Page Title -->
							Оформление заказа
						</h2><!-- /Page Title -->

					</header>

				</div>			
			</section>
			<!-- /PAGE TOP -->


			<!-- CONTENT -->

			<section>
				<div class="container">
				<?php 
				if(ONLINE)
				{?>
					<div id="checkoutResponse">
					
					<form id="cartRecalcForm" class="cartContent clearfix" method="post" action="#">

						<!-- cart content -->
						<div id="cartContent">
							<!-- cart header -->
							<div class="item head">
								<span class="cart_img"></span>
								<span class="product_name fsize13 bold">Наименование</span>
								<span class="total_price fsize13 bold">Сумма</span>
								<span class="product_square fsize13 bold">Площадь</span>
								<span class="qty fsize13 bold">Количество</span>
								<div class="clearfix"></div>
							</div>
							<!-- /cart header -->
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

								

								
									<div class="total_price"><?php echo ($item['product_price']*$item['quant'])?><span>&nbsp;<?php echo $item['product_currency']?></span></div>
									<span class="product_square"><?php echo round(($item['product_square']*$item['quant']),2)?> кв.м.</span>
									<div class="qty">
									<?php echo $item['quant']?>&nbsp;*&nbsp;<?php echo $item['product_price']?>&nbsp;<?php echo $item['product_currency']?>
									</div>
									<div class="clearfix"></div>
								</div>
								
							<?php
								$summaryPrice += $item['product_price']*$item['quant'];
							}
							?>




							<!-- update cart -->
							<!-- /update cart -->

						</div>

						<!-- /cart content -->

					</form>


							<!-- update cart -->
							<!-- /update cart -->

							<div class="clearfix"></div>
							<div class="margin-top30"></div>

					<form id="orderForm" action="#" method="post" class="row sky-form cartContent">
						<input type="hidden" id="order_Sum" name="order_Sum" value="<?php echo $summaryPrice?>"/>

						<div class="col-md-9 checkout">

							<!-- ACCORDION -->
							<div class="accordion panel-group" id="accordion2">

								

								<!-- DELIVERY ADDRESS -->

								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="" href="javascript:void">
												<strong>Доставка</strong>
											</a>
										</h4>
									</div>
									<div id="acordion_1" class="collapse in">
										<div class="panel-body">

											<fieldset>					
												<div class="row">
													<div class="col-md-6">
														<label class="input">
															<i class="icon-prepend fa fa-user"></i>
															<input type="text" placeholder="Имя" name="clientName" value="<?php echo $userData['name']?>">
														</label>
													</div>
													<div class="col-md-6">
														<label class="input">
															<i class="icon-prepend fa fa-user"></i>
															<input type="text" placeholder="Фамилия" name="clientLastName" value="<?php echo $userData['fname']?>">
														</label>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-6">
														<label class="input">
															<i class="icon-prepend fa fa-envelope"></i>
															<input type="email" placeholder="E-mail" name="clientEmail" value="<?php echo $userData['login']?>">
														</label>
													</div>
													<div class="col-md-6">
														<label class="input">
															<i class="icon-prepend fa fa-phone"></i>
															<input type="tel" placeholder="Телефон"  name="clientPhone" value="<?php echo $userData['phone']?>">
														</label>
													</div>
												</div>
											</fieldset>

											<!-- JUSTIFIED TAB -->
											<div class="tabs nomargin-top">

												<!-- tabs -->
												<ul class="nav nav-tabs nav-justified" input-id="delivery_method">
													<li class="active">
														<a data-val="1" href="#tab_1" data-toggle="tab" onclick="mainScript.calcDelivery();">
															Самовывоз
														</a>
													</li>
													<li>
														<a data-val="2" href="#tab_2" data-toggle="tab" onclick="mainScript.calcDelivery();">
															Нова Пошта
														</a>
													</li>
													<li>
														<a data-val="3" href="#tab_3" data-toggle="tab" onclick="mainScript.calcDelivery();">
															Доставка по Киеву
														</a>
													</li>
													<input type="hidden" id="delivery_method" name="delivery_method" value=""></input>
												</ul>



												<!-- tabs content -->
												<div class="tab-content">
													<div id="tab_1" class="tab-pane active">
														<h4>Самовывоз из нашего офиса в Киеве</h4>
														<hr class="half-margins"/>
														<p>Вы можете забрать свой заказ в нашем офисе по адресу:</p>
														 <p><?php echo $info[0]['company_address'] ?></p>
														<p>Рабочее время:</p> 
														<p><?php echo $info[0]['bussiness_hours']?></p>
													</div>

													<div id="tab_2" class="tab-pane">
														<h4>Доставка Новой Почтой в любую точку страны</h4>
														<hr class="half-margins"/>
														<section>
															<label class="label">Выберите ваш город</label>
															<label class="input">
																<input type="text" list="Citylist" name="np_city" placeholder="Начните вводить название вашего города..." onchange="mainScript.findParts();">
																<datalist id="Citylist">
																	<?php
																		foreach ($np_cities as $city)
																		{
																		?>	
																			<option value="<?php echo $city['DescriptionRu'] ?>"></option>

																		<?php	
																		}
																	?>
																</datalist>
															</label>

															<label class="label">Доступные отделения</label>
															<label class="input">
																<select type="select" size="" list="list" name="np_part" placeholder="Выберите удобное Вам отделение." id="partsList" size="200">
																<datalist id="list" style="overflow:scroll;">
															
																		<option value=" " style="height:20px;"></option>
																
																</datalist>
																</select>
															</label>
														</section>
													</div>

													<div id="tab_3" class="tab-pane">
														<h4>Доставка курьером по Киеву</h4>
														<hr class="half-margins"/>
														<p>Наш курьер доставит Ваш заказ в любое удобное для Вас время</p>
														<fieldset>
															<div class="row">												
																<div class="col-md-6">
																	<label class="input">
																		<input type="tel" placeholder="Улица" name="street">
																	</label>
																</div>
																
																<div class="col-md-3">
																	<label class="input">
																		<input type="tel" placeholder="Дом" name="house">
																	</label>
																</div>

																<div class="col-md-3">
																	<label class="input">
																		<input type="text" placeholder="Номер квартиры" name="appartments">
																	</label>
																</div>
															</div>

														</fieldset>
													</div>
												</div>

											</div>
											<!-- JUSTIFIED TAB -->

										</div>
									</div>
								</div>

								<!-- /DELIVERY ADDRESS -->

							

								<!-- REVIEW and PAYMENT -->

								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="" href="javascript:void">
												<strong>Способ оплаты</strong>
											</a>
										</h4>
									</div>
									<div id="acordion_3" class="collapse in">
										<div class="panel-body sky-form cartContent">
												<div class="row">
													<div class="col-md-12 inline-group">
														<?php
															$i=0;
															foreach ($payment as $item) 
															{ 
																$i++;
																	if($i==1){
																		?>
																		<label class="radio"><input type="radio" name="payment" value="<?php echo $item['id']?>" checked><i></i><?php echo $item['name']?></label>
																		<?php
																	}else{
																		?>
																		<label class="radio"><input type="radio" name="payment" value="<?php echo $item['id']?>"><i></i><?php echo $item['name']?></label>
																		<?php
																	}
															}
														?>
													</div>
												</div>
												
											<fieldset>

												<div>
													<label class="textarea">
														<textarea rows="3" placeholder="Примечания к заказу" name="details"></textarea>
													</label>
												</div>

											</fieldset>
										</div>
									</div>
									<span id="checkoutMessage" class="pull-left padding-top20"></span>
									<button type="button" onclick="mainScript.addNewOrder();" class="btn btn-primary btn-lg pull-right"><i class="fa fa-check"></i>Отправить заказ</button>
								</div>

								<!-- /REVIEW and PAYMENT -->


							</div>
							<!-- /ACCORDION -->


						</div>

						<div class="col-md-3">

							<!-- cart totals -->
							<div class="sky-form boxed cartContent">
								<header class="styleColor">Стоимость заказа</header>
								
								<fieldset>					
									
									<section class="clearfix cart_totals">
										<span class="pull-right fsize16"><?php echo $summaryPrice?>&nbsp;UAH</span>
										<span class="bold">Товаров на:</span>
									</section>

									<section class="clearfix cart_totals">
										<span class="pull-right fsize16"><span id="deliverySpan">Бесплатно</span></span>
										<span class="bold">Доставка:</span>
									</section>

									<section class="clearfix cart_totals noborder">
										<span class="pull-right fsize20 bold styleColor"><span id="totalCostSpan"><?php echo $summaryPrice?></span>&nbsp;UAH</span>
										<span class="bold fsize18">Сумма:</span>
									</section>

								</fieldset>

							</div>
							<!-- /cart totals -->
						</div>

					</form> <!-- /orderForm end -->
					</div>
						<?php 
						}else{?>
			
						<div class="alert callout alert-success"><!-- WARNING -->
						
									<div class="pull-left">

									<h4>
	
										Оформлять заказы могут только <a href="<?php echo RS.'login/'?>">авторизированные</a> пользователи.
									
									</h4>


									</div>
									<a href="<?php echo RS.'login/'?>" class="btn btn-primary btn-lg pull-right">Регистрация</a>
									<div class="clearfix"></div>

							</div>

						<?php
						}
						?>
				</div>
			</section>
			<!-- /CONTENT -->
