<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "EDA";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Supongamos que tienes una tabla llamada "actividades_asignadas" que asocia estudiantes con actividades asignadas
// y tiene las columnas: id, id_estudiante, id_actividad, fecha_asignacion, etc.
// Ajusta la consulta según la estructura de tu base de datos

// Obtener el ID del estudiante (podrías obtenerlo de la sesión o algún otro método)
$idEstudiante = 1; // Por ejemplo, asumamos que el ID del estudiante es 1

$sql = "SELECT a.id, a.nombre, a.tipo, a.descripcion
        FROM actividades_asignadas aa
        JOIN actividades a ON aa.id_actividad = a.id
        WHERE aa.id_estudiante = $idEstudiante";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Crear un array para almacenar las actividades asignadas
    $actividadesAsignadas = array();

    // Llenar el array con los datos de las actividades asignadas
    while ($row = $result->fetch_assoc()) {
        $actividadesAsignadas[] = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'tipo' => $row['tipo'],
            'descripcion' => $row['descripcion']
        );
    }

    // Devolver los datos como JSON
    header('Content-Type: application/json');
    echo json_encode($actividadesAsignadas);
} else {
    // No hay actividades asignadas
    echo json_encode(array());
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
