				<!-- Top Nav -->
				<header id="topNav">
					<div class="container">

						<!-- Mobile Menu Button -->
						<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
							<i class="fa fa-bars"></i>
						</button>


						<!-- Top Nav -->
						<div class="navbar-collapse nav-main-collapse collapse">
							<nav class="nav-main">

								<!--
									NOTE
									
									For a regular link, remove "dropdown" class from LI tag and "dropdown-toggle" class from the href.
									Direct Link Example: 

									<li>
										<a href="#">HOME</a>
									</li>
								-->


								<?php 

								echo $megaMenuHTML;

								/*

								<ul id="topMain" class="nav nav-pills nav-main colored">
									<li class="mega-menu dropdown active">
										<a class="dropdown-toggle" href="#">
											ЛАМИНАТ <span>все виды</span>
										</a>
										<ul class="dropdown-menu">
									
										</ul>
									</li>
									<li class="dropdown">
										<a class="dropdown-toggle" href="#">ПАРКЕТНАЯ <span>доска</span></a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo RS."shop/" ?>">Category 1</a></li>
											<li><a href="#">Category 2</a></li>
											<li><a href="#">Category 3</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a class="dropdown-toggle" href="#">МАССИВНАЯ <span>доска</span></a>
										<ul class="dropdown-menu">
											<li><a href="#">Category 1</a></li>
											<li><a href="#">Category 2</a></li>
											<li><a href="#">Category 3</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a class="dropdown-toggle" href="#">ПОЛ <span>на любой вкус</span></a>
										<ul class="dropdown-menu">
											<li>
                                            	<a class="dropdown-toggle" href="#">Винниловый</a>
                                                <ul class="dropdown-menu">
                                                	<li><a href="#">Category 1</a></li>
													<li><a href="#">Category 2</a></li>
													<li><a href="#">Category 3</a></li>
                                                </ul>
                                            </li>
											<li class="divider"></li>
											<li>
                                            	<a class="dropdown-toggle" href="#">Пробковый</a>
                                            	 <ul class="dropdown-menu">
                                                	<li><a href="#">Category 1</a></li>
													<li><a href="#">Category 2</a></li>
													<li><a href="#">Category 3</a></li>
                                                </ul>
                                            </li>
										</ul>
									</li>
									<li class="dropdown">
										<a class="dropdown-toggle" href="#">АКСЕССУАРЫ <span>к товарам</span></a>
										<ul class="dropdown-menu">
											<li><a href="#">Category 1</a></li>
											<li><a href="#">Category 2</a></li>
											<li><a href="#">Category 3</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a class="dropdown-toggle" href="#">РАСПРОДАЖА <span>скидки</span></a>
										<ul class="dropdown-menu">
											<li><a href="#">Category 1</a></li>
											<li><a href="#">Category 2</a></li>
										</ul>
									</li>
								</ul>

								*/ ?>

							</nav>
						</div>
						<!-- /Top Nav -->

					</div><!-- /.container -->
				</header>
				<!-- /Top Nav -->

