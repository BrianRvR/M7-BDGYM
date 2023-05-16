<!DOCTYPE html>
<html>
<head>
    <title>Ver Inscripcion</title>
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
			<div class="wrap-login100" style="margin:20px;height: 830px;width:80%;margin-bottom: auto;">
			
				<form class="login100-form validate-form">
			
					<span class="login100-form-logo">
						<img src="../Bootstrap/images/actividad.png" alt="Logo de la empresa"  height="100">
					</span>
					<div class="container-login100-form-btn" style="display: flex; justify-content: space-around;">
						<a href="inscripcion.php" class="login100-form-btn">
							Volver
						</a>
						<a href="../Login/iniciosesion.php" class="login100-form-btn">
							Cerrar sesión
						</a>
				</div>
					<span class="login100-form-title p-b-34 p-t-27">
						Mis Inscripciones
					</span>
					<div style="text-align:center; font-size:20px; border:2px solid white; padding:10px; width:80%; margin-left:10%; border-radius:10px">
						<table style="width:100%; color:white; margin:auto;">
							<?php
							// Iniciar la sesión
							session_start();

							// Comprobar si el DNI del socio está establecido en la sesión
							if (!isset($_SESSION["dni"])) {
								die("Error: DNI no está definido en la sesión.");
							}

							// Obtener el DNI del socio que ha iniciado sesión
							$dni = $_SESSION["dni"];

							// Realizar la conexión a la base de datos
							$conn = new mysqli("localhost", "root", "", "BD_GYM");

							// Verificar la conexión
							if ($conn->connect_error) {
								die("Error de conexión: " . $conn->connect_error);
							}

							// Ajustar la consulta SQL para que solo devuelva las inscripciones del socio actual
							// y hacer JOIN con la tabla Actividades para obtener la hora de la actividad
							$sql = "SELECT Inscripcion.nombre_actividad, Inscripcion.fecha_inscripcion, Actividades.hora_actividad 
									FROM Inscripcion 
									INNER JOIN Actividades ON Inscripcion.nombre_actividad = Actividades.nombre_actividad
									WHERE Inscripcion.dni = '$dni'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								// Datos de salida de cada fila
								while($row = $result->fetch_assoc()) {
									echo "<tr style='text-align:center;'>";
									echo "<td>" . $row["nombre_actividad"] . "</td>";
									echo "<td>" . $row["hora_actividad"] . "</td>";
									echo "<td>" . $row["fecha_inscripcion"] . "</td>";
									echo "</tr>";
								}
							} else {
								echo "No tienes ninguna inscripción.";
							}
							$conn->close();
							?>
						</table>
					</div>
					
				</form>
				
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
