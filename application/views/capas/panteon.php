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
				{ name: "capacidad", datatype: "integer", editable: true },
				{ name: "material", datatype: "string", editable: true, values: {"AZULEJO": "AZULEJO", "CEMENTO": "CEMENTO", "FIERRO": "FIERRO", "GRANITO": "GRANITO", "LADRILLO": "LADRILLO", "MÁRMOL": "MÁRMOL", "MARMOLINA": "MARMOLINA", "PIEDRA": "PIEDRA", "TIERRA": "TIERRA" } },
				{ name: "cond_fisica", datatype: "string", editable: true, values: {"BUENA": "BUENA", "REGULAR": "REGULAR", "MALA": "MALA", "DESCONOCIDA": "DESCONOCIDA", "NO FUNCIONA": "NO FUNCIONA", "EN RUINAS": "EN RUINAS" } }
			]});

			// Then we attach to the HTML table and render it
			grid.attachToHTMLTable("htmlgrid");
			grid.renderGrid();

			grid.addCellValidator("capacidad", new CellValidator({
				isValid: function(value) { return (parseInt(value) >= 0 && parseInt(value) < 21); }
				}));

			grid.addCellValidator("material", new CellValidator({
				isValid: function(value) { return value == "AZULEJO" || value == "CEMENTO" || value == "FIERRO"
					|| value == "GRANITO" || value == "LADRILLO" || value == "MÁRMOL"
                    || value == "MARMOLINA" || value == "PIEDRA" || value == "TIERRA"; }
				}));

			grid.addCellValidator("cond_fisica", new CellValidator({
				isValid: function(value) { return value == "BUENA" || value == "REGULAR" || value == "MALA"
					|| value == "DESCONOCIDA" || value == "NO FUNCIONA" || value == "EN RUINAS"; }
				}));
		}
	</script>
</head>
	<?php
		$tableData = '{
				"id" : $(tr).find("td:eq(0)").text(),
				"capacidad" : $(tr).find("td:eq(2)").text(),
				"material" : $(tr).find("td:eq(3)").text(),
				"cond_fisica" : $(tr).find("td:eq(4)").text()
		};';
    	$data = array(
        	'view' => "dbo.registro_civil\$panteon_municipal",
			'accordionTitle' => "Panteón Municipal",
			'tableData' => $tableData,
			'processJSONarray' => "application/views/php/processJSONarray/panteon.php"
		); $this->load->view('template_body', $data);
	?>
</html>