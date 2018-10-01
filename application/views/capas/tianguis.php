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
				{ name: "nombre", datatype: "string", editable: true },
				{ name: "dia", datatype: "string", editable: true, values: {"LUNES": "LUNES", "MARTES": "MARTES", "MIÉRCOLES": "MIÉRCOLES", "JUEVES": "JUEVES", "VIERNES": "VIERNES", "SÁBADO": "SÁBADO", "DOMINGO": "DOMINGO" } }
			]});

			// Then we attach to the HTML table and render it
			grid.attachToHTMLTable("htmlgrid");
			grid.renderGrid();

			grid.addCellValidator("nombre", new CellValidator({
				isValid: function(value) { return value != ""; }
				}));
		}
	</script>
</head>
	<?php
		$tableData = '{
				"id" : $(tr).find("td:eq(0)").text(),
				"nombre" : $(tr).find("td:eq(2)").text(),
				"dia" : $(tr).find("td:eq(3)").text()
		};';
    	$data = array(
        	'view' => "dbo.comercio\$tianguis",
			'accordionTitle' => "Tianguis",
			'tableData' => $tableData,
			'processJSONarray' => "application/views/php/processJSONarray/tianguis.php"
		); $this->load->view('template_body', $data);
    ?>
</html>