<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Procesamiento del formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    // Consulta SQL vulnerable a inyección
    $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "Login exitoso! Bienvenido " . htmlspecialchars($user);
    } else {
        echo "Credenciales incorrectas";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Vulnerable</title>
</head>
<body>
    <h2>Formulario de Login (Vulnerable a Inyección SQL)</h2>
    <form method="POST" action="">
        Usuario: <input type="text" name="username"><br>
        Contraseña: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
    
    <h3>Ejemplo de ataque:</h3>
    <p>Intenta con: <code>' OR '1'='1</code> en usuario y contraseña</p>
</body>
</html>