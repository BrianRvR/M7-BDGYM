<?php
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

// Obtener valores del formulario
$dni = $_POST['dni'];
$contraseña = $_POST['contraseña'];

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
    header('Location: inscripcion.php');
} else {
    // Si los datos no son correctos, mostrar mensaje de error
    echo "Usuario o contraseña incorrectos";
}

// Cerrar conexión
$conn->close();
?>
