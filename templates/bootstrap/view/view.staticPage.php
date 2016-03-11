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

					<?php echo $currPage['details'] ?>

				</div>
			</section>
			<!-- /CONTENT -->