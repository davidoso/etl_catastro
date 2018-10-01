<!DOCTYPE html>
<html lang="es-MX">
<head>
	<?php $this->load->view('template_head'); ?>
</head>
<body>
	<?php $this->load->view('template_header'); ?>

	<div id="navbar-main" style="margin-bottom: 213px;">
	    <div class="container">
	    	<div class="row">
				<div class="col-lg-8" align="justify">
					<?php $this->load->view('sql_etlhome'); ?>
				</div>

				<div class="col-lg-1" align="left" style="padding-top: 190px;">
				</div>

				<div class="col-lg-3" align="left" style="padding-top: 190px;">
					<form id="formbtnContinue" action="index.php/Etl/etlload/" method="post" name="continueETL">
						<button id="btnContinue" type="submit" title="CONTINUAR ETL" class="btn btn-primary btn-block">CONTINUAR ETL&nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- navbar-main -->

<?php $this->load->view('template_footer'); ?>
</body>
</html>