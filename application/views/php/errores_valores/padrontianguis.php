<?php $this->load->view('template_errors_help'); ?>

<div class="col-sm-12">
	<div class="form-group col-sm-3">
	</div>
	<div class="form-group col-sm-7">
		<label><span style="color: red;"><b>*</b></span> El campo <i id="lblField">GIRO DEL PUESTO</i> no debe estar vacío.</label>
		<label><span style="color: red;"><b>*</b></span> El campo <i id="lblField">GIRO DEL PUESTO</i> debe tener sólo letras en el rango: [A-Z].&nbsp;&nbsp;
			<i style="color: #E0218A;" title='CARACTERES INVÁLIDOS: [0-9] ¿ ? ! ¡ " @ # $ % / \ _ = + < > { } ( ) * ; : | ° ¬ ´ ~ ' class="fa fa-question-circle" aria-hidden="true"></i>
		</label>
		<label><span style="color: red;"><b>*</b></span> El campo <i id="lblField">GIRO DEL PUESTO</i> requiere una de estas opciones válidas:</label>
		<select class="form-control" style="width: 85%;">
			<option>< Seleccionar y editar manualmente en la tabla ></option>
			<?php
            	foreach($tianguistas as $value) {
              		echo '<option value="' . $value->giro . '">' . $value->giro . '</option>';
            	}
            ?>
		</select>
	</div>
	<div class="form-group col-sm-2">
	</div>
</div>