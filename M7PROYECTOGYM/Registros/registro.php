<!DOCTYPE html>
<html>
<head>
    
    <title>Registro</title>
    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../Bootstrap/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Bootstrap/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Bootstrap/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Bootstrap/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Bootstrap/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../Bootstrap/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Bootstrap/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Bootstrap/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../Bootstrap/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Bootstrap/css/util.css">
	<link rel="stylesheet" type="text/css" href="../Bootstrap/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('../Bootstrap/images/bg-01.jpg');">

			<div class="wrap-login100" style="margin:20px;">
				<form class="login100-form validate-form" method="post" action="../Registros/registro-socio.php" >
		
					<span class="login100-form-logo">
						<img src="../Bootstrap/images/Logoazura.png" alt="Logo de la empresa"  height="100">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Registro
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<label for="nombre_apellidos"></label>
						<input class="input100" id="nombre_apellidos" type="text"  name="nombre_apellidos" placeholder="Nombre y Apellidos">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<label for="correo"></label>
						<input class="input100" id="correo" type="email"  name="correo" placeholder="Correo Electrónico">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<label for="telefono"></label>
						<input class="input100" id="telefono" type="tel"  name="telefono" placeholder="Telefono">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<label for="dni"></label>
						<input class="input100" id="dni" type="text"  name="dni" placeholder="DNI">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<label for="contraseña"></label>
						<input class="input100" id="contraseña" type="password"  name="contraseña" placeholder="Contraseña">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<!--<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>-->
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Registrarse
						</button>
					</div>

					<div class="text-center p-t-90">
						<!--<a class="txt1" href="#">
							Forgot Password?
						</a>-->
					</div>
				</form>
			</div>
		</div>
	</div>

    <div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="../Bootstrap/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../Bootstrap/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../Bootstrap/vendor/bootstrap/js/popper.js"></script>
	<script src="../Bootstrap/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../Bootstrap/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../Bootstrap/vendor/daterangepicker/moment.min.js"></script>
	<script src="../Bootstrap/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../Bootstrap/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../Bootstrap/js/main.js"></script>
</body>
</html>
