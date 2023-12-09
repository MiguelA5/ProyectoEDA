<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Verifica si se recibieron datos POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    // Obtiene los datos del cuerpo de la solicitud
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    // Guarda los resultados en la base de datos
    $conn = new mysqli("localhost", "root", "", "eda");

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Prepara la consulta
    $query = "INSERT INTO resultados_cuestionario (visual, auditivo, cinestesico) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    // Verifica si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . $conn->error);
    }

    // Vincula los parámetros y tipos
    $stmt->bind_param("iii", $data['visual'], $data['auditivo'], $data['cinestesico']);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "¡Resultados recibidos y guardados correctamente en la base de datos!";
    } else {
        echo "Error al guardar los resultados: " . $stmt->error;
    }

    // Cierra la conexión y la declaración preparada
    $stmt->close();
    $conn->close();
} else {
    // Si no es una solicitud POST válida
    header("HTTP/1.1 400 Bad Request");
    echo "Solicitud no válida";
}
?>
