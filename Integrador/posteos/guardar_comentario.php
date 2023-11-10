<?php
// Conexión a la base de datos.. poner en archivo aparte
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "backendlp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$posteo_id = $_POST['posteo_id'];
$comentario = $_POST['comentario'];

// Insertar el comentario en la base de datos
$sql = "INSERT INTO comentarios (posteo_id, comentario) VALUES (?, ?)";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ss", $posteo_id, $comentario);

    if ($stmt->execute()) {
        // Redirigir  a la página de visualización de posteos
        header('Location: prueba.php');
        exit();
    } else {
        echo "Error al guardar el comentario: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error en la consulta: " . $conn->error;
}

$conn->close();
?>
