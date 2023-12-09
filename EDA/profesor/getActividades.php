<?php
// Configuración de la base de datos
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

// Consulta SQL para obtener las actividades
$sql = "SELECT id, nombre FROM actividades";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Crear un array para almacenar las actividades
    $actividades = array();

    // Llenar el array con los datos de las actividades
    while ($row = $result->fetch_assoc()) {
        $actividades[] = array(
            'id' => $row['id'],
            'nombre' => $row['nombre']
        );
    }

    // Devolver los datos como JSON
    header('Content-Type: application/json');
    echo json_encode($actividades);
} else {
    echo "0 results";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
