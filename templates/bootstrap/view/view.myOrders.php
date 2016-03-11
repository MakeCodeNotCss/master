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

					<!-- HISTORY TABLE -->
					<div class="col-md-9">
					<?php 
					if($myOrders)
					{
					?>
					<table class="table table-hover">
						<!-- table head -->
						<thead>
							<tr>
								<th>#</th>
								<th>Номер заказа</th>
								<th>Дата</th>
								<th>Стоимость</th>
								<th>Статус</th>
							</tr>
						</thead>
						
						<!-- table items -->
						<tbody>
						
						<?php 
							$num=0;
							foreach($myOrders as $item)
							{
								$num++
							?>
								<tr><!-- item -->
									<td><?php echo $num?></td>
									<td><?php echo $item['id']+5000?></td>
									<td><?php echo $item['dateCreate']?></td>
									<td><?php echo $item['sum']?> грн.<small>(<?php echo $item['products_quant']?> единиц)</small></td>
									<td><?php echo $item['name']?></td>
								</tr><!-- /item -->

							<?php
							}
						?>

						</tbody>
					</table>
					<!-- /HISTORY TABLE -->
					<?php
					}else{
						echo '<center>Ваш список заказов пока еще пуст.</center>';
					}
					?>
					</div>


					<div class="divider half-margins"><!-- divider 30px --></div>
		
					

				</div>
			</section>
			<!-- /CONTENT -->