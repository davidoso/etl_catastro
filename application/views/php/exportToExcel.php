<?php
	require 'PHPExcel/Classes/PHPExcel.php';

	try {
		$serverName = "CHELSEA\SQLSERVER2016";
		$database = "CATASTRO_DATA_SOURCE";

		// Get UID and PWD from application-specific files
		$uid = "catastro";
		$pwd = "catastro";

		$conn = new PDO("sqlsrv:server=$serverName; Database=$database", $uid, $pwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle("Catastro Data Warehouse")->setCreator("H. Ayuntamiento de Colima")->setDescription("ETL Catastro Dinámico");

		$dataStyle = new PHPExcel_Style();
		$dataStyle->applyFromArray( array(
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN)),
		'alignment' =>  array(
		'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER)));

		$successStyle = array(
			'fill' => array(
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array('rgb' => '9BBB59')));

		$headerStyle = array(
			'fill' => array(
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array('rgb' => 'B7DEE8')));

		$query = "SELECT * FROM dbo.ct_material ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$objPHPExcel->getActiveSheet()->setTitle("ct_material");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id_material');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'material');
		$excelRow = 2;
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id_material']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['material']);
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:B".$excelRow);
		$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM dbo.ct_cond_fisica WHERE id_cond_fisica != 6 AND id_cond_fisica != 7 ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$objPHPExcel->getActiveSheet()->setTitle("ct_cond_fisica");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id_cond_fisica');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'cond_fisica');
		$excelRow = 2;
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id_cond_fisica']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['cond_fisica']);
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:B".$excelRow);
		$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM dbo.tbl_log_user_login ORDER BY 2";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(2);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$objPHPExcel->getActiveSheet()->setTitle("bitacora_login");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'username');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'date_and_time');
		$excelRow = 2;
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['username']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['date_and_time']);
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:B".$excelRow);
		$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($headerStyle);

		$query = "SELECT * FROM dbo.tbl_log_updates ORDER BY 3";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(3);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(55);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		$objPHPExcel->getActiveSheet()->setTitle("bitacora_cambios");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'username');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'changed_table');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'date_and_time');
		$excelRow = 2;
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['username']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['changed_table']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['date_and_time']);
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:C".$excelRow);
		$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($headerStyle);

		$query = "SELECT * FROM [auxdw].[generales.tbl_bancos] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(4);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("generales.tbl_bancos");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'coord_x');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'coord_y');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'nombre');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'tipo');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['coord_x']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['coord_y']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['nombre']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['tipo']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:F$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:F".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM [auxdw].[generales.tbl_hoteles] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("generales.tbl_hoteles");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'coord_x');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'coord_y');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'nombre');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['coord_x']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['coord_y']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['nombre']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:E$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:E".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM [auxdw].[generales.tbl_postes] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(6);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("generales.tbl_postes");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'coord_x');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'coord_y');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'empresa_responsable');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'id_material');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'id_cond_fisica');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['coord_x']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['coord_y']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['empresa_responsable']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['id_material']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $excelRow, $row['id_cond_fisica']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:G$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:G".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM [auxdw].[generales.tbl_telefonos_publicos] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(7);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("generales.tbl_telefonos");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'coord_x');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'coord_y');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'empresa_responsable');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'tipo');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'funciona');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'id_cond_fisica');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['coord_x']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['coord_y']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['empresa_responsable']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['tipo']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $excelRow, $row['funciona']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $excelRow, $row['id_cond_fisica']);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:H$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:H".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM [auxdw].[inah.tbl_monumentos_historicos] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("inah.tbl_monumentos");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'coord_x');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'coord_y');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'genero_arquitectonico');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'epoca');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['coord_x']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['coord_y']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['genero_arquitectonico']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['epoca']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:F$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:F".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM [auxdw].[registro_civil.tbl_panteon_municipal] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(9);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("registro_civil.tbl_panteon");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'coord_x');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'coord_y');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'capacidad');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'id_material');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'id_cond_fisica');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['coord_x']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['coord_y']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['capacidad']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['id_material']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $excelRow, $row['id_cond_fisica']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:G$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:G".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM [auxdw].[servicios_publicos.tbl_luminarias] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("servicios_pub.tbl_luminarias");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'coord_x');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'coord_y');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'f_secundaria');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'id_material');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'id_cond_fisica');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['coord_x']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['coord_y']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['f_secundaria']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['id_material']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $excelRow, $row['id_cond_fisica']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:G$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:G".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM [auxdw].[comercio.tbl_mercados] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(11);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("comercio.tbl_mercados");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'coord_x');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'coord_y');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'nombre');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['coord_x']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['coord_y']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['nombre']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:E$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:E".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM [auxdw].[comercio.tbl_locatarios_mercados] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(60);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("comercio.tbl_locatarios");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'coord_x');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'coord_y');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'id_mercado');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'giro');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['coord_x']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['coord_y']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['id_mercado']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['giro']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:F$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:F".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM [auxdw].[comercio.tbl_tianguis] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(13);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("comercio.tbl_tianguis");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'coord_x');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'coord_y');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'nombre');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'dia');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'horario');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'area');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['coord_x']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['coord_y']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['nombre']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['dia']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $excelRow, $row['horario']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $excelRow, $row['area']);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:H$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:H".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM [auxdw].[comercio.tbl_tianguistas] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(14);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(60);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("comercio.tbl_tianguistas");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'coord_x');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'coord_y');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'id_tianguis');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'giro');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'metros');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['coord_x']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['coord_y']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['id_tianguis']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['giro']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $excelRow, $row['metros']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:G$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:G".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM [auxdw].[comercio.tbl_plazas_comerciales] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("comercio.tbl_plazas");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'coord_x');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'coord_y');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'nombre');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['coord_x']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['coord_y']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['nombre']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:E$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:E".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$query = "SELECT * FROM [auxdw].[comercio.tbl_giros_comerciales_licencias] ORDER BY 1";
		$result = $conn->query($query);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(16);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(80);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(80);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setTitle("comercio.giros_comerciales");
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'id_giro_comercial');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'giro');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'nombre_comercial');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'modified');
		$excelRow = 2;
		$modifiedCells = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $row['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $row['id_giro_comercial']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $row['giro']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $row['nombre_comercial']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $row['modified']);
			if($row['modified'] != "") {
				array_push($modifiedCells, "A$excelRow:E$excelRow");
			}
			$excelRow++;
		}
		$excelRow--;
		$objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A2:E".$excelRow);
		foreach ($modifiedCells as $cell) {
			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($successStyle);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($headerStyle);
		$objPHPExcel->getActiveSheet()->getStyle("A1:A".$excelRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


		ob_end_clean();
		//header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename='Catastro Data Warehouse.xlsx'");
		header("Cache-Control: max-age=0");

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	} // try
	catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	} // catch
	// Free query result and connection resources
	$result = null;
	$conn = null;

?>