<!DOCTYPE html>
<html lang="es-MX">
<head>
	<?php $this->load->view('template_head'); ?>
	<?php $this->load->view('template_editablegrid'); ?>

	<script>
		window.onload = function() {
			grid = new EditableGrid("grid", { sortIconUp: "images/up.png", sortIconDown: "images/down.png"});

			// We build and load the metadata in Javascript
			grid.load({ metadata: [
				{ name: "id", datatype: "integer", editable: false },
				{ name: "coordenadas", datatype: "string", editable: false },
				{ name: "empresa_responsable", datatype: "string", editable: true, values: {"CON MIGO": "CON MIGO", "TELMEX": "TELMEX" } },
				{ name: "funciona", datatype: "string", editable: true, values: {"SI": "SI", "NO": "NO" } },
				{ name: "tipo", datatype: "string", editable: true, values: {"TARJETA": "TARJETA", "MONEDA": "MONEDA" } },
				{ name: "cond_fisica", datatype: "string", editable: true, values: {"BUENA": "BUENA", "REGULAR": "REGULAR", "MALA": "MALA", "DESCONOCIDA": "DESCONOCIDA", "NO FUNCIONA": "NO FUNCIONA" } }
			]});

			// Then we attach to the HTML table and render it
			grid.attachToHTMLTable("htmlgrid");
			grid.renderGrid();

			grid.addCellValidator("empresa_responsable", new CellValidator({
				isValid: function(value) { return value == "CON MIGO" || value == "TELMEX"; }
				}));

			grid.addCellValidator("funciona", new CellValidator({
				isValid: function(value) { return value == "SI" || value == "NO"; }
				}));

			grid.addCellValidator("tipo", new CellValidator({
				isValid: function(value) { return value == "TARJETA" || value == "MONEDA"; }
				}));

			grid.addCellValidator("cond_fisica", new CellValidator({
				isValid: function(value) { return value == "BUENA" || value == "REGULAR" || value == "MALA"
					|| value == "DESCONOCIDA" || value == "NO FUNCIONA"; }
				}));
		}
	</script>
</head>
	<?php
		$tableData = '{
				"id" : $(tr).find("td:eq(0)").text(),
				"empresa_responsable" : $(tr).find("td:eq(2)").text(),
				"funciona" : $(tr).find("td:eq(3)").text(),
				"tipo" : $(tr).find("td:eq(4)").text(),
				"cond_fisica" : $(tr).find("td:eq(5)").text()
		};';
    	$data = array(
        	'view' => "dbo.generales\$telefonos_publicos",
			'accordionTitle' => "Teléfonos Públicos",
			'tableData' => $tableData,
			'processJSONarray' => "application/views/php/processJSONarray/telefonos.php"
		); $this->load->view('template_body', $data);
    ?>
</html>