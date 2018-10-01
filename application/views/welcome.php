<!DOCTYPE html>
<html lang="es-MX">
<head>
	<?php $this->load->view('template_head'); ?>
</head>
<body>
	<?php $this->load->view('template_header_hidden'); ?>

	<div id="navbar-main" style="margin-bottom: 3px;"> <!-- Modificar margin-bottom según sea necesario para mandar hacia abajo template_footer -->
	    <div class="container">
	      	<div class="row">
				<div class="col-lg-4" align="center" style="padding-top: 170px;">
					<a href="http://catastrocolima.gob.mx/" title="Ir a la plataforma de Catastro Colima" target="_blank">
						<img id="logo-encabezado" src="images/logo-welcome.png">
					</a>
				</div>

				<div class="col-lg-3" align="center" style="padding-top: 190px;">
					<form action="index.php/Etl/etlhome/" method="post" name="beginETL">
						<button type="submit" title="INICIAR ETL" class="btn btn-primary btn-block">INICIAR ETL&nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
						</button>
					</form>
				</div>

				<div class="col-lg-5" align="justify">
					<?php
						if($this->session->userdata('gender') == "H") {
							$welcome = "Bienvenido, ";
						}
						else {
							$welcome = "Bienvenida, ";
						}
					?>
					<h2 class="text-success"><strong> <?php echo $welcome; ?> </strong>
						<?php echo '<strong>' . $this->session->userdata('username') . '</strong>';  ?>
					</h2>
					<p style="font-size: 13px;">
						<h3>¿Qué es un ETL?</h3>
						Un proceso ETL (Extraer-Transformar-Cargar en inglés) básico busca información relevante de una fuente de datos, en este caso una base de datos en Microsoft SQL Server<sup>®</sup>; después detecta, corrige y estandariza los registros que posean errores; y finalmente los envía a un almacén de datos para realizar consultas de Inteligencia de Negocios (BI).
						<h3>¿Qué debo hacer?</h3>
						Esta aplicación ha sido diseñada para detectar los errores en los atributos más importantes de cada capa del
						<a href="http://catastrocolima.gob.mx/cartografia.html" title="Ir al mapa cartográfico digital" target="_blank">mapa cartográfico</a> digital. Una vez que los errrores encontrados sean corregidos u omitidos, todos los registros de las capas serán enviados hacia un almacén de datos en Microsoft Excel<sup>®</sup> y/o MySQL.
						<br>
						Haga click en el <strong class="text-info">botón</strong> para iniciar el ETL.
					</p>
				</div>
			</div>
		</div>
	</div> <!-- navbar-main -->

<?php $this->load->view('template_footer'); ?>
</body>
</html>