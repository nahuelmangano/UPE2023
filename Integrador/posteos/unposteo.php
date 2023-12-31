<!DOCTYPE html>
<html>

<head>
    <?php
    include("../head.php");
    ?>
     <link rel="stylesheet" type="text/css" href="../estilos/estilos_post.css">
   
    <title>Posteo X</title>


</head>

<body>
<?php
require('navbar.php');
?>
 <div class="container mt-5">
        <div class="row">
    <h1> Posteo</h1>
  

    <?php
    // Conectar a la base de datos
    require_once('../registro/connection_mysql.php');
    if (isset($_GET['id'])) {
        $id_posteo = $_GET['id'];

    
        $sql = "SELECT id, titulo, contenido, tipo_post, imagen_path, fecha_publicacion FROM posteos WHERE id = $id_posteo";

       
        $result = $conn->query($sql);

        if ($result) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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
            echo '<div class="card-body">';
            echo '<h6 class="card-subtitle mb-2 text-muted">Comentarios:</h6>';
            while ($comentario = $comentarios_result->fetch(PDO::FETCH_ASSOC)) {
                echo '<p class="card-text">' . $comentario["comentario"] . '</p>';
                echo '<p class="card-text"><small class="text-muted">Fecha del Comentario: ' . $comentario["fecha_comentario"] . '</small></p>';
            }
           
            echo '</div>';
            echo '</div>';
        }
            }
        } else {
            echo "<h1>No hay post denunciados</h1>";
        }
    }
    ?>




</div>
</div>
</body>

</html>