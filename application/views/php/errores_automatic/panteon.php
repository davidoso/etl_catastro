<?php
    try {
	    $serverName = "CHELSEA\SQLSERVER2016";
	    $database = "CATASTRO_DATA_SOURCE";

        // Get UID and PWD from application-specific files
		$uid = "catastro";
		$pwd = "catastro";

        // Count number of tuples that will solve automatically in a view
        $conn = new PDO("sqlsrv:server=$serverName; Database=$database", $uid, $pwd);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT COUNT('NUM') FROM $view
            WHERE capacidad < 0 OR capacidad > 20 OR capacidad IS NULL OR material IS NULL OR condición = 'BUENAS' OR condición = 'MALAS' OR condición IS NULL";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }

        $count = $conn->query($query)->fetchColumn();

        // Adapt HTML code. fetchColumn() will return 0 if there are no rows
        if($count == 0) {
            print
                '<div class="col-sm-12" id="div-panel" style="background: #DFFFD6">
                    <h4 align="center" class="text-success"><b>NO EXISTEN ERRORES QUE SE PUEDAN CORREGIR AUTOMÁTICAMENTE</b></h4>
                </div>';
        } // if
        else {
            if($count == 1) {
                print
                    '<div class="col-sm-12" id="div-panel" style="background: #FFD6DD">
                        <h4 align="center" class="text-danger"><b>EXISTE 1 REGISTRO QUE SE VA A CORREGIR AUTOMÁTICAMENTE</b></h4>
                    </div>';
            }
            else {
                print
                    '<div class="col-sm-12" id="div-panel" style="background: #FFD6DD">
                        <h4 align="center" class="text-danger"><b>EXISTEN ' . $count . ' REGISTROS QUE SE VAN A CORREGIR AUTOMÁTICAMENTE</b></h4>
                    </div>';
            }
        } // else
    } // try
    catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    } // catch
    // Free statement and connection resources
    $count = null;
    $stmt = null;
    $conn = null;

?>