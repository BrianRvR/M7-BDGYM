<?php
// Obtener valores del formulario
$dni = $_POST['dni'];
$contraseña = $_POST['contraseña'];

// Verificar si el usuario y contraseña son correctos para el usuario administrador
if ($dni == 'admin' && $contraseña == 'admin123') {
    // Iniciar sesión y redireccionar al usuario administrador
    session_start();
    $_SESSION['dni'] = $dni;
    header('Location:../PantallaAdmin/pantalla_admin.php');
} else {
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "BD_GYM";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Consultar si el usuario y contraseña son correctos utilizando consultas preparadas
    $sql = "SELECT dni, contraseña FROM Socios WHERE dni = ? AND contraseña = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $dni, $contraseña);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Iniciar sesión y redireccionar al usuario
        session_start();
        $_SESSION['dni'] = $dni;
        header('Location: ../Inscripciones/inscripcion.php');
    } else {
        // Si los datos no son correctos, mostrar mensaje de error en rojo y redireccionar a la página de inicio de sesión
        session_start();
        $_SESSION['error'] = "Usuario o contraseña incorrectos";
        header('Location: ../Login/iniciosesion.php?error=1'); // Agregamos un parámetro de error en la URL
    }

    // Cerrar conexión
    $conn->close();
}
?>
