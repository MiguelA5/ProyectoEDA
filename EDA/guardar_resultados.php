<?php
// guardar_resultados.php

// Recibir datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Aquí deberías realizar la lógica necesaria para almacenar los resultados en tu base de datos o hacer lo que sea necesario con ellos
// Por ejemplo, podrías guardarlos en una base de datos MySQL o en un archivo de texto

// En este ejemplo, solo imprimimos los resultados
echo 'Resultados guardados correctamente.';
?>
