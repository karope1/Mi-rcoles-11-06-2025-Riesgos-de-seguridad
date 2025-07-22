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
    
    // Consulta SQL preparada (protegida contra inyección)
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    
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
    <title>Login Seguro</title>
</head>
<body>
    <h2>Formulario de Login (Protegido contra Inyección SQL)</h2>
    <form method="POST" action="">
        Usuario: <input type="text" name="username"><br>
        Contraseña: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>