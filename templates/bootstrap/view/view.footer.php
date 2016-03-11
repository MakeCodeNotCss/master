			<!-- FOOTER -->
			<footer id="footer">
				<div class="container">

					<div class="row">

						<!-- col #1 -->
						<div class="logo_footer dark col-md-3">

							<img alt="" src="<?php echo RS ?>assets/images/demo/logo/darkgreen_light.png" height="50" class="logo" />

							<p class="block">
								4th Street, Suite 88<br />
								New York NY 10887<br />
								Email: youremail@yourdomain.com<br />
								Phone: +40 (0) 111 1234 567<br />
								Fax: +40 (0) 111 1234 568<br />
							</p>

							<p class=""><!-- social -->
								<a href="#" class="social fa fa-facebook"></a>
								<a href="#" class="social fa fa-vk"></a>
							</p><!-- /social -->
						</div>
						<!-- /col #1 -->

						<!-- col #2 -->
						<div class="spaced col-md-3 col-sm-4">
							<h4>Наши <strong>Услуги</strong></h4>
							<ul class="list-unstyled">
								<li>
									<a class="block" href="#">New CSS3 Transitions this Year</a>
									<small>June 29, 2014</small>
								</li>
								<li>
									<a class="block" href="#">Inteligent Transitions In UX Design</a>
									<small>June 29, 2014</small>
								</li>
								<li>
									<a class="block" href="#">Lorem Ipsum Dolor</a>
									<small>June 29, 2014</small>
								</li>
							</ul>
						</div>
						<!-- /col #2 -->

						<!-- col #3 -->
						<div class="spaced col-md-3 col-sm-4">
							<h4>Паркетные <strong>Новости</strong></h4>
							<ul class="list-unstyled fsize13">
								<li>
									<i class="fa fa-twitter"></i> <a href="#">@John Doe</a> Pilsum dolor lorem sit consectetur adipiscing orem sequat <small class="ago">8 mins ago</small>
								</li>
								<li>
									<i class="fa fa-twitter"></i> <a href="#">@John Doe</a> Remonde sequat ipsum dolor lorem sit consectetur adipiscing  <small class="ago">8 mins ago</small>
								</li>
								<li>
									<i class="fa fa-twitter"></i> <a href="#">@John Doe</a> Imperdiet condimentum diam dolor lorem sit consectetur adipiscing <small class="ago">8 mins ago</small>
								</li>
							</ul>
						</div>
						<!-- /col #3 -->

						<!-- col #4 -->
						<div class="spaced col-md-3 col-sm-4">
							<h4>О <strong>Нас</strong></h4>
							<p>
								Incredibly beautiful responsive Bootstrap Template for Corporate and Creative Professionals.
							</p>

							<h4><small><strong>Подписка на наши новости</strong></small></h4>
							<form id="newsletterSubscribe" method="post" action="php/newsletter.php" class="input-group">
								<input required type="email" class="form-control" name="newsletter_email" id="newsletter_email" value="" placeholder="E-mail">
								<span class="input-group-btn">
									<button class="btn btn-primary">Подписаться</button>
								</span>
							</form>

						</div>
						<!-- /col #4 -->

					</div>

				</div>

				<hr />

				<div class="copyright">
					<div class="container text-center fsize12">
						Все права защищены &copy; Parquet Board Company. &nbsp;
						<a href="#" class="fsize11">Авторские права</a> &bull; 
						<a href="#" class="fsize11">Правила использования</a>
					</div>
				</div>
			</footer>
			<!-- /FOOTER -->
							

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
									<form action="" class="sky-form">
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
													<input type="email" name="email" placeholder="Ваш e-mail">
												</label>
											</section>
										</fieldset>
									</form>
								</div>
								<!-- /modal body -->

								<div class="modal-footer"><!-- modal footer -->
									<button type="button" onclick="sendFeedBack();" class="btn btn-primary">Отправить сообщение</button>
								</div><!-- /modal footer -->

							</div>
						</div>
					</div>

