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

			<!-- GOOGLE MAP -->
			<div id="gmap" class="grayscale"><!-- map container --></div>
			<script type="text/javascript">
				var	$googlemap_latitude 	= 50.459091,
					$googlemap_longitude	= 30.524833,
					$googlemap_zoom			= 13;
			</script>
			<!-- /GOOGLE MAP -->


			<!-- CONTENT -->
			<section>
				<div class="container">

					<div class="row">

							<!-- FORM -->
							      <div class="col-md-8">

							       <h3><strong><em>Свяжитесь</em></strong> с нами.</h3>

							       <form id="contactfBform" action="#" method="POST">
							        <div class="row">
							         <div class="form-group">
							          <div class="col-md-6">
							           <label>Имя *</label>
							           <input type="text" maxlength="100" class="form-control" name="name" id="contact_name">
							          </div>
							          <div class="col-md-6">
							           <label>E-mail *</label>
							           <input type="email" maxlength="100" class="form-control" name="email" id="contact_email">
							          </div>
							         </div>
							        </div>
							        <div class="row">
							         <div class="form-group">
							          <div class="col-md-12">
							           <label>Организация</label>
							           <input type="text" value="" maxlength="100" class="form-control" name="contact_subject" id="contact_subject">
							          </div>
							         </div>
							        </div>
							        <div class="row">
							         <div class="form-group">
							          <div class="col-md-12">
							           <label>Сообщение *</label>
							           <textarea maxlength="5000" rows="3" class="form-control" name="message" id="contact_comment"></textarea>
							          </div>
							         </div>
							        </div>

							        <br />

							        <div class="row">
							         <div class="col-md-12">
							          <input type="button" onclick="contactFeedBack();" value="Отправить сообщение" class="btn btn-primary" id="contact_submit" />
							                                        &nbsp;&nbsp;&nbsp;&nbsp;
							                                        <!-- Alert -->
							                                        <span class="response color-red"></span>                                        
							         </div>
							        </div>
							       </form>

							      </div>
							      <!-- /FORM -->


						<!-- INFO -->
						<div class="col-md-4">

							<h3><strong><em>Посетите</em></strong> нас</h3>

							<p>
								Информация о нашем местонахождении.
							</p>

							<div class="divider half-margins"><!-- divider --></div>

							<p>
								<span class="block"><strong><i class="fa fa-map-marker"></i> Наш адресс:</strong> Украина, Киев</span>
								<span class="block"><strong><i class="fa fa-phone"></i> Контактный номер:</strong> <a href="tel:1800-555-1234"><?php echo $info[0]['phone_number']?></a></span>
								<span class="block"><strong><i class="fa fa-envelope"></i> Email:</strong> <a href="mailto:<?php echo $info[0]['support_email']?>"><?php echo $info[0]['support_email']?></a></span>
							</p>

							<div class="divider half-margins"><!-- divider --></div>

							<h4 class="font300">Рабочее время:</h4>
							<p>
								<span class="block"><strong>Пн-Пт:</strong> 9:00 - 18:00</span>
								<span class="block"><strong>Суббота:</strong> 10:00 - 16:00</span>
								<span class="block"><strong>Воскресенье:</strong> Выходной</span>
							</p>

						</div>
						<!-- /INFO -->

					</div>

				</div>
			</section>
			<!-- /CONTENT -->



