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

// Verificar si se enviaron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pregunta = $_POST['pregunta'];
    $opcion1 = $_POST['opcion1'];
    $opcion2 = $_POST['opcion2'];
    $opcion3 = $_POST['opcion3'];
    $opcion4 = $_POST['opcion4'];
    $respuesta_correcta = $_POST['respuesta_correcta'];

    // Convertir respuesta correcta a 'a', 'b', 'c' o 'd'
    switch ($respuesta_correcta) {
        case '1':
            $respuesta_correcta = 'a';
            break;
        case '2':
            $respuesta_correcta = 'b';
            break;
        case '3':
            $respuesta_correcta = 'c';
            break;
        case '4':
            $respuesta_correcta = 'd';
            break;
    }

    // Insertar la nueva pregunta en la base de datos
    $sql = "INSERT INTO preguntas (pregunta, opcion1, opcion2, opcion3, opcion4, respuesta_correcta)
            VALUES ('$pregunta', '$opcion1', '$opcion2', '$opcion3', '$opcion4', '$respuesta_correcta')";

    if ($conn->query($sql) === TRUE) {
        echo "Pregunta agregada correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
