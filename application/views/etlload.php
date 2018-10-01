<!DOCTYPE html>
<html lang="es-MX">
<head>
	<?php $this->load->view('template_head'); ?>
</head>
<body>
	<?php $this->load->view('template_header_hidden'); ?>

	<div id="navbar-main" style="margin-bottom: 261px;"> <!-- Modificar margin-bottom según sea necesario para mandar hacia abajo template_footer -->
		<div class="container">
	    	<div class="row">
				<div class="col-lg-12" align="center">
					<h2 class="text-info">
						<strong>Seleccione la opción destino del almacén de datos</strong>
					</h2>
				</div>

				<div class="col-lg-12" align="center">
					<div class="col-lg-4" align="center">
					</div>
					<div class="col-lg-4" align="center" style="padding-top: 30px;">
						<form id="formbtnExcel" action="application/views/php/exportToExcel.php" method="get">
							<button id="btnExcel" type="button" title="EXPORTAR DATOS A EXCEL" class="btn btn-success btn-block" value="0" disabled>EXPORTAR DATOS A EXCEL&nbsp;&nbsp;<i class="fa fa-file-excel-o" aria-hidden="true"></i>
							</button>
						</form>
					</div>
					<div class="col-lg-4" align="center">
					</div>
				</div>

				<div class="col-lg-12" align="center">
					<div class="col-lg-4" align="center">
					</div>
					<div class="col-lg-4" align="center" style="padding-top: 40px;">
						<form id="formbtnMysql" action="application/views/php/exportToMysql.php" method="post">
							<button id="btnMysql" type="button" title="EXPORTAR DATOS A MySQL" class="btn btn-warning btn-block" disabled>EXPORTAR DATOS A MySQL&nbsp;&nbsp;<i class="fa fa-database" aria-hidden="true"></i>
							</button>
						</form>
					</div>
					<div class="col-lg-4" align="left">
					</div>
				</div>
			</div>
		</div>
	</div> <!-- navbar-main -->

<?php $this->load->view('template_footer'); ?>

<script>
	$(document).ready(function() {
		$("#btnExcel").click(function() {
			// Only with btnExcel button (without a tag or enclosing the button in a form)
			/*var form = $(document.createElement('form'));
			form.attr('action', 'application/views/php/exportToExcel.php');
			form.attr('method', 'GET');
			form.attr('id', 'formExcel');
			form.appendTo(document.body);
			form.submit();
			form.remove();*/
			$('#formbtnExcel').submit();
			$("body").css('cursor', 'wait');
			$("#formbtnExcel").css('cursor', 'not-allowed');
			$("#btnExcel").prop('disabled', true);
			document.getElementById("btnExcel").value = 1;
			setTimeout(
				function() {
					$("body").css('cursor', 'auto');
					$("#formbtnExcel").css('cursor', 'pointer');
					$("#btnExcel").removeAttr('disabled');
					document.getElementById("btnExcel").value = 0;
				},
			60000); // Adapt waiting time (PHPExcel library takes from 50 to 70 seconds to create a xls file)
		});
	});

	$(document).ready(function() {
		$("#btnMysql").click(function() {
			$("body").css('cursor', 'wait');
			$("#formbtnMysql").css('cursor', 'not-allowed');
			$("#btnMysql").prop('disabled', true);

			$.ajax({
				type: "POST",
				url: "application/views/php/exportToMysql.php",
				success: function(result) {
					//alert(result);
					$("#myModalMysqlSuccess").modal("show");
					var flag = document.getElementById("btnExcel").value;
					if(flag == 0) { // Keep waiting cursor in case PHPExcel library is working background
						$("body").css('cursor', 'auto');
					}
					$("#formbtnMysql").css('cursor', 'pointer');
					$("#btnMysql").removeAttr('disabled');
				}
			});
		});
	});
</script>

<div class="modal fade" id="myModalMysqlSuccess" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header" style="background-color: #eee;" align="center">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">
					<img src="images/mysql-Success.png" id="logo-alertaModal" style="height: 80px; width: 80px;">
				</h4>
				<h3 align="center" class="text-secondary">Almacén de datos creado con éxito</h3>
			</div> <!-- modal-header -->

			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<div class="col-sm-1">
						</div>
						<center>
							<div class="col-sm-10">
								<strong class="text-info">
								El proceso ETL ha terminado<br>No olvides cerrar sesión
								</strong>
							</div>
						</center>
						<div class="col-sm-1">
						</div>
					</div>
				</form>
			</div> <!-- modal-body -->
		</div> <!-- modal-content -->
	</div> <!-- modal-dialog -->
</div> <!-- modal fade -->

</body>
</html>