<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("../head.php");
    ?>
    <title>Denuncias Posts</title>
</head>
<body style="background-color: #d1d5db">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>POST DENUNCIADOS</h3>
                <a href="../registro/dashboard.php" class="btn btn-primary">Panel de usuario</a>
                <br>
                <br>
                <?php
                  // Conectar a la base de datos
            require_once('../registro/connection_mysql.php');

                // Manejar el formulario de actualización del estado
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $postId = $_POST["post_id"];
                    $newState = $_POST["estado"];

                    // Actualizar el estado en la tabla t_denuncia
                    $updateSql = "UPDATE t_denuncias SET estado = :estado WHERE posteo_id = :post_id";
                    $stmt = $conn->prepare($updateSql);
                    $stmt->bindParam(':estado', $newState, PDO::PARAM_STR);
                    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
                    $stmt->execute();
                }

                // Consultar los posteos desde la base de datos
                $sql = "SELECT p.id, p.titulo, p.contenido, d.estado
                        FROM posteos p
                        JOIN t_denuncias d ON p.id = d.posteo_id
                        WHERE p.denuncia = 1";

                $result = $conn->query($sql);

                if ($result) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="card mb-3" style="font-size: 14px;">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">ID: ' . $row["id"] . '</h5>';
                        echo '<p class="card-text">Titulo: ' . $row["titulo"] . '</p>';
                        echo '<p class="card-text">Descripcion: ' . $row["contenido"] . '</p>';
                        echo '<p class="card-text">Estado de denuncia: ' . $row["estado"] . '</p>';
                        
                        // Formulario para actualizar el estado de la denuncia
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="post_id" value="' . $row["id"] . '">';
                        echo '<label for="estado">Cambiar estado:</label>';
                        echo '<select name="estado" id="estado">';
                        echo '<option value="Pendiente" selected>Pendiente</option>';
                        echo '<option value="Aprobada">Aprobada</option>';
                        echo '<option value="Rechazada">Rechazada</option>';
                        echo '</select>';
                        echo '<button type="submit" >Actualizar Estado</button>';
                        echo '</form>';
                        echo '</br>';
                        
                        echo "<a class='btn btn-danger' href='edit_posteo/eliminar_post.php?id=" . $row["id"] . "'>Eliminar</a>";
                        echo " ";
                        echo "<a class='btn btn-success' href='edit_user/liberar_post.php?id=" . $row["id"] . "'>Liberar</a>";
                        echo " ";
                        echo "<a class='btn btn-warning' href='unposteo.php?id=" . $row["id"] . "'> Ver Posteo  </a>";
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<h1>No hay post denunciados</h1>";
                }

                $conn = null; // Cerrar la conexión
                ?>
            </div>
        </div>
    </div>
</body>
</html>
