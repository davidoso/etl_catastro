<body>
	<?php $this->load->view('template_header'); ?>

	<div class="container"> <!-- container -->
		<div class="row">
			<br>
			<div class="panel panel-default col-sm-12" id="fondo-panel">
				<div class="panel-group" id="accordion"> <!-- panel-group -->
					<br>
			   		<div class="panel panel-success"> <!-- accordion -->
			   			<div class="panel-heading">
			            	<h4 class="panel-title">
				            	<a data-toggle="collapse" data-parent="#accordion" href="#accordionDiv">
                                <?php echo $accordionTitle; ?>
				            	</a>
			           		</h4>
			        	</div>
			        	<div id="accordionDiv" class="collapse in"> <!-- panel-collapse -->
							<div class="panel-body"> <!-- panel-body -->
								<?php
									$data = array(
										'view' => $view,
										'accordionTitle' => $accordionTitle,
										'tableData' => $tableData,
										'processJSONarray' => $processJSONarray
									); $this->load->view('sql_errors', $data);
								?>
							</div> <!-- panel-body -->
			            </div> <!-- panel-collapse -->
		            </div> <!-- accordion -->
			    </div> <!-- panel-group -->
            </div>
        </div>
    </div> <!-- container -->

<?php $this->load->view('template_footer'); ?>
</body>