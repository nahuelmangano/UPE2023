<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Manejar la situación en la que el usuario no ha iniciado sesión
    // Redireccionar o mostrar un mensaje de error, por ejemplo
}

// Variable para simular si el posteo se creó exitosamente
$posteoCreadoExitosamente = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario y simular la creación exitosa del posteo
    // ...

    // Cambiar la variable a true para simular que el posteo se creó correctamente
    $posteoCreadoExitosamente = true;
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
        <?php if ($posteoCreadoExitosamente): ?>
            <!-- Mostrar mensaje de éxito y botón para volver a la página de inicio -->
            <div class="alert alert-success mt-4" role="alert">
                <h4 class="alert-heading">Posteo creado exitosamente!</h4>
                <p>El posteo se ha creado correctamente.</p>
                <hr>
                <a href="../registro/dashboard.php" class="btn btn-primary">Volver a la página de inicio</a>
            </div>
        <?php else: ?>
            <!-- Formulario para crear un nuevo posteo -->
            <h1 class="mt-5">Crear un nuevo posteo</h1>
            <form action="guardar_posteo.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" class="form-control" name="titulo" required>
                    <small class="text-muted">Debe contener al menos una palabra.</small>
                </div>

                <div class="form-group">
                    <label for="contenido">Contenido:</label>
                    <textarea class="form-control" name="contenido" rows="4" required></textarea>
                    <small class="text-muted">Debe contener al menos una palabra.</small>
                </div>
                <br>

                <div>
                    <select class="form-select" id="tipo_posteo" name="tipo_posteo" aria-label="Default select example" required>
                        <option value="" selected disabled hidden>Seleccione un tipo de posteo</option>
                        <option value="perdido">Perdido</option>
                        <option value="encontrado">Encontrado</option>
                    </select>
                    <small class="text-muted">Seleccione un tipo de posteo.</small>
                </div>
                <br>

                <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <input type="file" class="form-control-file" name="imagen" accept="image/*" required>
                    <small class="text-muted">Seleccione una imagen.</small>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
