<div class="col-sm-12">
	<br>
	<div class="col-sm-9">
		<?php
			$automaticErrors = str_replace("processJSONarray", "errores_automatic", $processJSONarray);
			$automaticErrors = substr($automaticErrors, 18, -4);
			if((substr($view, 4, 8) === "comercio" && substr($view, 4, 15) !== "comercio\$plazas"
				&& substr($view, 4, 14) !== "comercio\$giros") || substr($view, 4, 4) === "inah") {
					$automaticErrors = "php/errores_automatic/default";
			}
			$data = array(
				'view' => $view
			);
			$this->load->view($automaticErrors, $data);
		?>
	</div>
	<div class="col-sm-3">
		<?php
			$data = array(
				'tableData' => $tableData,
				'processJSONarray' => $processJSONarray
			);
		$this->load->view('template_btncheck_reload', $data);
		?>
	</div>
</div>