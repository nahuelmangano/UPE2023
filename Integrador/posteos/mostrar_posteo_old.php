<?php
//conexion bd
require_once('../registro/connection_mysql.php');

// Consultar y mostrar los posteos
$sql = "SELECT id, titulo, contenido, tipo_post, imagen_path, fecha_publicacion FROM posteos WHERE activo = 1 ORDER BY tipo_post";
$result = $conn->query($sql);

if ($result) {
    //solo se muestre el título "PERDIDOS" una vez y el título "ENCONTRADOS" una vez
    $perdidos_mostrados = false;
    $encontrados_mostrados = false;

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($row["tipo_post"] === 'perdido' && !$perdidos_mostrados) {

            echo '<h3>PERDIDOS</h3>';
            $perdidos_mostrados = true;
        } elseif ($row["tipo_post"] === 'encontrado' && !$encontrados_mostrados) {

            echo '<h3>ENCONTRADOS</h3>';
            $encontrados_mostrados = true;
        }

        echo '<div class="card mb-3" style="font-size: 14px; ">';
        echo '<h5 class="card-title">' . $row["titulo"] . '</h5>';


        echo '<div class="card-body">';

        echo '<p class="card-text">' . $row["tipo_post"] . '</p>';
        echo '<p class="card-text">' . $row["contenido"] . '</p>';
        if (!empty($row["imagen_path"])) {
            echo '<img src="' . $row["imagen_path"] . '" class="card-img-top full-width-img"" style="width: 400px;" alt="Imagen del posteo">';
        }
        echo '<p class="card-text"><small class="text-muted">Fecha de Publicación: ' . $row["fecha_publicacion"] . '</small></p>';

        //botones

        require('botones_posts.php');


        // Consultar y mostrar los comentarios
        $posteo_id = $row["id"];

        $comentarios_sql = "SELECT comentario, fecha_comentario FROM comentarios WHERE posteo_id = $posteo_id";
        $comentarios_result = $conn->query($comentarios_sql);

        if ($comentarios_result) {
            echo '<div class="card-body">';
            echo '<h6 class="card-subtitle mb-2 text-muted">Comentarios:</h6>';
            while ($comentario = $comentarios_result->fetch(PDO::FETCH_ASSOC)) {
                echo '<p class="card-text">' . $comentario["comentario"] . '</p>';
                echo '<p class="card-text"><small class="text-muted">Fecha del Comentario: ' . $comentario["fecha_comentario"] . '</small></p>';
            }
            echo '</div>';
            echo '</div>';
            
        }


        if (isset($_SESSION['user_id'])) {
            // Si el usuario ha iniciado sesión, muestro .


            // Mostrar formulario de comentarios
            echo '<div class="card">';
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
            echo '</div>';

        }
        echo '</div>';
    }
} else {
    echo "Error en la consulta de posteos.";
}

$conn = null; // Cerrar la conexión
?>