<?php
class RegistroSocio {
    private $conn; // Conexión a la base de datos

    // Constructor para establecer la conexión a la base de datos
    public function __construct() {
        $host = "localhost"; // Host de la base de datos
        $username = "root"; // Nombre de usuario de la base de datos
        $password = ""; // Contraseña de la base de datos
        $database = "BD_GYM"; // Nombre de la base de datos

        // Establecer la conexión a la base de datos
        $this->conn = new mysqli($host, $username, $password, $database);
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    // Función para registrar un nuevo usuario
    public function registrarUsuario($nombre_apellidos, $correo, $telefono, $dni, $contraseña) {
        // Preparar la consulta SQL
        $stmt = $this->conn->prepare("INSERT INTO Socios (nombre_apellidos, correo, telefono, dni, contraseña) VALUES (?, ?, ?, ?, ?)");

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            $stmt->bind_param("sssss", $nombre_apellidos, $correo, $telefono, $dni, $contraseña); // Enlazar los parámetros

            // Ejecutar la consulta y verificar si se insertó correctamente el registro
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            // Manejar el error en la preparación de la consulta
            echo "Error en la preparación de la consulta: " . $this->conn->error;
            return false;
        }
    }
}

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_apellidos = $_POST["nombre_apellidos"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $dni = $_POST["dni"];
    $contraseña = $_POST["contraseña"];

    // Crear una instancia de la clase RegistroSocio
    $registroSocio = new RegistroSocio();

    // Registrar el nuevo usuario
    $registroExitoso = $registroSocio->registrarUsuario($nombre_apellidos, $correo, $telefono, $dni, $contraseña);

    // Verificar si el registro fue exitoso
    if ($registroExitoso) {
        // Redirigir al usuario a la pantalla de inicio de sesión
        header("Location: iniciosesion.php");
        exit(); // Importante: asegúrate de usar exit() después de usar header() para evitar que se siga ejecutando el código
    } else {
        echo "Error al registrar usuario. Por favor, inténtalo de nuevo.";
    }
}
?>
