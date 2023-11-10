<?php
require("../permisos.php");
session_start();


// Verifica si el usuario ha iniciado sesión, de lo contrario, redirige a la página de inicio de sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    include("../head.php");
    ?>
    <title>Panel de usuario</title>

</head>

<body style="background-color: #d1d5db">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../posteos/prueba.php">Pagina de Posteos</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../posteos/prueba.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="../posteos/solo_encontrados.php" class="nav-link">Encontrados</a>
                </li>
                <li class="nav-item">
                    <a href="../posteos/solo_perdido.php" class="nav-link">Perdidos</a>
                </li>
                <li class="nav-item">
                    <a href="../posteos/buscar_posteos.php" class="nav-link">Buscar</a>
                </li>
                <?php
                if (isset($_SESSION['user_id'])) {
                    // Si el usuario ha iniciado sesión, muestra el botón "Log Out".
                    echo '<li>';
                    echo '<a href="logout.php" class="nav-link">Log Out</a>';
                    echo '</li>';

                }
                ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">
                                <?php
                                echo ($_SESSION['user_name']) . "</h5>";
                                echo '<p class="card-text">Correo Electrónico: ' . ($_SESSION['user_email']) . '</p>';
                                ?>



                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <h2>Bienvenido al Panel de Usuario</h2>
                    <p>En este panel, puedes acceder a varias funciones y opciones:</p>
                    <ul>
                        <li><a href="../posteos/edit_user/editar_usuario.php">Editar Perfil</a></li>
                        <li><a href="../posteos/posteo_form.php">Nuevo posteo</a></li>
                        <li><a href="../posteos/prueba.php">Posteos</a></li>
                        <li><a href="../posteos/edit_user/cambiar_contraseña.php">Cambiar Contraseña</a></li>
                        <li><a href="../posteos/mis_posteos.php">Ver Mis Publicaciones</a></li>
                        <li><a href="#">Cerrar Sesión</a></li>
                    </ul>


                    <?php
                    if (Permisos::tienePermiso('panel_admin', $_SESSION['user_id'])) {


                        ?>
                        <h2>Panel de Admin</h2>
                        <ul>
                            <li><a href="../posteos/edit_user/usuarios.php">Ver lista usuarios</a></li>
                            <li> <a href="../posteos/edit_user/usuarios_eliminados.php">Ver lista usuarios
                                    eliminadas</a></li>
                            <li><a href="../posteos/denuncias_post.php">Ver Posteos Denunciados</a></li>
                        </ul>
                        <?php
                    }
                    ?>

                </div>


            </div>
        </div>
    </div>
</body>

</html>