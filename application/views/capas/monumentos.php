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
				{ name: "genero_arquitectonico", datatype: "string", editable: true,
					values: {"CAMPOSANTO": "CAMPOSANTO", "COMERCIO": "COMERCIO", "CONVENTO": "CONVENTO", "ESTACIÓN FERROVIARIA": "ESTACIÓN FERROVIARIA", "FÁBRICA": "FÁBRICA", "FUENTE": "FUENTE", "HABITACIÓN": "HABITACIÓN", "HABITACIÓN/COMERCIO": "HABITACIÓN/COMERCIO", "JARDÍN HISTÓRICO": "JARDÍN HISTÓRICO", "JARDÍN Y MONUMENTO": "JARDÍN Y MONUMENTO", "KIOSCO": "KIOSCO", "MERCADO": "MERCADO", "MUSEO/COMERCIO": "MUSEO/COMERCIO", "PANTEÓN": "PANTEÓN", "PUENTE": "PUENTE", "TEMPLO": "TEMPLO" } },
				{ name: "epoca", datatype: "string", editable: true, values: {"S. XVI-XIX": "S. XVI-XIX", "S. XVII-XIX": "S. XVII-XIX", "S. XVIII-XIX": "S. XVIII-XIX", "S. XVIII-XX": "S. XVIII-XX", "S. XIX": "S. XIX", "S. XIX-XX": "S. XIX-XX", "S. XX": "S. XX" } },
			]});

			// Then we attach to the HTML table and render it
			grid.attachToHTMLTable("htmlgrid");
			grid.renderGrid();

			// 16/24 genres, 8 missing:
            // CAMPO DEP., CARGA, CULTO, CULTURA, OFICINAS, OFICINAS/HABITACIÓN, P. DE GOBIERNO, PUENTE FERROV.
            grid.addCellValidator("genero_arquitectonico", new CellValidator({
				isValid: function(value) { return value == "CAMPOSANTO" || value == "COMERCIO"
                    || value == "CONVENTO" || value == "ESTACIÓN FERROVIARIA" || value == "FÁBRICA"
                    || value == "FUENTE" || value == "HABITACIÓN" || value == "HABITACIÓN/COMERCIO"
                    || value == "JARDÍN HISTÓRICO" || value == "JARDÍN Y MONUMENTO"
                    || value == "KIOSCO" || value == "MERCADO" || value == "MUSEO/COMERCIO"
                    || value == "PANTEÓN" || value == "PUENTE" || value == "TEMPLO"; }
				}));

			grid.addCellValidator("epoca", new CellValidator({
				isValid: function(value) { return value == "S. XVI-XIX" || value == "S. XVII-XIX"
                	|| value == "S. XVIII-XIX" || value == "S. XVIII-XX"
                    || value == "S. XIX" || value == "S. XIX-XX" || value == "S. XX"; }
				}));
		}
	</script>
</head>
	<?php
		$tableData = '{
				"id" : $(tr).find("td:eq(0)").text(),
				"genero_arquitectonico" : $(tr).find("td:eq(2)").text(),
				"epoca" : $(tr).find("td:eq(3)").text()
		};';
    	$data = array(
        	'view' => "dbo.inah\$monumentos_historicos",
			'accordionTitle' => "Monumentos Históricos",
			'tableData' => $tableData,
			'processJSONarray' => "application/views/php/processJSONarray/monumentos.php"
		); $this->load->view('template_body', $data);
	?>
</html>