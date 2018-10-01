<?php
	try {
		$serverName = "CHELSEA\SQLSERVER2016";
		$database = "CATASTRO_DATA_SOURCE";

    	// Get UID and PWD from application-specific files
    	$uid = "catastro";
    	$pwd = "catastro";

		// Execute SP to connect to a MySQL linked server from SQL Server and copy Data Warehouse tables
		$conn = new PDO("sqlsrv:server=$serverName; Database=$database");
		$query = "EXEC usp_load_mysql_dw";
		$stmt = $conn->prepare($query);
		try {
			$stmt->execute();
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	} // try
	catch(PDOException $e) {
    	echo 'ERROR: ' . $e->getMessage();
	} // catch
    // Free statement and connection resources
	$stmt = null;
    $conn = null;

?>