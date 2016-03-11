			<!-- PAGE TOP -->
			<section class="page-title">
				<div class="container">

					<header>

						<ul class="breadcrumb"><!-- breadcrumb -->
							<li><a href="<?php echo RS ?>">Home</a></li>
							<li class="active">Личный кабинет</li>
						</ul><!-- /breadcrumb -->

						<h2><!-- Page Title -->
							Личный кабинет
						</h2><!-- /Page Title -->

					</header>

				</div>			
			</section>
			<!-- /PAGE TOP -->



			<!-- CONTENT -->
			<section>
			<div class="container">

<?php include_once("view.accountMenu.php");?>

				<div class="col-md-9 ">
					<div class="accountInfo">
		                                          
	                    <!-- private-info -->
	                    <form id="updateInfoForm" id="updateInfoForm" role="form" action="#" method="post">
								<div class="form-group">
	                                <label for="shippingFirstName" class="col-md-2 control-label">Имя</label>
	                                <div class="col-md-10">
	                                    <input type="text" class="form-control" name="name" value="<?php echo $userData['name'] ?>">
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label for="shippingLastName" class="col-md-2 control-label">Фамилия</label>
	                                <div class="col-md-10">
	                                    <input type="text" class="form-control" name="fname" value="<?php echo $userData['fname'] ?>">
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label for="shippingTel" class="col-md-2 control-label">Телефон<small class="text-default">*</small></label>
	                                <div class="col-md-10">
	                                    <input type="text" class="form-control" name="phone" value="<?php echo $userData['phone'] ?>">
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label for="shippingemail" class="col-md-2 control-label">Email<small class="text-default">*</small></label>
	                                <div class="col-md-10">
	                                    <input type="email" class="form-control" name="email" value="<?php echo $userData['login'] ?>">
	                                </div>
	                            </div>
	                            <hr>
	                            <div class="form-group">
	                                <label for="shippingAddress1" class="col-md-2 control-label"><strong>Адрес</strong> доставки</label>
	                                <div class="col-md-10">
	                                    <textarea class="form-control" rows="4" name="delivery"><?php echo $userData['delivery_address'] ?></textarea>
	                                </div>
	                            </div>
	                            <div class="margiv-top10">
	                            	<button class="btn btn-primary right" type="button" onclick="mainScript.updateUserInfo();">Сохранить изменения</button>
									<span class="response"></span>
								</div>
							</form>			
	                    <!-- private-info end -->
                                            
					</div>

					<hr style="margin:0;">
						<p class="userSubMenu">

							<p class="response"></p>
						</p>

				</div>

				<div class="clear"></div>
			</div>	
			</section>
			<!-- /CONTENT -->