<?php
session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
} else {
    // Manejar la situación en la que el usuario no ha iniciado sesión
    // Redireccionar o mostrar un mensaje de error, por ejemplo
}
?>

<?php
// Conexión a la base de datos -... poner en archivo aparte
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "backendlp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$titulo = $_POST['titulo'];
$contenido = $_POST['contenido'];
$tipo_posteo = $_POST['tipo_posteo'];



// Procesar la carga de la imagen
if (isset($_FILES['imagen'])) {
    $imagen = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $imagen_destino = "imagenes_posteos/" . $imagen; // Ruta de destino en el servidor
    move_uploaded_file($imagen_temp, $imagen_destino);
} else {
    echo 'Entro aca     --- --- --   ';
    $imagen = ""; // Si no se cargó ninguna imagen
}
$creador=$_SESSION['user_id'];

// Insertar el posteo en la base de datos, incluyendo la ruta de la imagen
$sql = "INSERT INTO posteos (titulo, contenido,tipo_post, imagen_path, creador) VALUES (?, ?, ?, ?, ?)";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sssss", $titulo, $contenido,$tipo_posteo, $imagen_destino,$_SESSION['user_id']);

    if ($stmt->execute()) {
        // Redirigir de nuevo a la página de creación de posteo
        header('Location: posteo_form.php');
        exit();
    } else {
        echo "Error al guardar el posteo: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error en la consulta: " . $conn->error;
}

$conn->close();
?>
