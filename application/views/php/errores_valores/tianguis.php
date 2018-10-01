<?php $this->load->view('template_errors_help'); ?>

<div class="col-sm-12">
	<div class="form-group col-sm-3">
	</div>
	<div class="form-group col-sm-6">
		<label><span style="color: red;"><b>*</b></span> El campo <i id="lblField">TIANGUIS</i> no debe estar vacío.</label>
		<label><span style="color: red;"><b>*</b></span> El campo <i id="lblField">TIANGUIS</i> debe tener sólo letras en el rango: [A-Z].&nbsp;&nbsp;
			<i style="color: #E0218A;" title='CARACTERES INVÁLIDOS: [0-9] ¿ ? ! ¡ " @ # $ % / \ _ = + < > { } ( ) * ; : | ° ¬ ´ ~ . , ' class="fa fa-question-circle" aria-hidden="true"></i>
		</label>
	</div>
	<div class="form-group col-sm-3">
	</div>
</div>

<div class="col-sm-12">
	<div class="form-group col-sm-3">
	</div>
	<div class="form-group col-sm-6">
		<label><span style="color: red;"><b>*</b></span> El campo <i id="lblField">DÍA</i> requiere una de estas opciones válidas:</label>
		<select class="form-control">
			<option>< Seleccionar y editar manualmente en la tabla ></option>
			<option>LUNES</option>
			<option>MARTES</option>
			<option>MIÉRCOLES</option>
			<option>JUEVES</option>
			<option>VIERNES</option>
			<option>SÁBADO</option>
			<option>DOMINGO</option>
		</select>
	</div>
	<div class="form-group col-sm-3">
	</div>
</div>