<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estilo.css">
    <title>Inicio de Sesión</title>
</head>
<body>
    <div class="inicio">
        <h1>Iniciar Sesión</h1>
        <form method="post" action="login-proceso.php">
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni"><br><br>
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña"><br><br>
            <input type="submit" value="Ingresar">
        </form>
    </div>
</body>
</html>
