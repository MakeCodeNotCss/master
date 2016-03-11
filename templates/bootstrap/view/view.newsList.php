
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

					<div id="blog" class="row">

						<!-- BLOG ARTICLE LIST -->
						<div class="col-md-9 col-sm-9">
						
						<?php
							foreach ($newsList as $item) 
								{ 
								?>


							<!-- article - image -->
							<div class="prev-article row">
								<div class="blog-prev-date col-md-3 col-sm-3">
									<span class="date"> <small><?php echo $helpObj->deformat_long_date($item['dateModify']) ?></small>
									</span>
									<span class="info hidden-xs">
										<span class="block"><i class="fa fa-user"></i> АВТОР: <a href="javascript:void">PARQUET-BOARD</a></span>
										<span class="block"><i class="fa fa-comments"></i> КОММЕНТАРИЕВ: <a href="javascript:void"><?php echo $item['com_count']?></a></span>
										<span class="block"><i class="fa fa-link"></i> <a href="javascript:void">PERMALINK</a></span>
									</span>
								</div>

								<div class="col-md-9 col-sm-9">

									<h2 class="article-title"><a href="<?php echo $item['alias'] ."/" ?>"><?php echo $item['name']?><span> </span></a></h2>

									<!-- image -->
									<figure>
										<a href="<?php echo $item['alias'] ."/" ?>">
											<img src="<?php echo NEWS_IMG.$item['filename'] ?>" class="img-responsive" alt="blog" />
										</a>
									</figure>

									<!-- blog short preview -->
									<p>
									<?php echo $helpObj->cropStr($item['content'], 200)  ?>						<?php // echo $item['preview'] ?>  
									</p>

									<!-- read more button -->
									<div class="text-right">
										<a href="<?php echo $item['alias'] ."/" ?>" class="read-more btn btn-xs"><i class="fa fa-sign-out"></i> Читать полностью</a>
									</div>

								</div>
							</div>

							<?php
							}
							?>



							<!-- PAGINATION -->
							<div class="row">
								<div class="col-md-8 text-right">
									<ul class="pagination">
									<?php

									if($f_pages_count <= $f_pag_size)
									{
										for($i=1; $i <= $f_pages_count; $i++)
										{
										?>
											<li class="<?php echo ($i == $f_page_num ? "active" : "") ?>"><a href="<?php echo RS . $currPage['alias'] . "/" . "?page=" . $i ?>"><?php echo $i ?></a></li>
										
										<?php
										}
									}
									elseif( $f_page_num <= 3 )
									{
										for($i=1; $i <= $f_pag_size; $i++)
										{
										?>
											<li class="<?php echo ($i == $f_page_num ? "active" : "") ?>"><a href="<?php echo RS . $currPage['alias'] . "/" . "?page=" . $i ?>"><?php echo $i ?></a></li>
										
										<?php
										}
										?>
											<li><a href="<?php echo RS . $currPage['alias'] . "/" . "?page=" . ($f_page_num+1) ?>"><i class="fa fa-angle-right"></i></a></li>
											<li><a href="<?php echo RS . $currPage['alias'] . "/" . "?page=" . $f_pages_count ?>"><i class="fa fa-angle-double-right"></i></a></li>
										<?php
									}
									elseif( $f_pages_count > ($f_pag_size+2) && $f_page_num < ($f_pages_count-2) )
									{
										?>
										<li><a href="<?php echo RS . $currPage['alias'] . "/" ?>"><i class="fa fa-angle-double-left"></i></a></li>
										<li><a href="<?php echo RS . $currPage['alias'] . "/" . "?page=" . ($f_page_num-1) ?>"><i class="fa fa-angle-left"></i></a></li>
										<?php
										for($i=($f_page_num-2); $i <= ($f_page_num+2); $i++)
										{
										?>
											<li class="<?php echo ($i == $f_page_num ? "active" : "") ?>"><a href="<?php echo RS . $currPage['alias']. "/" . "?page=" . $i ?>"><?php echo $i ?></a></li>
										
										<?php
										}
										?>
											<li><a href="<?php echo RS . $currPage['alias'] . "/" . "?page=" . ($f_page_num+1) ?>"><i class="fa fa-angle-right"></i></a></li>
											<li><a href="<?php echo RS . $currPage['alias'] . "/" . "?page=" . $f_pages_count ?>"><i class="fa fa-angle-double-right"></i></a></li>
										<?php
									}
									else{
										?>
										<li><a href="<?php echo RS . $currPage['alias'] . "/" ?>"><i class="fa fa-angle-double-left"></i></a></li>
										<li><a href="<?php echo RS . $currPage['alias'] . "/" . "?page=" . ($f_page_num-1) ?>"><i class="fa fa-angle-left"></i></a></li>
										<?php
										for($i=($f_pages_count-($f_pag_size-1)); $i <= $f_pages_count; $i++)
										{
										?>
											<li class="<?php echo ($i == $f_page_num ? "active" : "") ?>"><a href="<?php echo RS . $currPage['alias'] . "/" . "?page=" . $i ?>"><?php echo $i ?></a></li>
										
										<?php
										}
									}
									?>
									</ul>
								</div>

							</div>
							<!-- /PAGINATION -->


						</div>
						<!-- /BLOG ARTICLE LIST -->

						<!-- BLOG SIDEBAR -->
						<div class="col-md-3 col-sm-3">
						
							<!-- blog search -->
<!-- 							<div class="widget">
								<form id="newsletterSubscribe" method="post" action="php/newsletter.php" class="input-group">
									<input type="text" class="form-control" name="s" value="" placeholder="Поиск в новостях" />
									<span class="input-group-btn">
										<button class="btn btn-primary"><i class="fa fa-search"></i></button>
									</span>
								</form>
							</div> -->
						
							


					</div>


				</div>
			</section>
			<!-- /CONTENT -->