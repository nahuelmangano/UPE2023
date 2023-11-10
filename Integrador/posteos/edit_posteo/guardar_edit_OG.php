<?php
// Conectar a la base de datos
require_once('bd.php');

       

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['contenido']) ) {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];
        // Actualizar el posteo en la base de datos IMAGEN
        // Procesar la carga de la imagen
        
if (isset($_FILES['imagen'])) {
    $imagen = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $imagen_destino = "../imagenes_posteos/" . $imagen; // Ruta de destino en el servidor
    
    move_uploaded_file($imagen_temp, $imagen_destino);

    $imagen_destino = "imagenes_posteos/" . $imagen;
    
} else {
    echo 'Entro aca     --- --- --   ';
    $imagen = ""; // Si no se cargó ninguna imagen
}


        


        // Actualizar el posteo en la base de datos
        $sql = "UPDATE posteos SET titulo = '$titulo', contenido = '$contenido', imagen_path = '$imagen_destino' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Los cambios se guardaron con éxito.";
            echo'<br>';
            
            echo'<br>';
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
