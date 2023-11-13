<!DOCTYPE html>
<html lang="en">

<head>
<?php
    include("../head.php");
    ?>
    <link rel="stylesheet" type="text/css" href="../estilos/estilos_post.css">
    
    <title>Perdidos</title>
   
</head>

<body style="background-color: #d1d5db">
    <?php
    require('navbar.php');
    ?>
    <div class="container mt-5">
        <div class="row">
            <?php
            //conexion bd
            require_once('../registro/connection_mysql.php');

            // Consultar y mostrar los posteos
            $sql = "SELECT id, titulo, contenido, tipo_post, imagen_path, fecha_publicacion FROM posteos WHERE activo = 1 AND  tipo_post= 'perdido'";
            $result = $conn->query($sql);

            if ($result) {
                $count = 0; // Contador para controlar el número de posteos por fila

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    if ($count % 3 == 0) {
                        // Comienza una nueva fila después de cada 3 posteos
                        echo '</div><div class="row">';
                    }

                    echo '<div class="col-md-4">';
                    echo '<div class="post-container card mb-3" style="font-size: 14px; ">';
                    echo '<h5 class="card-title">' . $row["titulo"] . '</h5>';
                    echo '<br>';
                    if (!empty($row["imagen_path"])) {
                        echo '<img src="' . $row["imagen_path"] . '" class="card-img-top post-image" alt="Imagen del posteo">';
                    }
                    echo '<div class="card-body">';
                    echo '<p class="card-text">' . $row["tipo_post"] . '</p>';
                    echo '<p class="card-text">' . $row["contenido"] . '</p>';
                    echo '<p class="card-text"><small class="text-muted">Fecha de Publicación: ' . $row["fecha_publicacion"] . '</small></p>';

                    // Botones
                    require('botones_posts.php');

                    // Consultar y mostrar los comentarios
                    $posteo_id = $row["id"];
                    $comentarios_sql = "SELECT comentario, fecha_comentario FROM comentarios WHERE posteo_id = $posteo_id";
                    $comentarios_result = $conn->query($comentarios_sql);

                    if ($comentarios_result) {
                        echo '<div class="comment-section card-body">';
                        echo '<h6 class="card-subtitle mb-2 text-muted">Comentarios:</h6>';
                        while ($comentario = $comentarios_result->fetch(PDO::FETCH_ASSOC)) {
                            echo '<p class="card-text">' . $comentario["comentario"] . '</p>';
                            echo '<p class="card-text"><small class="text-muted">Fecha del Comentario: ' . $comentario["fecha_comentario"] . '</small></p>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }

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
                    echo '</div>';
                    echo '</div>';

                    $count++;
                }
            } else {
                echo "Error en la consulta de posteos.";
            }

            $conn = null; // Cerrar la conexión
            ?>
        </div>
    </div>
</body>

</html>
