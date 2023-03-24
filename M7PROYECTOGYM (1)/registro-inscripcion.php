<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "brian";
$password = "12345";
$dbname = "BD_GYM";

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

// Obtener el DNI del socio que ha iniciado sesión
session_start();
$dni = $_SESSION["dni"];

// Obtener los datos de la actividad y la fecha de inscripción
$nombre_actividad = $_POST["nombre_actividad"];
$fecha_inscripcion = $_POST["fecha_inscripcion"];

// Insertar los datos en la tabla "inscripcion"
$sql = "INSERT INTO Inscripcion (nombre_actividad, dni, fecha_inscripcion) VALUES ('$nombre_actividad', '$dni', '$fecha_inscripcion')";

if ($conn->query($sql) === TRUE) {
    echo "La inscripción se ha registrado correctamente.";
} else {
    echo "Error al registrar la inscripción: " . $conn->error;
}

$conn->close();
?>
