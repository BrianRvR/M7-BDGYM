<?php
// Archivo PHP

// Realizar la conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "BD_GYM");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener información de la tabla Socios
$sql_Socios = "SELECT * FROM Socios";
$result_Socios = $conn->query($sql_Socios);

// Obtener información de la tabla Actividades
$sql_Actividades = "SELECT * FROM Actividades";
$result_Actividades = $conn->query($sql_Actividades);

// Obtener información de la tabla Inscripciones
$sql_Inscripciones = "SELECT id, dni, nombre_actividad, fecha_inscripcion FROM Inscripcion";
$result_Inscripciones = $conn->query($sql_Inscripciones);


// Cerrar la conexión
$conn->close();
?>
