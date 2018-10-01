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
			"UPDATE [auxdw].[generales.tbl_telefonos_publicos]
				SET empresa_responsable = :empresa_responsable,
					modified = 'M',
                	tipo = :tipo,
                    funciona = :funciona,
					id_cond_fisica =
						(SELECT id_cond_fisica FROM [dbo].[ct_cond_fisica] WHERE cond_fisica = :cond_fisica)
				WHERE id = :id";
		$stmt = $conn->prepare($query);
		for($i = 0; $i < count($tableData); $i++) {
			$stmt->bindParam(':empresa_responsable', $tableData[$i]['empresa_responsable'], PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $tableData[$i]['tipo'], PDO::PARAM_STR);
            $stmt->bindParam(':funciona', $tableData[$i]['funciona'], PDO::PARAM_STR);
			$stmt->bindParam(':cond_fisica', $tableData[$i]['cond_fisica'], PDO::PARAM_STR);
			$tableData[$i]['id'] = str_replace(".", "", $tableData[$i]['id']);
			$stmt->bindParam(':id', $tableData[$i]['id'], PDO::PARAM_INT);
			$stmt->execute();
		} // for

		// Query 2.1/3: Solve automatic errors
		$query =
			"UPDATE [auxdw].[generales.tbl_telefonos_publicos]
				SET funciona = 'SI',
					modified = 'A'
				WHERE funciona IS NULL OR funciona = ''"; // NULL A SI (FUNCIONA)
		$stmt = $conn->prepare($query);
		$stmt->execute();

		// Query 2.2/3: Solve automatic errors
		$query =
			"UPDATE [auxdw].[generales.tbl_telefonos_publicos]
				SET id_cond_fisica = 1,
					modified = 'A'
				WHERE id_cond_fisica = 6"; // BUENAS A BUENA
		$stmt = $conn->prepare($query);
		$stmt->execute();

		// Query 2.3/3: Solve automatic errors
		$query =
			"UPDATE [auxdw].[generales.tbl_telefonos_publicos]
				SET id_cond_fisica = 3,
					modified = 'A'
				WHERE id_cond_fisica = 7"; // MALAS A MALA
		$stmt = $conn->prepare($query);
		$stmt->execute();

		// Query 2.4/3: Solve automatic errors
		$query =
			"UPDATE [auxdw].[generales.tbl_telefonos_publicos]
				SET id_cond_fisica = 4,
					modified = 'A'
				WHERE id_cond_fisica IS NULL"; // NULL A DESCONOCIDA
		$stmt = $conn->prepare($query);
		$stmt->execute();

		// Query 3/3: Delete selected records
		$view = "dbo.generales\$telefonos_publicos";
		$query =
			"DELETE FROM [auxdw].[generales.tbl_telefonos_publicos]
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
				VALUES (:username, '[auxdw].[generales.tbl_telefonos_publicos]')";
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