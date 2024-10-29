<?php
// autentication.php
header('Content-Type: application/json');

// Conexión a la base de datos
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'usuarios';

$conn = new mysqli($hostname, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión']));
}

// Obtiene los datos enviados
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

// Consulta para verificar las credenciales
$stmt = $conn->prepare('SELECT * FROM usuarios WHERE username = ? AND password = ?');
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Credenciales correctas
    echo json_encode(['success' => true]);
} else {
    // Credenciales incorrectas
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>
