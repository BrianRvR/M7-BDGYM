<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "brian";
$password = "12345";
$dbname = "BD_GYM";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener valores del formulario
$dni = $_POST['dni'];
$contraseña = $_POST['contraseña'];

// Consultar si el usuario y contraseña son correctos
$sql = "SELECT dni, contraseña FROM Socios WHERE dni = '$dni' AND contraseña = '$contraseña'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    // Iniciar sesión y redireccionar al usuario
    session_start();
    $_SESSION['dni'] = $dni;
    header('Location: registro-inscripcion.php');
} else {
    // Si los datos no son correctos, mostrar mensaje de error
    echo "Usuario o contraseña incorrectos";
}

// Cerrar conexión
$conn->close();
?>
