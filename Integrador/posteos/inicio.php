<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../head.php"); ?>
    <title>Panel de Usuario</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Bienvenido al Panel de Usuario</h2>

                <!-- Mostrar información del usuario si está disponible -->

                <h3>Acciones:</h3>
                <div class="d-grid gap-2">
                    <a href="crear_posteo.php" class="btn btn-primary">Crear Nuevo Posteo</a>
                    <a href="ver_posteos.php" class="btn btn-info">Ver Posteos</a>
                    <!-- Agrega más botones según sea necesario -->
                </div>
            </div>
        </div>
    </div>

    <!-- Agrega las bibliotecas de Bootstrap al final del cuerpo del documento -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
