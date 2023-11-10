<?php
session_start();

// Verifica si el usuario ha iniciado sesión, de lo contrario, redirige a la página de inicio de sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<?php
//header
require('../head.php');
?>

<body>
    <div class="container">
        <div class="container">
            <div class="col-md-12">
                <h1>Panel admin
                    <span class="pull-right">


                        <a href="../posteos/posteo_form.php" class="btn btn-warning">Nuevo Posteo</a>
                        <a href="../posteos/prueba.php" class="btn btn-secondary">Posteos</a>
                        <a href="logout.php" class="btn btn-lg btn-primary">
                            <span class="glyphicon glyphicon-plus"></span> Cerrar Sesión</a>
                    </span>
                </h1>
            </div>
            <div class="row">
                <h3>Permisos ADMIN</h3>
                <a href="../posteos/edit_user/usuarios.php" class="btn btn-secondary">Ver lista usuarios</a>
                <br>
                <br>
                <a href="../posteos/edit_user/usuarios_eliminados.php" class="btn btn-secondary">Ver lista usuarios
                    eliminadas</a>
                <br>
                <br>
                <a href="../posteos/denuncias_post.php" class="btn btn-secondary">Ver Posteos Denunciados</a>
            </div>
        </div>

    </div>
</body>

</html>