<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../../head.php");
    ?>
    <title>Editar Usuario X</title>
    <style>
        body {
            background-color: #d1d5db;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
        }

        img {
            display: block;
            margin: 10px auto;
            max-width: 100%;
            height: auto;
        }

        .custom-file-label::after {
            content: "Seleccionar Archivo";
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Editar contraseña</h1>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            echo $id;

            // Conectar a la base de datos
            require_once('../../registro/connection_mysql.php');


            // Consulta para obtener los detalles del posteo
            $sql = "SELECT id, password  FROM usuarios WHERE id = $id";

            $result = $conn->query($sql);




            if ($result) {
                $row = $result->fetch(PDO::FETCH_ASSOC);

                ?>
                <form method="post" action="guardar_pass.php">
                <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                
                    <div class="form-group">
                        <label>Nueva Contraseña</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Confirmar Contraseña</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                    <a href="../prueba.php" class="btn btn-warning">Posteos</a>
                </form>
                <?php
            } else {
                echo "El usuario no se encontró.";
            }

            // Cerrar la conexión a la base de datos
            $conn = null; // Cerrar la conexión
        } else {
            echo "ID de posteo no proporcionado.";
        }
        ?>
    </div>
</body>

</html>