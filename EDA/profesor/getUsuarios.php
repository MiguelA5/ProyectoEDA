<?php
// Sección de conexión a la base de datos
$servername = "localhost"; // Reemplaza con la dirección del servidor de tu base de datos
$username = "root"; // Reemplaza con el nombre de usuario de la base de datos
$password = ""; // Reemplaza con la contraseña de la base de datos
$database = "EDA"; // Reemplaza con el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener usuarios
$sql = "SELECT id, correoUsuario FROM usuarios";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result === false) {
    // Manejar errores de consulta
    $error = $conn->error;
    echo json_encode(array("error" => "Error en la consulta: " . $error));
} else {
    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        // Obtener los datos y enviarlos como JSON
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo json_encode(array("message" => "No hay resultados"));
    }
}

// Cerrar conexión
$conn->close();
?>
