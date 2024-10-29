<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Permitir CORS si es necesario

// Conectar a la base de datos
$servername = "localhost"; // Cambia si tu servidor es diferente
$username = "root"; // Cambia a tu usuario de MySQL
$password = ""; // Cambia a tu contraseña de MySQL
$dbname = "preguntas"; // Cambia a tu nombre de base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(array(
        "status" => "error",
        "message" => "Conexión fallida: " . $conn->connect_error
    ));
    exit(); // Detener la ejecución
}

// Preparar consulta
$sql = "SELECT pregunta, opcion1, opcion2, opcion3, opcion4, respuesta_correcta FROM preguntas";
$stmt = $conn->prepare($sql);

// Verificar si la consulta fue preparada correctamente
if ($stmt === false) {
    echo json_encode(array(
        "status" => "error",
        "message" => "Error en la consulta: " . $conn->error
    ));
    exit();
}

// Ejecutar consulta
$stmt->execute();

// Obtener el resultado
$result = $stmt->get_result();

$preguntas = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $preguntas[] = $row;
    }

    // Devolver los datos en formato JSON
    echo json_encode(array(
        "status" => "success",
        "data" => $preguntas
    ));
} else {
    echo json_encode(array(
        "status" => "error",
        "message": "No se encontraron preguntas."
    ));
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
