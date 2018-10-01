<?php
	try {
		$serverName = "CHELSEA\SQLSERVER2016";
		$database = "CATASTRO_DATA_SOURCE";

    	// Get UID and PWD from application-specific files
    	$uid = "catastro";
    	$pwd = "catastro";

		// Execute SP to check whether there still exits table with wrong tuples
		$conn = new PDO("sqlsrv:server=$serverName; Database=$database");
		$query = "EXEC usp_vistas_con_errores";
		$stmt = $conn->prepare($query);
		try {
			$stmt->execute();
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
		$conn = null; // Close DB connection

		// Retrieve DB tables which have errors
		$conn = new PDO("sqlsrv:server=$serverName; Database=$database", $uid, $pwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "SELECT * FROM dbo.tbl_vistas_con_errores ORDER BY 1";

		// Adapt HTML code. fetch() will return false if the select query return no rows
		if($conn->query($query)->fetch()) {
			$data = $conn->query($query)->fetchAll();

			print "<h2 id='lblError' class='text-danger'><strong>¡Se han detectado errores!</strong></h2>";
			print "<p id='pError' style='font-size: 13px;'>
				<h3>¿Por qué estoy viendo esto?</h3>
				Se han detectado errores en la fuente de datos. Para continuar el proceso ETL, es necesario <strong>corregir</strong> (modificar) u <strong>omitir</strong> (eliminar) los registros erróneos encontrados en las siguientes carpetas y capas:<br>";

			print "<ul id='ulviewswitherrors'>";
			foreach($data as $row) {
				switch(true) {
					case stripos($row['vista'], 'BANCO') !== false: echo '<li><a href="index.php/Etl/bancos/" class="text-danger" title="Revisar errores en Capa Bancos">'. $row['vista'] . '</a></li>';
						break;
					case stripos($row['vista'], 'HOTEL') !== false: echo '<li><a href="index.php/Etl/hoteles/" class="text-danger" title="Revisar errores en Capa Hoteles">'. $row['vista'] . '</a></li>';
						break;
					case stripos($row['vista'], 'POSTE') !== false: echo '<li><a href="index.php/Etl/postes/" class="text-danger" title="Revisar errores en Capa Postes C.F.E. y Telmex">'. $row['vista'] . '</a></li>';
						break;
					case stripos($row['vista'], 'TELEFONO') !== false: echo '<li><a href="index.php/Etl/telefonos/" class="text-danger" title="Revisar errores en Capa Teléfonos Públicos">'. $row['vista'] . '</a></li>';
						break;
					case stripos($row['vista'], 'MONUMENTO') !== false: echo '<li><a href="index.php/Etl/monumentos/" class="text-danger" title="Revisar errores en Capa Monumentos Históricos">'. $row['vista'] . '</a></li>';
						break;
					case stripos($row['vista'], 'LOCATARIO') !== false: echo '<li><a href="index.php/Etl/padronmercados/" class="text-danger" title="Revisar errores en Capa Locatarios Mercados">'. $row['vista'] . '</a></li>';
						break;
					case stripos($row['vista'], 'MERCADO') !== false: echo '<li><a href="index.php/Etl/mercados/" class="text-danger" title="Revisar errores en Capa Mercados">'. $row['vista'] . '</a></li>';
						break;
					case stripos($row['vista'], 'TIANGUISTA') !== false: echo '<li><a href="index.php/Etl/padrontianguis/" class="text-danger" title="Revisar errores en Capa Tianguistas">'. $row['vista'] . '</a></li>';
						break;
					case stripos($row['vista'], 'TIANGUIS') !== false: echo '<li><a href="index.php/Etl/tianguis/" class="text-danger" title="Revisar errores en Capa Tianguis">'. $row['vista'] . '</a></li>';
						break;
					case stripos($row['vista'], 'PLAZA') !== false: echo '<li><a href="index.php/Etl/plazas/" class="text-danger" title="Revisar errores en Capa Plazas Comerciales">'. $row['vista'] . '</a></li>';
						break;
					case stripos($row['vista'], 'GIRO') !== false: echo '<li><a href="index.php/Etl/giroscomerciales/" class="text-danger" title="Revisar errores en Capa Giros Comerciales Licencias">'. $row['vista'] . '</a></li>';
						break;
					case stripos($row['vista'], 'PANTEON') !== false: echo '<li><a href="index.php/Etl/panteon/" class="text-danger" title="Revisar errores en Capa Panteón Municipal">'. $row['vista'] . '</a></li>';
						break;
					case stripos($row['vista'], 'LUMINARIA') !== false: echo '<li><a href="index.php/Etl/luminarias/" class="text-danger" title="Revisar errores en Capa Luminarias">'. $row['vista'] . '</a></li>';
						break;
					default: echo 'ERROR. ESTE DEFAULT NO DEBE MOSTRARSE!';
						break;
				} // switch
			} // foreach
			print "</ul>";

			print "Puede seleccionar las capas en la lista anterior o navegar a través del menú en la parte superior.<br>
				El botón para continuar el proceso ETL se activará cuando todos los errores se hayan corregido o eliminado.<br><br>
				<strong class='text-warning'><i class='fa fa-sticky-note-o' aria-hidden='true'></i>&nbsp;&nbsp;Nota</strong><br>
				<p style='border-top: 1px solid #F3A530;'>
				Si un registro erróneo se elimina, no se borra de la fuente de datos, sólo se omite en la carga hacia el almacén.
				</p>
			</p>";
		} // if
    	else {
			print "<h2 id='lblError' class='text-success'><strong>¡Felicidades! No se han detectado errores</strong></h2>";
			print "<p id='pError' style='font-size: 13px;'>
				<h3>¿Qué significa?</h3>
				En este momento <strong class='text-success'>la etapa de transformación ha concluido</strong>, lo que quiere decir que todos los registros de las capas están libres de errores en los campos más relevantes para el almacén de datos. Estos datos son coherentes y teóricamente útiles para obtener reportes, gráficas y otras consultas tanto estáticas como dinámicas, así como para realizar un análisis a través de técnicas de minería de datos y cubos OLAP.<br>
				Haga click en el <strong class='text-info'>botón</strong> para continuar el ETL.
				</p>";
			print
				"<script>
					window.onload = function() {
						document.getElementById('btnContinue').style.pointerEvents = 'auto';
						document.getElementById('formbtnContinue').setAttribute('style', 'cursor: pointer;');
					}
				</script>";
		} // else
	} // try
	catch(PDOException $e) {
    	echo 'ERROR: ' . $e->getMessage();
	} // catch
    // Free statement and connection resources
	$stmt = null;
	$data = null;
    $conn = null;

?>