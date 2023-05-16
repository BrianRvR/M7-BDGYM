<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BD_GYM";

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

// Obtener el DNI del socio que ha iniciado sesión
session_start();
if (isset($_SESSION["dni"])) {
    $dni = $_SESSION["dni"];
} else {
    die("Error: DNI no está definido en la sesión.");
}

// Obtener los datos de la actividad y la fecha de inscripción
$nombre_actividad = $_POST["nombre_actividad"];
$fecha_inscripcion = $_POST["fecha_inscripcion"];

// Preparar la sentencia SQL
$stmt = $conn->prepare("INSERT INTO Inscripcion (nombre_actividad, dni, fecha_inscripcion) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre_actividad, $dni, $fecha_inscripcion);

// Ejecutar la sentencia
if ($stmt->execute()) {
    // Redirigir a la página con dos botones
    header("Location:../Inscripciones/InsBtn.php");
    exit;
} else {
    echo "Error al registrar la inscripción: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
