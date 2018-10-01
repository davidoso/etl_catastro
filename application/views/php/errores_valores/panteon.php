<?php $this->load->view('template_errors_help'); ?>

<div class="col-sm-12">
	<div class="form-group col-sm-3">
	</div>
	<div class="form-group col-sm-6">
		<label><span style="color: red;"><b>*</b></span> Los campos <i id="lblField">CAPACIDAD</i>, <i id="lblField">MATERIAL</i> y <i id="lblField">CONDICIÓN</i> no deben estar vacíos.</label>
	</div>
	<div class="form-group col-sm-3">
	</div>
</div>

<div class="col-sm-12">
	<div class="form-group col-sm-3">
	</div>
	<div class="form-group col-sm-6">
	<label><span style="color: red;"><b>*</b></span> El campo <i id="lblField">CAPACIDAD</i> debe estar en el rango: <strong title="Mayor o igual a 0">≥0</strong> y <strong title="Menor o igual a 20">≤20.</strong></label>
	</div>
	<div class="form-group col-sm-3">
	</div>
</div>

<div class="col-sm-12">
	<div class="form-group col-sm-3">
	</div>
	<div class="form-group col-sm-6">
		<label><span style="color: red;"><b>*</b></span> El campo <i id="lblField">MATERIAL</i> requiere una de estas opciones válidas:</label>
		<select class="form-control">
			<option>< Seleccionar y editar manualmente en la tabla ></option>
			<option>AZULEJO</option>
			<option>CEMENTO</option>
            <option>FIERRO</option>
            <option>GRANITO</option>
            <option>LADRILLO</option>
            <option>MÁRMOL</option>
            <option>MARMOLINA</option>
            <option>PIEDRA</option>
            <option>TIERRA</option>
		</select>
	</div>
	<div class="form-group col-sm-3">
	</div>
</div>

<div class="col-sm-12">
	<div class="form-group col-sm-3">
	</div>
	<div class="form-group col-sm-6">
		<label><span style="color: red;"><b>*</b></span> El campo <i id="lblField">CONDICIÓN</i> requiere una de estas opciones válidas:</label>
		<select class="form-control">
			<option>< Seleccionar y editar manualmente en la tabla ></option>
			<option>BUENA</option>
			<option>REGULAR</option>
            <option>MALA</option>
            <option>DESCONOCIDA</option>
            <option>NO FUNCIONA</option>
            <option>EN RUINAS</option>
		</select>
	</div>
	<div class="form-group col-sm-3">
	</div>
</div>