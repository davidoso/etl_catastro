<?php
    try {
	    $serverName = "CHELSEA\SQLSERVER2016";
	    $database = "CATASTRO_DATA_SOURCE";

        // Get UID and PWD from application-specific files
		$uid = "catastro";
		$pwd = "catastro";

        // Count number of 'wrong' tuples in a view
        $conn = new PDO("sqlsrv:server=$serverName; Database=$database", $uid, $pwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "SELECT * FROM $view ORDER BY 1";

		// First query just gets the column names
		print "<table id='htmlgrid' class='testgrid' align='center' style='margin-bottom: 35px; margin-top: 20px;'>";
		$result = $conn->query($query);

		// Return only the first row (we only need field names)
		$row = $result->fetch(PDO::FETCH_ASSOC);
		print "<tr>";
		$i = 1;
		foreach($row as $header => $value) {
			print "<th id='th$i'>$header</th>";
			$i++;
		} // foreach

		$trash = "\u{1F6AE}"; // Unicode trash icon: http://graphemica.com/characters/tags/trash
		print "<th id='thelim' ondblclick='javascript:toggleCheckboxes()' value='0' title='Doble click para eliminar'> " . $trash . "</th>";
		print "</tr>";

		// Second query gets the data
		$data = $conn->query($query);
		$data->setFetchMode(PDO::FETCH_ASSOC);
		$i = 1;
		foreach($data as $row) {
			print "<tr id='tr$i'>";
			foreach($row as $field => $value) {
				print "<td>$value</td>";
			} // end field loop

			// Trash (delete) field
			$idTrash = $row['NUM'];
			print "<td id='tdelim'><input type='checkbox' name='chk' id='chk' value='$idTrash'></td>";
			print "</tr>";
			$i++;
		} // end record loop
		print "</table>";
		print
			"<script>
				function toggleCheckboxes() {
					var flag = document.getElementById('thelim').value;
					var checkboxes = document.querySelectorAll('input[type=checkbox]');
					var checkedValue;
					if(flag == 0) {
						checkedValue = true;
						document.getElementById('thelim').value = 1;
					}
					else {
						checkedValue = false;
						document.getElementById('thelim').value = 0;
					}
					for(var i = 0; i < checkboxes.length; i++) {
						checkboxes[i].checked = checkedValue;
					}
				}
			</script>";
    } // try
    catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    } // catch
    // Free statement and connection resources
    $result = null;
    $data = null;
    $conn = null;

?>