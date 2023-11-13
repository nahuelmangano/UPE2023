<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../head.php");
    ?>
    <link rel="stylesheet" type="text/css" href="../estilos/estilos_post.css">
    <title>Mis Posteos</title>


</head>

<body style="background-color: #d1d5db">
    <?php
    require('navbar.php');
    ?>
    <?php

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        // Manejar la situación en la que el usuario no ha iniciado sesión
        // Redireccionar o mostrar un mensaje de error, por ejemplo
    }
    ?>
    <div class="container mt-5 post-container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>Mis Posteos</h1>

                <?php
                // Conectar a la base de datos
                require_once('../registro/connection_mysql.php');

                // Consultar la base de datos para obtener los posteos del usuario actual
                $sql = "SELECT id, titulo, contenido, tipo_post, imagen_path, fecha_publicacion FROM posteos WHERE creador = $user_id";
                $result = $conn->query($sql);

                if ($result) {
                    $counter = 0; // Contador para rastrear el número de posteos en una fila
                
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        if ($counter % 3 == 0) {
                            // Iniciar una nueva fila después de cada tercer posteo
                            echo '<div class="row">';
                        }

                        echo '<div class="col-md-4 mb-3">'; // Tamaño de la columna Bootstrap
                        echo '<div class="card post-card">';
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
                        echo '</div>';

                        // Consultar y mostrar los comentarios
                        $posteo_id = $row["id"];
                        $comentarios_sql = "SELECT comentario, fecha_comentario FROM comentarios WHERE posteo_id = $posteo_id";
                        $comentarios_result = $conn->query($comentarios_sql);

                        if ($comentarios_result) {
                            echo '<div class="card-body comment-section">';
                            echo '<h6 class="card-subtitle mb-2 text-muted">Comentarios:</h6>';
                            while ($comentario = $comentarios_result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<p class="card-text">' . $comentario["comentario"] . '</p>';
                                echo '<p class="card-text"><small class="text-muted">Fecha del Comentario: ' . $comentario["fecha_comentario"] . '</small></p>';
                            }

                            echo '</div>';
                        }

                        if (isset($_SESSION['user_id'])) {
                            // Si el usuario ha iniciado sesión, mostrar el formulario de comentarios
                            echo '<div class="card-body comment-form">';
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

                        echo '</div>';
                        echo '</div>';

                        if ($counter % 3 == 2 || $counter == $result->rowCount() - 1) {
                            // Cerrar la fila después del tercer posteo o al final de los posteos
                            echo '</div>';
                        }

                        $counter++;
                    }
                } else {
                    echo "<h1>No hay post denunciados</h1>";
                }
                ?>

            </div>
        </div>
    </div>
</body>

</html>