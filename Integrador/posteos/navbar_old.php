<nav class="navbar navbar-light" style="background-color: #F1EA7A;">

    <h3>PAGINA DE POSTEOS</h3>
    <?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        // Si el usuario ha iniciado sesión, muestra el botón "Log Out".
        echo '<a href="../registro/logout.php" class="btn btn-danger">Log Out</a>';
        echo '<a href="../registro/dashboard.php" class="btn btn-warning">Panel de usuario</a>';
    } else {
        // Si el usuario no ha iniciado sesión, muestra el botón "Log In".
        echo '<a href="../registro/login.php" class="btn btn-primary">Log in</a>';
        echo '<a href="../registro/registro.php" class="btn btn-info">Registrarse</a>';
    }
    ?>

    <a href="solo_encontrados.php" class="btn btn-warning">ENCONTRADOS</a>
    <a href="solo_perdido.php" class="btn btn-warning">PERDIDOS</a>
    <a href="buscar_posteos.php" class="btn btn-warning">Buscar</a>
    </div>
</nav>