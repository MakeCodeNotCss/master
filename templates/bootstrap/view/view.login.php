			<!-- PAGE TOP -->
			<section class="page-title">
				<div class="container">

					<header>

						<ul class="breadcrumb"><!-- breadcrumb -->
							<li><a href="<?php echo RS ?>">Home</a></li>
							<li class="active"><?php echo $currPage['name'] ?></li>
						</ul><!-- /breadcrumb -->

						<h2><!-- Page Title -->
							<?php echo $currPage['name'] ?>
						</h2><!-- /Page Title -->

					</header>

				</div>			
			</section>
			<!-- /PAGE TOP -->



<!-- CONTENT -->
			<section>
				<div class="container">

					<div class="row">
					
						<!-- LOGIN -->
						<div class="col-md-6 col-sm-6">
								

										<form id="userLoginForm" action="#" method="post" class="sky-form boxed">
											<header>Войти</header>

											<fieldset>

												<section>
													<label class="input">
														<i class="icon-append fa fa-envelope"></i>
														<input required type="email" placeholder="Логин (e-mail)" name="login" id="name" value="<?php echo $userData['login']?>"></input>
														<b class="tooltip tooltip-bottom-sright">Введите ваш e-mail адресс</b>
													</label>
												</section>
												
												<section>
													<label class="input">
														<i class="icon-append fa fa-lock"></i>
														<input required type="password" placeholder="Пароль" name="password" id="password" value="<?php echo md5(base64_decode($secret_key.$userData['pass']))?>"></input>
														<b class="tooltip tooltip-bottom-right">Введите ваш пароль</b>
													</label>
													<div class="note"><a href="#">Забыли ваш пароль?</a></div>
												</section>
												
												<section>
													<label class="checkbox"><input type="checkbox" name="checkbox-inline"><i></i>Запомнить меня</label>
												</section>

											</fieldset>
											<footer>
												<button type="button" onclick="mainScript.userLogin();" class="button">Войти</button>
												<p class="response"></p>
											</footer>
										</form>




						</div>
						<!-- /LOGIN -->

						<!-- REGISTER -->
						<div class="col-md-6 col-sm-6">

							<!-- registration form -->
							<form id="userRegisterForm" action="#" method="post" class="sky-form boxed">
								<header>Зарегистрироваться</header>
								
								<fieldset>								
									<section>
										<label class="input">
											<i class="icon-append fa fa-envelope"></i>
											<input required type="email" placeholder="Логин (e-mail)" name="email">
											<b class="tooltip tooltip-bottom-right">Введите ваш e-mail адресс</b>
										</label>
									</section>
									
									<section>
										<label class="input">
											<i class="icon-append fa fa-lock"></i>
											<input required type="password" placeholder="Пароль" name="password">
											<b class="tooltip tooltip-bottom-right">Введите ваш пароль</b>
										</label>
									</section>
									
									<section>
										<label class="input">
											<i class="icon-append fa fa-lock"></i>
											<input required type="password" placeholder="Подтверждение пароля" name="passwordConfirm">
											<b class="tooltip tooltip-bottom-right">Повторите пароль</b>
										</label>
									</section>
								</fieldset>
									
								<fieldset>
									<div class="row">
										<section class="col col-md-6">
											<label class="input">
												<input required type="text" placeholder="Имя" name="firstName">
											</label>
										</section>
										<section class="col col-md-6">
											<label class="input">
												<input required type="text" placeholder="Фамилия" name="lastName">
											</label>
										</section>
									</div>
									
									<section>
										<label class="checkbox"><input type="checkbox" name="terms"><i></i>Я согласен с условиями пользования</label>
										<label class="checkbox"><input type="checkbox" name="getNews"><i></i>Получать новости</label>
									</section>
								</fieldset>
								<footer>
									<button type="button" class="button" onclick="mainScript.userRegister();">Подтвердить регистрацию</button>
									<p class="response"></p>
								</footer>
							</form>
							<!-- /registration form -->

						</div>
						<!-- /REGISTER -->

					</div>

				</div>
			</section>
			<!-- /CONTENT -->