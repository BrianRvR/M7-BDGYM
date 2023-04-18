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
$dni = $_SESSION["dni"];

//comprobar si el dni esta en la base de datos
if (isset($_SESSION["dni"])) {
    $dni = $_SESSION["dni"];
} else {
    die("Error: DNI no está definido en la sesión.");
}

// Obtener los datos de la actividad y la fecha de inscripción
$nombre_actividad = $_POST["nombre_actividad"];
$fecha_inscripcion = $_POST["fecha_inscripcion"];

// Insertar los datos en la tabla "inscripcion"
$sql = "INSERT INTO Inscripcion (nombre_actividad, dni, fecha_inscripcion) VALUES ('$nombre_actividad', '$dni', '$fecha_inscripcion')";

if ($conn->query($sql) === TRUE) {
    // Redirigir a la página con dos botones
    header("Location:InsBtn.php");
    exit;
} else {
    echo "Error al registrar la inscripción: " . $conn->error;
}

$conn->close();
?>