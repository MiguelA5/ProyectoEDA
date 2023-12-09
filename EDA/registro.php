<?php
// Sección de conexión a la base de datos
$servername = "localhost"; // Reemplaza con la dirección del servidor de tu base de datos
$username = "root"; // Reemplaza con el nombre de usuario de la base de datos
$password = ""; // Contraseña en blanco para el usuario 'root' en configuraciones locales
$database = "EDA"; // Reemplaza con el nombre de tu base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han proporcionado todos los campos requeridos en $_POST
    if (!isset($_POST["nombreUsuario"], $_POST["correo"], $_POST["contrasena"], $_POST["fecha_nacimiento"], $_POST["sexo"])) {
        die("Datos incompletos");
    }

    $nombreUsuario = $_POST["nombreUsuario"];
    $correo = $_POST["correo"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $sexo = $_POST["sexo"];

    // Verificar si el archivo se cargó correctamente
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == UPLOAD_ERR_OK) {
        $nombre_foto = $_FILES["foto"]["name"];
        $ruta_foto = "usuario/imag/" . $nombre_foto;

        // Asegurarse de que el directorio de destino exista
        if (!is_dir("usuario/imag")) {
            mkdir("usuario/imag", 0755, true); // Crea directorios recursivamente
        }

        // Mover el archivo cargado al destino
        if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_foto)) {
            die("Error al mover el archivo cargado");
        }
    } else {
        die("Error al cargar el archivo");
    }

    // Conexión a la base de datos
    $conexion = new mysqli($servername, $username, $password, $database);

    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    // Consulta SQL con preparación
    $sql = "INSERT INTO usuarios (nombreUsuario, correoUsuario, contrasena, fecha_nacimiento, sexo, foto) 
    VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("ssssss", $nombreUsuario, $correoUsuario, $contrasena, $fecha_nacimiento, $sexo, $ruta_foto);
        $stmt->execute();

        // Verificar si la inserción fue exitosa
        if ($stmt->affected_rows > 0) {
            // Registro exitoso
            header("Location: index.html");
            exit();
        } else {
            echo "Error en el registro: " . $stmt->error;
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?>
