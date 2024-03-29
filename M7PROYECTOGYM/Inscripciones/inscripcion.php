<!DOCTYPE html>
<html>
<head>
    <title>Inscripción</title>
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
		<div class="container-login100" style="background-image: url('../Bootstrap/images/body.jpg');">
		<div class="wrap-login100">
			<form class="login100-form validate-form" method="post" action="../Inscripciones/registro-inscripcion.php" >
				<span class="login100-form-logo">
					<img src="../Bootstrap/images/Logoazura.png" alt="Logo de la empresa"  height="100">
				</span>

				<span class="login100-form-title p-b-34 p-t-27">
					Inscripción
				</span>

				<div class="wrap-input100 validate-input" data-validate = "Enter username">
					<label for="nombre_actividad"></label>
					<input class="input100" id="nombre_actividad" type="text"  name="nombre_actividad" placeholder="Nombre de la actividad">
					<span class="focus-input100" data-placeholder="&#xf207;"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Enter password">
					<label for="fecha_inscripcion"></label>
					<input class="input100" id="fecha_inscripcion" type="date"  name="fecha_inscripcion" placeholder="Fecha de inscripción">
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
					Inscribirse
					</button>
				</div>

				<div class="container-login100-form-btn" style="margin-top: 20px;">
					<a href="../Inscripciones/ver-inscripciones.php" class="login100-form-btn">
					Ver Inscripciones
					</a>
				</div>

				<div class="text-center p-t-90">
					<!--<a class="txt1" href="#">
						Forgot Password?
					</a>-->
				</div>
			</form>
		</div>
            
            <div class="wrap-login100" style="margin:20px; height: 712px;">
				<form class="login100-form validate-form">
					<span class="login100-form-logo">
						<img src="../Bootstrap/images/actividad.png" alt="Logo de la empresa"  height="100">
					</span>
					<span class="login100-form-title p-b-34 p-t-27">
						Actividades
					</span>
					<div style="text-align:center; font-size:20px; border:2px solid white; padding:10px; width:80%; margin-left:10%; border-radius:10px">
						<table style="width:100%; color:white; margin:auto;">
							<?php
							// Realizar la conexión a la base de datos
							$conn = new mysqli("localhost", "root", "", "BD_GYM");

							// Verificar la conexión
							if ($conn->connect_error) {
								die("Error de conexión: " . $conn->connect_error);
							}

							$sql = "SELECT nombre_actividad, hora_actividad FROM Actividades";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								// Datos de salida de cada fila
								while($row = $result->fetch_assoc()) {
									echo "<tr style='text-align:center;'>";
									echo "<td>" . $row["nombre_actividad"] . "</td>";
									echo "<td>" . $row["hora_actividad"] . "</td>";
									echo "</tr>";
								}
							} else {
								echo "0 resultados";
							}
							$conn->close();
							?>
						</table>
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
