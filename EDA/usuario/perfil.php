<?php
$conexion = new mysqli("localhost", "root", "", "eda");

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa a la base de datos";
}

// Asegurar que el parámetro "id" sea un número entero
$id_usuario = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM Usuarios WHERE ID = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado) {
    if ($resultado->num_rows == 1) {
        $fila = $resultado->fetch_assoc();
        $nombreUsuario = $fila['NombreUsuario'];
        $correo = $fila['Correo'];
        $fechaNacimiento = $fila['FechaNacimiento'];
        $sexo = $fila['Sexo'];
        $foto = $fila['Foto'];

        $colores = array("#007BFF", "#FF5733", "#33FF57", "#5733FF");
        $colorUsuario = $colores[$fila['ID'] % count($colores)];
    } else {
        echo "No se encontraron resultados para el ID proporcionado";
    }
} else {
    die("Error en la consulta: " . $stmt->error);
}

$conexion->close();
?>