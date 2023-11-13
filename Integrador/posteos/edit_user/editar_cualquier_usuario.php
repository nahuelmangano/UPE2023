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
        <h1>Editar Usuariooo</h1>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            echo $id;

            // Conectar a la base de datos
            require_once('../../registro/connection_mysql.php');

        
            // Consulta para obtener los detalles del posteo
            $sql = "SELECT id, nombre, email  FROM usuarios WHERE id = $id";
            
            $result = $conn->query($sql);
        
             
          

            if ($result) {
                $row = $result->fetch(PDO::FETCH_ASSOC);             
                
                ?>
                <form action="guardar_edit_user.php" method="post" >
                    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                    <div class="form-group">
                        <label for="nombre_nuevo">Nombre nuevo:</label>
                        <input type="text" class="form-control" id="nombre_nuevo" name="nombre_nuevo" value="<?php echo $row["nombre"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nombre_email">Email nuevo:</label>
                        <input type="text" class="form-control" id="nombre_email" name="nombre_email" value="<?php echo $row["email"]; ?>">
                    </div>
                   
                   
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
