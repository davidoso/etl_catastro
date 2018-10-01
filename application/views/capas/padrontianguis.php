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
				{ name: "tianguis", datatype: "string", editable: false },
                { name: "giro", datatype: "string", editable: true }
			]});

			// Then we attach to the HTML table and render it
			grid.attachToHTMLTable("htmlgrid");
			grid.renderGrid();

			grid.addCellValidator("tianguis", new CellValidator({
				isValid: function(value) { return value != ""; }
				}));

			grid.addCellValidator("giro", new CellValidator({
			isValid: function(value) { return value != ""; }
			}));
		}
	</script>
</head>
	<?php
		$tableData = '{
				"id" : $(tr).find("td:eq(0)").text(),
				"giro" : $(tr).find("td:eq(2)").text()
		};';
    	$data = array(
        	'view' => "dbo.comercio\$tianguistas",
			'accordionTitle' => "Tianguistas",
			'tableData' => $tableData,
			'processJSONarray' => "application/views/php/processJSONarray/padrontianguis.php"
		); $this->load->view('template_body', $data);
    ?>
</html>