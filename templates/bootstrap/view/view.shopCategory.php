			
			<!-- PAGE TOP -->
			<section class="page-title">
				<div class="container">

					<header>

						<ul class="breadcrumb"><!-- breadcrumb -->
							<li><a href="<?php echo RS ?>">Home</a></li>
							<?php
							$curr_link = "";
							foreach($categoryBreadcrumbs as $i => $item)
							{
								$curr_link .= $item['alias'] . "/";

								if($i < (count($categoryBreadcrumbs)-1) )
								{
									?><li><a href="<?php echo RS.$curr_link ?>"><?php echo $item['name'] ?></a></li><?php
								}else
								{
									?><li class="active"><?php echo $item['name'] ?></li><?php
								}
							}
							?>
						</ul><!-- /breadcrumb -->

						<h2><!-- Page Title -->
							<?php echo $category['name'] ?>
							<small class="fsize14"><?php echo $category['details']?></small>
						</h2><!-- /Page Title -->

					</header>

				</div>			
			</section>
			<!-- /PAGE TOP -->



	<?php
	include_once("shop/shopFilters.php");
	?>