<?php
	// Unescape the string values in the JSON arrays
	$tableData = stripcslashes($_POST['pTableData']);
	$trashArray = stripcslashes($_POST['pTrashArray']);
	$username = stripcslashes($_POST['username']);

	// Decode the JSON arrays
	$tableData = json_decode($tableData, TRUE);
	$trashArray = json_decode($trashArray, TRUE);
	$username = json_decode($username, TRUE);

    try {
	    $serverName = "CHELSEA\SQLSERVER2016";
	    $database = "CATASTRO_DATA_SOURCE";

        // Get UID and PWD from application-specific files
		$uid = "catastro";
		$pwd = "catastro";

        $conn = new PDO("sqlsrv:server=$serverName; Database=$database", $uid, $pwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Query 1/3: Update selected records and 'try to fix' errors
		$query =
			"UPDATE [auxdw].[comercio.tbl_plazas_comerciales]
				SET nombre = :nombre,
					modified = 'M'
		        WHERE id = :id";
		$stmt = $conn->prepare($query);
		for($i = 0; $i < count($tableData); $i++) {
			$stmt->bindParam(':nombre', $tableData[$i]['nombre'], PDO::PARAM_STR);
			$stmt->bindParam(':id', $tableData[$i]['id'], PDO::PARAM_INT);
			$stmt->execute();
		} // for

		// Query 2/3: Solve automatic errors
		$query =
			"DELETE FROM [auxdw].[comercio.tbl_plazas_comerciales]
				WHERE nombre IS NULL OR nombre = ''";
		$stmt = $conn->prepare($query);
		$stmt->execute();

		// Query 3/3: Delete selected records
		$view = "dbo.comercio\$plazas_comerciales";
		$query =
			"DELETE FROM [auxdw].[comercio.tbl_plazas_comerciales]
				WHERE id = :id";
		$stmt = $conn->prepare($query);
		for($i = 0; $i < count($trashArray); $i++) {
			$num = $trashArray[$i];
			$auxquery = "SELECT * FROM $view WHERE NUM = $num";
			$auxstmt = $conn->query($auxquery);
			$row = $auxstmt->fetch(PDO::FETCH_ASSOC);
			if(!empty($row)) {
				$stmt->bindParam(':id', $trashArray[$i], PDO::PARAM_INT);
				$stmt->execute();
			}
		} // for

		// Save username, changed table and date in dbo.tbl_log_updates
		$query =
			"INSERT INTO [dbo].[tbl_log_updates](username, changed_table)
				VALUES (:username, '[auxdw].[comercio.tbl_plazas_comerciales]')";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
	} // try
    catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    } // catch
	// Free statement and connection resources
	$stmt = null;
	$conn = null;

?>