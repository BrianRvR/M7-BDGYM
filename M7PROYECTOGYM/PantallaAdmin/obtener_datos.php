<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- jQuery y JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<?php

// Archivo obtener_datos.php

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

// Verificar si se envió una solicitud de eliminación de socio
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['eliminar_socio'])) {
    $socioDNI = $_GET['eliminar_socio'];

    $sql_DeleteSocio = "DELETE FROM Socios WHERE dni = '$socioDNI'";
    if ($conn->query($sql_DeleteSocio) === TRUE) {
        //echo "El socio ha sido eliminado exitosamente.";
    } else {
        echo "Error al eliminar el socio: " . $conn->error;
    }
}

// Verificar si se envió una solicitud de eliminación de inscripción
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['eliminar_inscripcion'])) {
    $inscripcionId = $_GET['eliminar_inscripcion'];

    $sql_DeleteInscripcion = "DELETE FROM Inscripcion WHERE id = $inscripcionId";
    if ($conn->query($sql_DeleteInscripcion) === TRUE) {
        //echo "La inscripción ha sido eliminada exitosamente.";
    } else {
        echo "Error al eliminar la inscripción: " . $conn->error;
    }
}

// Verificar si se envió una solicitud de eliminación de actividad
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['eliminar_actividad'])) {
    $nombreActividad = $_GET['eliminar_actividad'];

    $sql_DeleteActividad = "DELETE FROM Actividades WHERE nombre_actividad = '$nombreActividad'";
    if ($conn->query($sql_DeleteActividad) === TRUE) {
        header('Location: pantalla_admin.php');
        exit;
    } else {
        echo "Error al eliminar la actividad: " . $conn->error;
    }
}
// Verificar si se envió una solicitud de edición de socio
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editar_socio'])) {
    $socioDNI = $_POST['dni'];
    $nuevoNombre = $_POST['nombre'];
    $nuevoApellido = $_POST['apellido'];

    $sql_UpdateSocio = "UPDATE Socios SET nombre_apellidos = '$nuevoNombre', correo = '$nuevoCorreo', telefono = '$nuevoTelefono' WHERE dni = '$socioDNI'";
    if ($conn->query($sql_UpdateSocio) === TRUE) {
        //echo "El socio ha sido actualizado exitosamente.";
    } else {
        echo "Error al actualizar el socio: " . $conn->error;
    }
}

// Verificar si se envió una solicitud de edición de inscripción
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editar_inscripcion'])) {
    $inscripcionId = $_POST['id'];
    $nuevoDNI = $_POST['dni'];
    $nuevoNombreActividad = $_POST['nombre_actividad'];
    $nuevaFechaInscripcion = $_POST['fecha_inscripcion'];

    $sql_UpdateInscripcion = "UPDATE Inscripcion SET dni = '$nuevoDNI', nombre_actividad = '$nuevoNombreActividad', fecha_inscripcion = '$nuevaFechaInscripcion' WHERE id = $inscripcionId";
    if ($conn->query($sql_UpdateInscripcion) === TRUE) {
        //echo "La inscripción ha sido actualizada exitosamente.";
    } else {
        echo "Error al actualizar la inscripción: " . $conn->error;
    }
}

// Verificar si se envió una solicitud de edición de actividad
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editar_actividad'])) {
    $nombreActividad = $_POST['editar_actividad'];
    $nuevoNombreActividad = $_POST['nuevo_nombre_actividad'];
    $nuevaHoraActividad = $_POST['nueva_hora_actividad'];

    $sql_UpdateActividad = "UPDATE Actividades SET nombre_actividad = '$nuevoNombreActividad', hora_actividad = '$nuevaHoraActividad' WHERE nombre_actividad = '$nombreActividad'";
    if ($conn->query($sql_UpdateActividad) === TRUE) {
        // Redirigir a pantalla_admin.php
        header("Location: pantalla_admin.php");
        exit;
    } else {
        echo "Error al actualizar la actividad: " . $conn->error;
    }
}

// Verificar si se envió una solicitud de edición de actividad
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['editar_actividad'])) {
    $nombreActividad = $_GET['editar_actividad'];

    // Obtener los datos actuales de la actividad
    $sql_GetActividad = "SELECT * FROM Actividades WHERE nombre_actividad = '$nombreActividad'";
    $result_GetActividad = $conn->query($sql_GetActividad);
    if ($result_GetActividad->num_rows > 0) {
        $actividad = $result_GetActividad->fetch_assoc();
    } else {
        echo "No se encontró la actividad: " . $conn->error;
        exit;
    }

    
}

function agregarActividad($nombre, $hora) {
    global $conn;

    $sql_AddActividad = "INSERT INTO Actividades (nombre_actividad, hora_actividad) VALUES ('$nombre', '$hora')";
    if ($conn->query($sql_AddActividad) === TRUE) {
        return true;
    } else {
        echo "Error al agregar la actividad: " . $conn->error;
        return false;
    }
}

// Verificar si se envió una solicitud de adición de actividad
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['agregar_actividad'])) {
    $nuevoNombreActividad = $_POST['nuevo_nombre_actividad'];
    $nuevaHoraActividad = $_POST['nueva_hora_actividad'];

    // Llamar a la función para agregar la actividad
    if(agregarActividad($nuevoNombreActividad, $nuevaHoraActividad)) {
        // Redirige al usuario de vuelta a la página principal después de agregar la actividad
        header('Location: pantalla_admin.php');
        exit;
    }
}



// Cerrar la conexión
$conn->close();