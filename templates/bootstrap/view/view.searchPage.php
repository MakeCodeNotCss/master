			<!-- PAGE TOP -->
			<section class="page-title">
				<div class="container">

					<header>


						<h2><!-- Page Title -->
							Результаты поиска
						</h2><!-- /Page Title -->

					</header>

				</div>			
			</section>
			<!-- /PAGE TOP -->



<!-- CONTENT -->
			<section>
				<div class="container">

					<!-- SEARCH -->
<!-- 					<form method="get" action="#" class="clearfix well well-sm search-big">
						<div class="input-group">

							<div class="input-group-btn">
								<button type="button" class="btn btn-default input-lg dropdown-toggle" data-toggle="dropdown">
									Everything <span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li class="active">
										<a href="#"><i class="fa fa-check"></i> Everything</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="j#">Articles</a>
									</li>
									<li>
										<a href="j#">Blog</a>
									</li>
									<li>
										<a href="j#">Products</a>
									</li>
									<li>
										<a href="#">Gallery</a>
									</li>
								</ul>
							</div>

							<input name="k" class="form-control input-lg" type="text" placeholder="Search...">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-default input-lg"><i class="fa fa-fw fa-search fa-lg"></i></button>
							</div>
						</div>

						<h6 class="nomargin"> 
							По вашему запросу найдено <?php echo $numResults ?> результатов <small class="text-success">(0.45 seconds) </small>
						</h6>
					</form> -->
					<!-- /SEARCH -->



					<div class="row">

						
						<!-- RIGHT -->

						
						<div class="col-md-12">
			

							<!-- SEARCH RESULTS -->
							<?php foreach($searchQuery as $item)
								{
								?>
									<div class="clearfix search-result"><!-- item -->
										<h4><a href="<?php echo RS.$item['alias'].'/'?>"><?php echo $item['name']?></a></h4>
										<small class="text-success"><?php echo $item['model']?></small>
										<small class="text-success"><?php echo $item['details']?></small>
										<img src="<?php echo PRODUCT_IMG_PATH.$item['file']?>" alt="" height="60" />
										<p><strong class="text-danger"><?php echo $item['price']?><?php echo $item['currency']?></strong></p>
										<a href="<?php echo RS.$item['alias'].'/'?>" class="text-success fsize12 bold">Перейти к товару</a>
									</div><!-- /item -->

								<?php 
								}
							?>
							
							<div class="clearfix search-result"><!-- item -->




						</div>

					</div>

				</div>
			</section>
			<!-- /CONTENT -->