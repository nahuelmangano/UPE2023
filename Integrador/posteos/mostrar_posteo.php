<?php
//conexion bd
require_once('../registro/connection_mysql.php');

// Consultar y mostrar los posteos sin ordenar
$sql = "SELECT id, titulo, contenido, tipo_post, imagen_path, fecha_publicacion FROM posteos WHERE activo = 1";
$result = $conn->query($sql);

if ($result) {
    echo '<div class="container mt-5">';
    echo '<div class="row row-cols-1 row-cols-md-3 g-4">'; // Contenedor de las tarjetas

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="col mb-3">'; // Columna Bootstrap con margen inferior
        echo '<div class="card" style="font-size: 14px; height: 100%;">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row["titulo"] . '</h5>';
        echo '<p class="card-text">' . $row["tipo_post"] . '</p>';
        echo '<p class="card-text">' . $row["contenido"] . '</p>';

        if (!empty($row["imagen_path"])) {
            echo '<img src="' . $row["imagen_path"] . '" class="card-img-top  post-image" " alt="Imagen del posteo">';
        
        }

        echo '<p class="card-text"><small class="text-muted">Fecha de Publicación: ' . $row["fecha_publicacion"] . '</small></p>';
         // Botones
         require('botones_posts copy.php');
        echo '</div>';

      

        // Consultar y mostrar los comentarios
        $posteo_id = $row["id"];
        $comentarios_sql = "SELECT comentario, fecha_comentario FROM comentarios WHERE posteo_id = $posteo_id";
        $comentarios_result = $conn->query($comentarios_sql);

        if ($comentarios_result) {
            echo '<div class="card-body" style="max-height: 100px; overflow-y: auto;">'; // Establecer altura máxima y desplazamiento vertical
            echo '<h6 class="card-subtitle mb-2 text-muted">Comentarios:</h6>';

            while ($comentario = $comentarios_result->fetch(PDO::FETCH_ASSOC)) {
                echo '<p class="card-text">' . $comentario["comentario"] . '</p>';
                echo '<p class="card-text"><small class="text-muted">Fecha del Comentario: ' . $comentario["fecha_comentario"] . '</small></p>';
            }
             // Botones
             require('botones_posts.php');
            echo '</div>';
        }

        if (isset($_SESSION['user_id'])) {
            // Si el usuario ha iniciado sesión, mostrar el formulario de comentarios
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Agregar un Comentario</h5>';
            echo '<form action="guardar_comentario.php" method="post">';
            echo '<input type="hidden" name="posteo_id" value="' . $row['id'] . '">';
            echo '<div class="form-group">';
            echo '<label for="comentario">Comentario:</label>';
            echo '<textarea class="form-control" name="comentario" rows="2" required></textarea>';
            echo '</div>';
            echo '<br>';
            echo '<button type="submit" class="btn btn-primary">Enviar Comentario</button>';
            echo '</form>';
            echo '</div>';
        }

        echo '</div>'; // Cierre de la tarjeta
        echo '</div>'; // Cierre de la columna
    }

    echo '</div>'; // Cierre del contenedor de tarjetas
    echo '</div>'; // Cierre del contenedor principal
} else {
    echo "Error en la consulta de posteos.";
}

$conn = null; // Cerrar la conexión
?>
