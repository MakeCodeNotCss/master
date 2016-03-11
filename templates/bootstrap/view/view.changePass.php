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
		                                          
	                    <!-- RIGHT -->
							<div class="tab-content transparent">
	                        	<!-- SETTINGS TAB 1 -->
								<div id="tab-s1" class="tab-pane active">                                            
	                            	<div>
	                                    <form name="changePassForm" id="change-password-form" action="#" method="POST">
	                                    <div class="form-group">
	                                        <div class="col-md-10">
	                                            <input type="password" name="pass" class="form-control" placeholder="Ваш текущий пароль">
	                                        </div>
	                                    </div>
	                                    <div class="form-group">
	                                        <div class="col-md-10">
	                                            <input type="password" name="newPass" class="form-control" placeholder="Ваш новый пароль">
	                                        </div>
	                                    </div>
	                                    <div class="form-group">
	                                        <div class="col-md-10">
	                                            <input type="password" name="newPassConfirm" class="form-control" placeholder="Подтверждение пароля">
	                                        </div>
	                                    </div>
	                                    <div class="margiv-top10">
	                                        <button class="btn btn-primary" type="button" onclick="mainScript.changePass();">Сохранить изменения</button>
	                                        <p class="response"></p>
	                                    </div>
	                                    </form>
	                                </div>
								</div>
								<!-- /SETTINGS TAB 1 -->
	                        </div>
        
                                            
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