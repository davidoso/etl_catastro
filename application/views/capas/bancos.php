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
				{ name: "tipo", datatype: "string", editable: true, values: {"BANCO": "BANCO", "CAJERO AUTOMÁTICO": "CAJERO AUTOMÁTICO" } }
			]});

			// Then we attach to the HTML table and render it
			grid.attachToHTMLTable("htmlgrid");
			grid.renderGrid();

			grid.addCellValidator("nombre", new CellValidator({
				isValid: function(value) { return value != ""; }
				}));

			grid.addCellValidator("tipo", new CellValidator({
				isValid: function(value) { return value == "BANCO" || value == "CAJERO AUTOMÁTICO"; }
				}));
		}
	</script>
</head>
	<?php
		$tableData = '{
				"id" : $(tr).find("td:eq(0)").text(),
				"nombre" : $(tr).find("td:eq(2)").text(),
				"tipo" : $(tr).find("td:eq(3)").text()
		};';
    	$data = array(
        	'view' => "dbo.generales\$bancos",
			'accordionTitle' => "Bancos",
			'tableData' => $tableData,
			'processJSONarray' => "application/views/php/processJSONarray/bancos.php"
		); $this->load->view('template_body', $data);
    ?>
</html>