<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("../../head.php");
    ?>
    <title>Usuarios</title>
</head>

<body style="background-color: #d1d5db">

<div class="container mt-5"> <!-- Agrega margen superior para separar la barra de navegación -->
    <div class="row justify-content-center"> <!-- Centra los elementos en el centro de la página -->
        <div class="col-md-8"> <!-- Tamaño del contenedor de los posteos -->
            <h1>USUARIOS</h1>
            <a href="../../registro/dashboard.php" class="btn btn-primary">Panel de usuario</a>
            <br>
            <br>

            <?php
            //conecto a la base
            require_once('../bd.php');

            // Consultar los posteos desde la base de datos
            $sql = "SELECT id, nombre, email FROM usuarios WHERE activo = 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card mb-3" style="font-size: 14px;">'; // Agrega el estilo a la tarjeta
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">ID: ' . $row["id"] . '</h5>';
                    echo '<p class="card-text"> Nombre: ' . $row["nombre"] . '</p>';
                    echo '<p class="card-text">Email: ' . $row["email"] . '</p>';
                    echo '<a href="eliminar_user.php?id=' . $row['id'] . '"class="btn btn-danger">Eliminar </a>';
                    echo " ";
                    echo '<a href="blanqueo_contraseña.php?id=' . $row['id'] . '"class="btn btn-warning">Blanquear Clave</a>';
                    echo " ";
                    echo '<a href="editar_cualquier_usuario.php?id=' . $row['id'] . '"class="btn btn-warning">Editar datos Usuario</a>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</div>

</body>

</html>
