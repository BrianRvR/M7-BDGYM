<?php
// Archivo editar.php

// Realizar la conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "BD_GYM");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['tipo']) && isset($_GET['id'])) {
    $tipo = $_GET['tipo'];
    $id = $_GET['id'];

    // Editar socio
    if ($tipo === 'socio') {
        // Realiza las consultas SQL para obtener los datos del socio con el ID correspondiente
        // y muestra un formulario prellenado para editar los campos relevantes.
    }
    // Editar inscripción
    elseif ($tipo === 'inscripcion') {
        // Realiza las consultas SQL para obtener los datos de la inscripción con el ID correspondiente
        // y muestra un formulario prellenado para editar los campos relevantes.
    }
    // Editar actividad
    elseif ($tipo === 'actividad') {
        // Realiza las consultas SQL para obtener los datos de la actividad con el ID correspondiente
        // y muestra un formulario prellenado para editar los campos relevantes.
    }
}

// Al recibir el envío del formulario, procesa los datos y realiza las actualizaciones correspondientes en la base de datos.

// Cerrar la conexión
$conn->close();
?>