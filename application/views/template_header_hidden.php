<div class="navbar navbar-inverse" style="font-family: 'ColabReg'; padding-top: 15px;">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="http://www.catastrocolima.gob.mx/cartografia.html" title="Ir al mapa cartográfico digital" target="_blank"><b>MAPA CARTOGRÁFICO</b></a>
		</div>

		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav" style="font-size: 13px; color: white; visibility: hidden;">
				<li style="margin-left: 40px;">
					<center>
						<a href="index.php/Etl/etlhome/" title="Página de Inicio">
							<img src="images/op-Home.png" style="width: 40px; background-color: #1a1a1a;">
						</a>
					</center><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;Inicio
				</li>

				<li style="margin-left: 50px;">
					<div class="dropdown-hover">
						<center>
							<img src="images/op-Street.png" style="width: 40px; background-color: #1a1a1a;" title="Carpeta Generales">
							<div class="dropdown-hover-content" style="margin-right: 8px; margin-top: 18px;">
								<a href="index.php/Etl/bancos/" title="Capa Bancos">Bancos</a>
								<a href="index.php/Etl/hoteles/" title="Capa Hoteles">Hoteles</a>
								<a href="index.php/Etl/postes/" title="Capa Postes C.F.E. y Telmex">Postes</a>
								<a href="index.php/Etl/telefonos/" style="padding-bottom: 12px;" title="Capa Teléfonos Públicos">Teléfonos Públicos</a>
							</div>
						</center>Generales
					</div>
				</li>

				<li style="margin-left: 50px;">
					<div class="dropdown-hover">
						<center>
							<img src="images/op-Museum.png" style="width: 40px; background-color: #1a1a1a;" title="Carpeta INAH">
							<div class="dropdown-hover-content" style="min-width: 180px; margin-right: 8px; margin-top: 18px;">
								<a href="index.php/Etl/monumentos/" style="padding-bottom: 12px;" title="Capa Monumentos Históricos">Monumentos Históricos</a>
							</div>
						</center>Monumentos INAH
					</div>
				</li>

				<li style="margin-left: 50px;">
					<div class="dropdown-hover">
						<center>
							<img src="images/op-Store.png" style="width: 40px; background-color: #1a1a1a;" title="Carpeta Comercio">
							<div class="dropdown-hover-content" style="min-width: 165px; margin-right: 8px; margin-top: 18px;">
								<a href="index.php/Etl/mercados/" title="Capa Mercados">Mercados</a>
								<a href="index.php/Etl/padronmercados/" title="Capa Locatarios Mercados">Locatarios Mercados</a>
								<a href="index.php/Etl/tianguis/" title="Capa Tianguis">Tianguis</a>
								<a href="index.php/Etl/padrontianguis/" title="Capa Tianguistas">Tianguistas</a>
								<a href="index.php/Etl/plazas/" title="Capa Plazas Comerciales">Plazas Comerciales</a>
								<a href="index.php/Etl/giroscomerciales/" style="padding-bottom: 12px;" title="Capa Licencias de Giros Comerciales">Giros Comerciales</a>
							</div>
						</center>Comercio
					</div>
				</li>

				<li style="margin-left: 50px;">
					<div class="dropdown-hover">
						<center>
							<img src="images/op-Sports.png" style="width: 40px; background-color: #1a1a1a;" title="Carpeta Deporte">
							<div class="dropdown-hover-content" style="margin-right: 8px; margin-top: 18px;">
								<a href="index.php/Etl/etlhome#Canchas/" title="Capa Canchas">Canchas</a>
								<a href="index.php/Etl/etlhome#Infraestructura/" style="padding-bottom: 12px;" title="Capa Infraestructura Deportiva">Infraestructura Deportiva</a>
							</div>
						</center>Deporte
					</div>
				</li>

				<li style="margin-left: 50px;">
					<div class="dropdown-hover">
						<center>
							<img src="images/op-Graves.png" style="width: 40px; background-color: #1a1a1a;" title="Carpeta Registro Civil">
							<div class="dropdown-hover-content" style="margin-right: 8px; margin-top: 18px;">
								<a href="index.php/Etl/panteon/" style="padding-bottom: 12px;" title="Capa Panteón Municipal">Panteón Municipal</a>
							</div>
						</center>Registro Civil
					</div>
				</li>

				<li style="margin-left: 50px; margin-top: -8px;">
					<div class="dropdown-hover">
						<center>
							<img src="images/op-Lines.png" style="width: 90px; background-color: #1a1a1a;" title="Carpeta Servicios Públicos">
							<div class="dropdown-hover-content" style="margin-right: 8px; margin-top: 18px;">
								<a href="index.php/Etl/luminarias/" style="padding-bottom: 12px;" title="Capa Luminarias">Luminarias</a>
							</div>
						</center>Servicios Públicos
					</div>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li>
					<a class="dropdown-toggle" data-toggle="dropdown" href="index.php/Etl/signout">
						<img src="images/logo-login.png" class="img-circle">
						<?php
							echo $this->session->userdata('username');
						?>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" style="margin-top: 9px;">
						<li>
						    <a href="index.php/Etl/signout">
						    <span class="glyphicon glyphicon-log-out"></span>  Cerrar sesión</a>
						</li>
					</ul>
				</li>
			</ul>
		</div> <!-- navbar-collapse -->
	</div> <!-- container -->
</div> <!-- navbar-inverse -->