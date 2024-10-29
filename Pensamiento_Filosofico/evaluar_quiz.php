<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";  // Cambia esto si tu usuario es diferente
$password = "";  // Cambia esto si tienes una contraseña configurada
$dbname = "preguntas";  // Cambia esto si tu base de datos tiene otro nombre

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$correctas = 0;
$total = 0;

$sql = "SELECT * FROM preguntas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Comparar las respuestas con la base de datos
    while($row = $result->fetch_assoc()) {
        $respuesta_usuario = $_POST['respuesta_' . $row['id']];
        if ($respuesta_usuario == $row['respuesta_correcta']) {
            $correctas++;
        }
        $total++;
    }
}

$conn->close();

// Mostrar el resultado al usuario
echo "<h2>Resultado del quiz</h2>";
echo "<p>Has respondido correctamente $correctas de $total preguntas.</p>";
?>
