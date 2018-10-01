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
				{ name: "empresa_responsable", datatype: "string", editable: true, values: {"C.F.E.": "C.F.E.", "TELMEX": "TELMEX" } },
				{ name: "material", datatype: "string", editable: true, values: {"CONCRETO": "CONCRETO", "MADERA": "MADERA", "METAL": "METAL", "ACERO": "ACERO" } },
				{ name: "cond_fisica", datatype: "string", editable: true, values: {"BUENA": "BUENA", "REGULAR": "REGULAR", "MALA": "MALA", "DESCONOCIDA": "DESCONOCIDA", "NO FUNCIONA": "NO FUNCIONA" } }
			]});

			// Then we attach to the HTML table and render it
			grid.attachToHTMLTable("htmlgrid");
			grid.renderGrid();

			grid.addCellValidator("empresa_responsable", new CellValidator({
				isValid: function(value) { return value == "C.F.E." || value == "TELMEX"; }
				}));

			grid.addCellValidator("material", new CellValidator({
				isValid: function(value) { return value == "CONCRETO" || value == "MADERA" || value == "METAL"
					|| value == "ACERO"; }
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
				"material" : $(tr).find("td:eq(3)").text(),
				"cond_fisica" : $(tr).find("td:eq(4)").text()
		};';
    	$data = array(
        	'view' => "dbo.generales\$postes",
			'accordionTitle' => "Postes C.F.E. y Telmex",
			'tableData' => $tableData,
			'processJSONarray' => "application/views/php/processJSONarray/postes.php"
		); $this->load->view('template_body', $data);
	?>
</html>