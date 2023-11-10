<?php
session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
} else {
    // Manejar la situación en la que el usuario no ha iniciado sesión
    // Redireccionar o mostrar un mensaje de error, por ejemplo
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    include("../head.php");
    ?>
    <title>Formulario de posteos</title>


</head>
<body style="background-color: #d1d5db">
    <div class="container">
        <h1 class="mt-5">Crear un nuevo posteo</h1>
        <h2>
            <?php
            echo $_SESSION['user_id'];
            ?>
        </h2>
        <form action="guardar_posteo.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" name="titulo" required>
            </div>

            <div class="form-group">
                <label for="contenido">Contenido:</label>
                <textarea class="form-control" name="contenido" rows="4" required></textarea>
            </div>
            <br>
            <div>
            <select class="form-select" id="tipo_posteo" name="tipo_posteo" aria-label="Default select example">
               <option selected >Tipo de Posteo</option>
               <option value="perdido">Perdido</option>
               <option value="encontrado">Encontrado</option>
               
             </select>
             </div>
             <br>

            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" class="form-control-file" name="imagen" accept="image/*">
            </div>
           
            <br>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="../registro/dashboard.php" class="btn btn-warning">Volver a Panel de control</a>
        </form>
    </div>
</body>
</html>

