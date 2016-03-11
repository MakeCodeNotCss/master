			<!-- PAGE TOP -->
			<section class="page-title">
				<div class="container">

					<header>

						<ul class="breadcrumb"><!-- breadcrumb -->
							<li><a href="<?php echo RS ?>">Home</a></li>
							<li><a href="<?php echo RS."news"."/" ?>">Новости</a></li>
							<li class="active"><?php echo $currentNew['name'] ?></li> 
						</ul><!-- /breadcrumb -->

						<h2><!-- Page Title -->
							<?php echo $currentNew['name'] ?> 
						</h2><!-- /Page Title -->

					</header>

				</div>			
			</section>
			<!-- /PAGE TOP -->



			<!-- CONTENT -->
			<section>
				<div class="container">

					<div id="blog" class="row">

						<!-- BLOG ARTICLE -->
						<div class="col-md-9 col-sm-9">

							<div class="prev-article row">

								<div class="blog-prev-date col-md-3 col-sm-3">
									<span class="date">
										<small><?php echo $helpObj->deformat_long_date($currentNew['dateModify']) ?></small>
									</span>
									<span class="info hidden-xs">
										<span class="block"><i class="fa fa-user"></i> АВТОР: <a href="javascript:void">PARQUET-BOARD</a></span>
										<span class="block"><i class="fa fa-comments"></i> КОММЕНТАРИЕВ: <a href="javascript:void"><?php echo $comm_count ?></a></span>
										<span class="block"><i class="fa fa-link"></i> <a href="javascript:void">PERMALINK</a></span>
									</span>
								</div>

								<div class="col-md-9 col-sm-9">

									<h1><span><?php echo $currentNew['name'] ?></span></h1>

									<!-- carousel -->
									
									<div class="owl-carousel text-center controlls-over" data-plugin-options='{"items": 1, "singleItem": true, "navigation": true, "pagination": true, "autoPlay": true, "transitionStyle":"fadeUp"}'><!-- transitionStyle: fade, backSlide, goDown, fadeUp,  -->
										<div class="item">
											<img src="<?php echo NEWS_IMG.$currentNew['filename'] ?>" class="img-responsive" alt="img" />
										</div>
									</div>
									<!-- /carousel -->

									<!-- image -->
									<!--<img src="assets/images/demo/about_2.jpg" class="img-responsive" alt="img" />-->
									<!-- /image -->

									<!-- video -->
									<!--
									<div class="embed-responsive embed-responsive-16by9">
										<iframe class="embed-responsive-item" src="http://player.vimeo.com/video/8408210" width="800" height="450"></iframe>
									</div>
									-->
									<!-- /video -->


									<!-- article content -->
									<article>
										<?php echo $currentNew['content'] ?>
									</article>


									<!-- SOCIAL -->
									<p class="socials">
										<a href="#" class="rounded-icon social fa fa-facebook"><!-- facebook --></a>
										<a href="#" class="rounded-icon social fa fa-vk"><!-- vk --></a>
									</p>


									<hr class="half-margins invisible" />


									<!-- COMMENTS -->
									<div id="comments">
										<h3>Комментарии (<span id="commentsCount"><?php echo $comm_count ?></span>)</h3>

										<!-- comment item -->
									<div id="comment_div">
										<?php
										if($currComment)
										{
											foreach($currComment as $comment)
												{ 
												?>

												<div class="comment">
												<span class="user-avatar">
												<img class="media-object" src="/assets/images/avatar.png" width="64" height="64" alt="">
											    </span>
										
													<div class="media-body">
														<a href="#commentForm" class="scrollTo replyBtn">Ответить</a>
														<h4 class="media-heading bold"><?php echo $comment['name']?>&nbsp;<?php echo $comment['fname']?></h4>
														<small class="block"><?php echo $comment['dateModify']?></small>
														<?php echo $comment['comment']?>
													</div>
													
												</div>
												<?php
												}
										}else{
											echo '<center>К этой новости пока что нет комментариев, но вы можете быть первым.</center>';
										
										}	
										?>
									</div>


										<hr />

												<?php
													if(ONLINE)
													{
													?>
														<!-- COMMENT FORM -->
														<form id="commentForm" name="commentForm" method="post" class="sky-form boxed">
															<header>Оставить комментарий</header>
																
															<fieldset>					
																<div class="row">
																	<section class="col col-md-6">
																		<label class="label">Имя</label>
																		<label class="input">
																			<i class="icon-append fa fa-user"></i>
																			<input type="text" name="name" value="<?php echo $userData['name']?>">
																		</label>
																	</section>
																	<section class="col col-md-6">
																		<label class="label">Фамилия</label>
																		<label class="input">
																			<i class="icon-append fa fa-envelope"></i>
																			<input type="text" name="l_name" value="<?php echo $userData['fname']?>">
																		</label>
																	</section>
																</div>
																
																<section>
																	<label class="label">Комментарий</label>
																	<label class="textarea">
																		<i class="icon-append fa fa-comments"></i>
																		<textarea rows="4" name="comment"></textarea>
																	</label>
																</section>
															</fieldset>
															<input type="hidden" name="art_id" value="<?php echo $currentNew['id'] ?>"></input>
															<footer>
																<button type="button" class="button" onclick="mainScript.addNewComment();">Добавить комментарий</button>
																<span id="responseWrap"></span>
															</footer>
														</form>
														<!-- /COMMENT FORM -->

													<?php
													}else{
													?>
														<span>Оставлять комментарии могут только <a href="<?php echo RS.login.'/'?>">зарегистрированные</a> пользователи</span>	

													<?php
													}
													?>


									</div><!-- /COMMENTS -->

								</div>

							</div>

						</div>
						<!-- /BLOG ARTICLE -->

						<!-- BLOG SIDEBAR -->
						<div class="col-md-3 col-sm-3">
						
							<!-- blog search -->
							<div class="widget">
								<form id="newsletterSubscribe" method="post" action="php/newsletter.php" class="input-group">
									<input type="text" class="form-control" name="s" value="" placeholder="Blog Search" />
									<span class="input-group-btn">
										<button class="btn btn-primary"><i class="fa fa-search"></i></button>
									</span>
								</form>
							</div>
						



						</div>
						<!-- /BLOG SIDEBAR -->

					</div>


				</div>
			</section>
			<!-- /CONTENT -->