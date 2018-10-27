<!DOCTYPE html>
<html lang="es-MX">
<head>
    <title>CATASTRO | ETL</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?php echo base_url();?>">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/favicons/home.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/login_util.css">
	<link rel="stylesheet" type="text/css" href="css/login_main.css">
<!--===============================================================================================-->
	<script src="js/jquery-3.3.1.min.js"></script>
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-cityhall.png');">
	        <div class="wrap-login100">
			    <form id= "frmLogin" class="login100-form validate-form" action="index.php/Etl/login"
                    method="post" name="loginform">
				    <span class="login100-form-logo" style="background-image: url('images/logo-login.png');">
					</span>
					<span class="login100-form-title p-b-34 p-t-27">
						CATASTRO DINÁMICO
                    </span>

					<div class="wrap-input100 validate-input" data-validate="Ingrese un usuario">
						<input class="input100" type="text" id="username" name="username" placeholder="Usuario">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

					<div class="wrap-input100 validate-input" data-validate="Ingrese una contraseña">
						<input class="input100" type="password" id="password" name="password" placeholder="Contraseña">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

					<div id="divGender" align:"center" style="display:none;">
						<center>
							<input type="radio" name="gender" value="H" style="margin-right: 3px;" checked><b> Hombre</b>
							<span style="display: inline-block; width: 40px;"></span>
							<input type="radio" name="gender" value="M" style="margin-right: 3px;"><b> Mujer</b>
							<br>
						</center>
					</div>

					<div id="divBtnLogin" class="container-login100-form-btn">
						<button id="btnLogin" type="submit" class="login100-form-btn">
						    Iniciar sesión
						</button>
                    </div>

					<div id="divSignup">
                    <?php
						if(isset($error_message)) {
							print '<br>';
							print '<div class="alert alert-danger alert-dismissible text-center">';
							print '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
							print '<strong>¡Error! ' . $error_message . '</strong></div>';
						}
						if(isset($signup_message)) {
							if($signup_message[8] == 'c') {
								$alert_type = 'alert-success';
							}
							else {
								$alert_type = 'alert-warning';
							}
							print '<br>';
							print '<div class="alert ' . $alert_type . ' alert-dismissible text-center">';
							print '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
							print '<strong>' . $signup_message . '</strong></div>';
						}
					?>
					</div>

					<div class="text-center p-t-90" style="padding-top: 27px;">
					    <a id="aSignup" class="txt1" href="javascript:toggle()" value="0">
					        Registrarme
					    </a>
				    </div>
			    </form>
	        </div>
        </div>
    </div>

	<script>
		function toggle() {
			var flag = document.getElementById("aSignup").value;
			//document.getElementById('username').value = '';
			document.getElementById("password").value = '';
			if(flag == 0) {
				document.getElementById("divSignup").innerHTML =
				'<br>'+
				'<div class="alert alert-info text-center">'+
				'<strong>Introduzca un nombre de usuario y contraseña</strong></div>';
				document.getElementById("btnLogin").childNodes[0].nodeValue = "Crear nuevo usuario";
				document.getElementById("aSignup").childNodes[0].nodeValue = "Iniciar sesión";
				document.getElementById("aSignup").value = 1;
				document.getElementById("frmLogin").setAttribute("action", "index.php/Etl/signup");
				document.getElementById("divBtnLogin").setAttribute("style", "padding-top: 20px;");
				document.getElementById("divGender").setAttribute("style", "display: block");
			}
			else {
				document.getElementById("divSignup").innerHTML = '';
				document.getElementById("btnLogin").childNodes[0].nodeValue = "Iniciar sesión";
				document.getElementById("aSignup").childNodes[0].nodeValue = "Registrarme";
				document.getElementById("aSignup").value = 0;
				document.getElementById("frmLogin").setAttribute("action", "index.php/Etl/login");
				document.getElementById("divBtnLogin").setAttribute("style", "padding-top: 0px;");
				document.getElementById("divGender").setAttribute("style", "display: none");
			}
		}
	</script>

	<script src="js/login_main.js"></script>
</body>
</html>