			<!-- PAGE TOP -->
				<!--Modal window-->
				    <div id="quickOrderModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				      <div class="modal-dialog">
				       <div class="modal-content">

				        <div class="modal-header"><!-- modal header -->
				         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				         <h4 class="modal-title" id="myModalLabel">Быстрый заказ</h4>
				        </div><!-- /modal header -->

				        <!-- modal body -->
				        <div class="modal-body" id="quickOrderBody">
				         <form class="sky-form" method="POST" id="quickOrderForm" name="quickOrderForm">
				          <fieldset>
				           <section>
				            <label class="label">Введите Ваше имя</label>
				            <label class="input">
				             <i class="icon-append fa fa-user"></i>
				             <input type="text" name="quickOrderName" placeholder="Ваше имя" value="<?php echo $userData['name']?>">
				            </label>
				           </section>

				           <section>
				            <label class="label">Укажите свой номер и мы с Вами свяжемся</label>
				            <label class="input">
				             <i class="icon-append fa fa-phone"></i>
				             <input type="email" name="quickOrderPhone" placeholder="Ваш телефон" value="<?php echo $userData['phone']?>">
				            </label>
				           </section>
				           <div class="h100">
				           		<div class="pull-left">
									<img src="<?php echo PRODUCT_IMG_PATH.$images[0]['file'] ?>" style="max-height:100px; width:auto;" alt="" />
								</div>
								<div class="pull-left" style="margin-left:10px;">
					        		<?php echo $product['name']?> <br>
					        		<span> Стоимость: <strong><?php echo $product['price']?></strong> <?php echo $product['currency']?></span>
									<div class="">
										<input type="hidden" name="quickProdId" value="<?php echo $product['id']?>">
										<input  class="w50" type="number" value="1" name="quickOrderQty" maxlength="3" min="1" />
										<small>Выберите необходимое Вам количество</small>
									</div>	
								</div>
								<div class="clearfix"></div>
							</div>	
				          </fieldset>
				         </form>
				        </div>
				        <!-- /modal body -->

				        <div class="modal-footer" id='quickOrderBtns'><!-- modal footer -->
				                                    <span class="response color-red" id="QO_response"></span>
				                                    &nbsp;&nbsp;&nbsp;&nbsp;
				         <button class="btn btn-default" data-dismiss="modal">Отмена</button>
				         <button type="button" onclick="mainScript.sendQuickOrder();" class="btn btn-primary">Отправить заказ</button>
				        </div><!-- /modal footer -->

				       </div>
				      </div>
				    </div>

			<!-- /CONTENT -->