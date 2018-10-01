<button id="btnUpdate" type="button" title="CORREGIR ERRORES" class="btn btn-success btn-block">CORREGIR ERRORES&nbsp;&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i>
</button>
<br>

<script>
	$(document).ready(function() {
		$("#btnUpdate").click(function() {
			document.getElementById("btnUpdate").disabled = true;
			$("body").css('cursor', 'wait');
			//$("body").css('pointer-events', 'none');								// It disables wait cursor
			//$("body").css({"cursor-color": "wait", "pointer-events": "none"});	// Same issue. Solved using css

			var TrashArray = [];
			var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
			for(var i = 0; i < checkboxes.length; i++) {
				TrashArray.push(checkboxes[i].value);
			}
			//alert("Trash Array before JSON:\n" + TrashArray);
			//TrashArray = JSON.stringify(TrashArray);	// Works but array is not recognized after being sent
			TrashArray = $.toJSON(TrashArray);
			//alert("Trash Array after JSON:\n" + TrashArray);

			var TableData = storeTblValues()
			TableData = $.toJSON(TableData);
			//alert("Table Data after JSON:\n" + TableData);
			function storeTblValues() {
				var TableData = new Array();
				$("#htmlgrid tr").each(function(row, tr) {
					TableData[row] = <?php echo $tableData; ?>
				});
				TableData.shift();	// First row will be empty, so let's remove it
				return TableData;
			}

			var username = <?php echo "'" . $this->session->userdata('username') . "';"; ?>
			username = $.toJSON(username);

			$.ajax({
				type: "POST",
				//url: "php/processJSONarray/bancos.php",	// Example url
				url: "<?php echo $processJSONarray; ?>",	// Error 403: Forbidden. Solved changing httpd.conf
				//data: "pTableData=" + TableData,			// Accepts just one JSON array, we need two
				data: { pTableData:TableData, pTrashArray:TrashArray, username:username },
				success: function(result) {
					//alert(result);
					//$("#divAjax").html(result);
					//alert("Cambios guardados con éxito\nHaz click para continuar...");
					window.location.reload(true);
				}
			});
		});
	});
</script>