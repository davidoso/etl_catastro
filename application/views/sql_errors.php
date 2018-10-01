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
        $query = "SELECT COUNT('NUM') FROM $view";
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
            print '<h4 align="center" class="text-info">¡QUÉ BIEN! NO HAY ERRORES EN ESTA CAPA</h4>';
            print '<hr><br>';
            print
                '<script>
                    window.onload = function() {
                        document.getElementById("footerwrap").setAttribute("style", "margin-top: 223px;");
                    }
                </script>';
        } // if
        else {
            if($count == 1) {
                print '<h4 align="center" class="text-warning"><b>SE HA ENCONTRADO 1 REGISTRO ERRÓNEO EN ESTA CAPA</b></h4>';
            }
            else {
                print '<h4 align="center" class="text-warning"><b>SE HAN ENCONTRADO ' . $count . ' REGISTROS ERRÓNEOS EN ESTA CAPA</b></h4>';
            }
            print '<hr>';
            print
                '<div class="col-sm-12" id="div-panel" style="background: #CCC;">
                    <h4 align="center" class="text-danger"><b>POSIBLES TIPOS DE ERRORES ENCONTRADOS</b></h4>
                </div>';
            switch($accordionTitle) {
                case 'Bancos':                  $this->load->view('php/errores_valores/bancos');            break;
                case 'Hoteles':                 $this->load->view('php/errores_valores/hoteles');           break;
                case 'Postes C.F.E. y Telmex':  $this->load->view('php/errores_valores/postes');            break;
                case 'Teléfonos Públicos':      $this->load->view('php/errores_valores/telefonos');         break;
                case 'Monumentos Históricos':   $this->load->view('php/errores_valores/monumentos');        break;
                case 'Locatarios Mercados':     $this->load->view('php/errores_valores/padronmercados');    break;
                case 'Mercados':                $this->load->view('php/errores_valores/mercados');          break;
                case 'Tianguistas':             $this->load->view('php/errores_valores/padrontianguis');    break;
                case 'Tianguis':                $this->load->view('php/errores_valores/tianguis');          break;
                case 'Plazas Comerciales':      $this->load->view('php/errores_valores/plazas');            break;
                case 'Licencias de Giros Comerciales':
                                                $this->load->view('php/errores_valores/giroscomerciales');  break;
                case 'Panteón Municipal':       $this->load->view('php/errores_valores/panteon');           break;
                case 'Luminarias':              $this->load->view('php/errores_valores/luminarias');        break;
            } // switch
            $data = array(
                'view' => $view,
                'tableData' => $tableData,
                'processJSONarray' => $processJSONarray
            );
            $this->load->view('template_btncheck', $data);

            print '<hr><br>';
            print '<div class="col-sm-12">';
                $data = array(
                    'view' => $view
                );
                $this->load->view('sql_etllayer', $data);
            print '</div>';
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