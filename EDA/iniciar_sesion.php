<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establecer la conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eda";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$correo_usuario = $_POST['correo_usuario'] ?? '';
$contrasena_usuario = $_POST['contrasena_usuario'] ?? '';

// Verificar que los campos no estén vacíos
if (empty($correo_usuario) || empty($contrasena_usuario)) {
    die("Datos incompletos. Por favor, completa todos los campos.");
}

// Utilizar sentencias preparadas para evitar la inyección de SQL
$sql = "SELECT * FROM usuarios WHERE CorreoUsuario=? AND Contrasena=?";
$stmt = $conn->prepare($sql);

// Verificar si la preparación fue exitosa
if ($stmt) {
    // Vincular parámetros
    $stmt->bind_param("ss", $correo_usuario, $contrasena_usuario);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener resultados
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario
    /*if ($result->num_rows > 0) {
        // Inicio de sesión exitoso
        echo "Inicio de sesión exitoso. ¡Bienvenido, $correo_usuario!";
        // Puedes redirigir al usuario a la carpeta deseada aquí
        header("Location: .html");
        exit();
    } else {
        // Inicio de sesión fallido
        echo "Inicio de sesión fallido. Usuario o contraseña incorrectos.";
    }*/

    // Cerrar el statement
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
