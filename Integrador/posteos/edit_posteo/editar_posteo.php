<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../../head.php");
    ?>
    <title>Editar Posteo</title>
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
        <h1>Editar Posteo</h1>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Conectar a la base de datos
            require_once('bd.php');

        
            // Consulta para obtener los detalles del posteo
            $sql = "SELECT id, titulo, contenido, imagen_path FROM posteos WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $imagen_actual = $row["imagen_path"]; // Almacena la ruta de la imagen actual
                ?>
                <form action="guardar_edit.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $row["titulo"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="contenido">Contenido:</label>
                        <textarea class="form-control" id="contenido" name="contenido"><?php echo $row["contenido"]; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imagen" name="imagen" accept="image/*">
                            <label class="custom-file-label" for="imagen">Seleccionar Archivo</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <img src="../<?php echo $imagen_actual; ?>" alt="Imagen actual" width="150">
                        <input type="hidden" name="imagen_actual" value="<?php echo $imagen_actual; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
                <?php
            } else {
                echo "El posteo no se encontró.";
            }

            // Cerrar la conexión a la base de datos
            $conn->close();
        } else {
            echo "ID de posteo no proporcionado.";
        }
        ?>
    </div>
</body>

</html>
