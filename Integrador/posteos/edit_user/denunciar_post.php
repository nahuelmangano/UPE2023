<!DOCTYPE html>
<html lang="en">

<head>
    <title>Denunciar Posteo</title>
    <?php include("../../head.php"); ?>
    <style>
        body {
            background-color: #d1d5db;
        }

        .container {
            margin-top: 5%;
        }

        .confirmation-box {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-success {
            margin-right: 5px;
            /* Agrega un margen derecho al botón "Sí" */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="confirmation-box">
                    <h1>Denunciar Posteo</h1>

                    <?php
                    // Conectar a la base de datos
                    require_once('../../registro/connection_mysql.php');

                    if (isset($_GET['id'])) {
                        $id_posteo = $_GET['id'];

                        echo '<p>¿Estás seguro de que deseas denunciar este posteo?</p>';
                        echo $id_posteo;
                        echo '<br>';
                        echo '<br>';
                        echo '<a href="denunciar_post.php?id=' . $id_posteo . '&confirmar=1" class="btn btn-success">Sí</a>';
                        echo '<a href="../prueba.php" class="btn btn-danger">No</a>';

                        if (isset($_GET['confirmar']) && $_GET['confirmar'] == 1) {
                            // Consulta SQL para marcar el posteo como denunciado
                            $sql = "UPDATE posteos SET denuncia = 1 WHERE id = $id_posteo";
                
                            $result = $conn->query($sql);

                            if ($result) {
                                             // $insertSql = "INSERT INTO t_denuncias posteo_id VALUES (id_posteo)";
                            $stmt = $conn->prepare("INSERT INTO t_denuncias (posteo_id) VALUES (?)");
                            $stmt->execute([$id_posteo]);
                            
                                header('Location: ../prueba.php');
                            } else {
                                echo "Error al denunciar el posteo: " . $conn->error;
                            }

                            $conn = null; // Cerrar la conexión
                        }
                    } else {
                        echo "ID de posteo no proporcionado.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>