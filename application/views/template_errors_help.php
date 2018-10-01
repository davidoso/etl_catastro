<div class="col-sm-12" style="text-align:right">
	<a data-toggle="modal" data-target="#myModalHelp" style="cursor: pointer;">
	<img src="images/help.png" class="img-circle" title="Guía de uso" style="height: 32px; width: 32px;">
	</a>
</div>

<div class="modal fade" id="myModalHelp" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header" style="background-color: #eee;" align="center">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">
					<img src="images/help.png" id="logo-alertaModal" style="height: 32px; width: 32px;">
				</h4>
				<h3 align="center" class="text-secondary">Guía de uso</h3>
			</div> <!-- modal-header -->

			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<label>Consejos para realizar el ETL:</label>
							<ul id="ulmodalhelp">
								<li>Para corregir un error, seleccione una celda y escriba el nuevo dato.</li>
								<li>Para la mayoría de los tipos de error detectados, los datos inválidos serán marcados en rojo.</li>
								<li>El proceso ETL realiza las correcciones de la siguiente forma:
									<ul id="ulmodalhelpnested">
										<li>De un dato <strong class="text-success">válido</strong> a un <strong class="text-danger">inválido</strong>: <strong>No actualiza</strong>.</li>
										<li>De un dato <strong class="text-success">válido</strong> a un <strong class="text-success">válido</strong>: <strong>Actualiza</strong>.</li>
										<li>De un dato <strong class="text-danger">inválido</strong> a un <strong class="text-success">válido</strong>: <strong>Actualiza</strong>.</li>
										<li>De un dato <strong class="text-danger">inválido</strong> a un <strong class="text-danger">inválido</strong>: <strong>No actualiza</strong>.</li>
									</ul>
								</li>
								<li>Cuando haya terminado de editar, pulse el botón <i>CORREGIR ERRORES</i>.</li>
								<li>Los errores que se puedan corregir automáticamente serán modificados cuando pulse el botón por primera vez.</li>
								<li>Haga doble click en el ícono <?php echo "\u{1F6AE}"; ?> para seleccionar y eliminar todos los registros erróneos. Tenga en cuenta que la información enviada al almacén puede resultar incompleta.</li>
								<li>Para obtener información adicional de un registro en particular, consulte sus coordenadas en el mapa cartográfico.</li>
							</ul>
						</div>
					</div>
				</form>
			</div> <!-- modal-body -->
		</div> <!-- modal-content -->
	</div> <!-- modal-dialog -->
</div> <!-- modal fade -->