<div class="row">
	<section class="content-header" style="padding-top: 0px">
	  <h2 class="text-center"><?php echo __('Detalle transacción'); ?></h2>
	</section>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border"></div>

			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered">
							<thead>
								<th>Label</th>
								<th>Información</th>
							</thead>
							<tbody>
								<tr>
									<td><?php echo __("Razon social") ?></td>
									<td><?php echo __("PlaceToPay - TEST") ?></td>
								</tr>
								<tr>
									<td><?php echo __("NIT") ?></td>
									<td><?php echo __("800.000.000") ?></td>
								</tr>
								<tr>
									<td><?php echo __("Fecha y hora") ?></td>
									<td><?php echo date("Y-m-d H:i:s",strtotime($response->status()->date())) ?></td>
								</tr>
								<tr>
									<td><?php echo __("Motivo") ?></td>
									<td>
										<?php echo $response->status()->reason() ?> -
										<?php echo $response->status()->message() ?> 
									</td>
								</tr>
								<tr>
									<td><?php echo __("Valor") ?></td>
									<td>
										<?php echo $response->request->payment()->amount()->currency() ?> <?php echo number_format($response->request->payment()->amount()->total()) ?>
									</td>
								</tr>
								<tr>
									<td><?php echo __("IVA") ?></td>
									<td>
										<?php echo $response->request->payment()->amount()->currency() ?> <?php echo number_format($response->request->payment()->amount()->taxAmount()) ?>
									</td>
								</tr>
								<tr>
									<td><?php echo __("Franquicia") ?></td>
									<td>
										<?php echo $paymentInfo->franchise() ?> 
									</td>
								</tr>
								<tr>
									<td><?php echo __("Banco") ?></td>
									<td>
										<?php echo $paymentInfo->issuerName() ?> 
									</td>
								</tr>
								<tr>
									<td><?php echo __("Autorización - CUS") ?></td>
									<td>
										<?php echo $paymentInfo->authorization() ?> 
									</td>
								</tr>
								<tr>
									<td><?php echo __("Recibo") ?></td>
									<td>
										<?php echo $paymentInfo->receipt() ?> 
									</td>
								</tr>
								<tr>
									<td><?php echo __("Referencia") ?></td>
									<td>
										<?php echo $paymentInfo->internalReference() ?> 
									</td>
								</tr>
								<tr>
									<td><?php echo __("Descripción") ?></td>
									<td>
										<?php echo $response->request->payment()->description() ?> 
									</td>
								</tr>
								<tr>
									<td><?php echo __("DirecciónIP") ?></td>
									<td>
										<?php echo $_SERVER["REMOTE_ADDR"] ?> 
									</td>
								</tr>
								<tr>
									<td><?php echo __("Cliente") ?></td>
									<td>
										<?php echo $response->request->payer()->name() ?> <?php echo $response->request->payer()->surname() ?> 
									</td>
								</tr>
								<tr>
									<td><?php echo __("Email") ?></td>
									<td>
										<?php echo $response->request->payer()->email() ?> 
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<?php echo __("Si tiena alguna inquietud contáctenos al teléfono 3136429178 PLACETOPAY-TEST o via email test@prueba.com") ?>
									</td>
								</tr>
								<tr>
									<td colspan="1" class="text-center">
										<a href="/" class="btn btn-succes pull-right"><?php echo __("Continuar") ?></a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>