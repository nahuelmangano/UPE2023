<?php
// Conectar a la base de datos
require_once('bd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['contenido'])) {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];

        // Verificar si se cargó una nueva imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0) {
            $imagen = $_FILES['imagen']['name'];
            $imagen_temp = $_FILES['imagen']['tmp_name'];
            $imagen_destino = "../imagenes_posteos/" . $imagen; // Ruta de destino en el servidor

            move_uploaded_file($imagen_temp, $imagen_destino);

            $imagen_destino = "imagenes_posteos/" . $imagen;
        } else {
            // No se cargó una nueva imagen, mantener la imagen actual
            $sql_imagen_actual = "SELECT imagen_path FROM posteos WHERE id = $id";
            $result_imagen_actual = $conn->query($sql_imagen_actual);

            if ($result_imagen_actual->num_rows > 0) {
                $row_imagen_actual = $result_imagen_actual->fetch_assoc();
                $imagen_destino = $row_imagen_actual["imagen_path"];
            } else {
                $imagen_destino = ""; // Definir la ruta de destino por defecto o según tu lógica
            }
        }

        // Actualizar el posteo en la base de datos
        $sql = "UPDATE posteos SET titulo = '$titulo', contenido = '$contenido', imagen_path = '$imagen_destino' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            header('Location: edit_ok.php');
            echo "Los cambios se guardaron con éxito.";
            echo '<br>';
            echo '<br>';
            echo '<a href="../prueba.php" class="btn btn-default"> Ir a Posteos</a> ';
        } else {
            echo "Error al guardar los cambios: " . $conn->error;
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    } else {
        echo "Datos faltantes.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>
