<!DOCTYPE html>
<html>
<head>
    <?php
    include("../../head.php");
    ?>
    <title>Editar Posteo</title>


</head>
<body>
    <div class="container">
        <h1>Editar Posteo</h1>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Conectar a la base de datos
            require_once('bd.php');

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Consulta para obtener los detalles del posteo
            $sql = "SELECT id, titulo, contenido, imagen_path FROM posteos WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
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
                        <input type="file" class="form-control-file" name="imagen" accept="image/*">
                       
                    </div>
                    <div class="form-group">
          
                        <img src="../<?php echo $row["imagen_path"]; ?>" alt="Imagen actual" width="150">
                        <h1>es <?php echo $row["imagen_path"]; ?></h1>
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
