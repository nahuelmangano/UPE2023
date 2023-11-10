<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("../../head.php");
    ?>
    <title>Eliminar Usuario</title>
    <style>
        body {
            background-color: #d1d5db;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 400px;
            text-align: center;
            padding: 20px;
        }

        .confirmation-buttons a {
            margin: 0 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h1>Eliminar Usuario</h1>

        <?php
        // Conectar a la base de datos
        require_once('../bd.php');

        if (isset($_GET['id'])) {
            $id_user = $_GET['id'];

            echo '<p>¿Estás seguro de que deseas eliminar este usuario?</p>';
            echo $id_user;
            echo '<div class="confirmation-buttons">';
            echo '<a href="eliminar_user.php?id=' . $id_user . '&confirmar=0" class="btn btn-danger">Sí</a>';
            echo '<a href="../prueba.php" class="btn btn-secondary">No</a>';
            echo '</div>';

            if (isset($_GET['confirmar']) && $_GET['confirmar'] == 0) {

                // Consulta SQL para marcar el usuario como eliminado
                $sql = "UPDATE usuarios SET activo = 0 WHERE id = $id_user";

                if ($conn->query($sql) === TRUE) {
                    echo "<p>El usuario ha sido eliminado lógicamente.</p>";
                    echo '<a href="../prueba.php" class="btn btn-primary">Volver a Posteos</a>';
                } else {
                    echo "<p>Error al eliminar el usuario: " . $conn->error . "</p>";
                }

                // Cierra la conexión a la base de datos
                $conn->close();
            }
        } else {
            echo "<p>ID de usuario no proporcionado.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
