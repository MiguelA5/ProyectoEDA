<?php
// Establecer la conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eda";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Ejemplo de consulta
$sql = "SELECT ID, NombreUsuario, Correo FROM Usuarios";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result === FALSE) {
    die("Error en la consulta: " . $conn->error);
}

// Mostrar resultados de la consulta
if ($result->num_rows > 0) {
    echo "<h2>Usuarios:</h2>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>ID: " . $row["ID"]. " - Nombre: " . $row["NombreUsuario"]. " - Correo: " . $row["Correo"]. "</li>";
    }
    echo "</ul>";
} else {
    echo "No hay usuarios en la base de datos.";
}

// Cerrar la conexión al final del script
$conn->close();
?>
