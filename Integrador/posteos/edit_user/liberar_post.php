<!DOCTYPE html>
<html>
<head>
    <?php
    include("../../head.php");
    ?>
    <title>Liberar Post</title>
</head>

<body>
<div class="container mt-5"> <!-- Agrega margen superior para separar la barra de navegación -->
    <div class="row justify-content-center"> <!-- Centra los elementos en el centro de la página -->
        <div class="col-md-8"> <!-- Tamaño del contenedor de los posteos -->
    <h1>Liberar Posteo</h1>

    <?php
    // Conectar a la base de datos
    require_once('../bd.php');
    if (isset($_GET['id'])) {
        $id_posteo = $_GET['id'];

        echo '<p>¿Estás seguro de que deseas liberar este posteo?</p>';
        echo $id_posteo;
        echo "<br>";
        echo "<br>";
        echo '<a href="liberar_post.php?id=' . $id_posteo . '&confirmar=0" class="btn btn-success">Sí</a>  <a href="../prueba.php"class="btn btn-danger">No</a>';

        if (isset($_GET['confirmar']) && $_GET['confirmar'] == 0) {


            // Consulta SQL para marcar el posteo como eliminado
            $sql = "UPDATE posteos SET denuncia = 0 WHERE id = $id_posteo";

            if ($conn->query($sql) === TRUE) {
                header('Location: liberada.php');

            } else {
                echo "Error al liberar el posteo: " . $conn->error;
            }

            // Cierra la conexión a la base de datos
            $conn->close();
        }
    } else {
        echo "ID de posteo no proporcionado.";
    }
    ?>
        </div>
    </div>
</div>

</body>

</html>