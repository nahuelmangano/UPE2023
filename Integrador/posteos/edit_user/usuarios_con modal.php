<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("../../head.php");
    ?>
    <title>Usuarios</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>USUARIOS</h1>
                <a href="../../registro/dashboard.php" class="btn btn-primary">Panel de usuario</a>
                <br>
                <br>

                <?php
                // Conectar a la base de datos
                require_once('../bd.php');

                // Consultar los usuarios desde la base de datos
                $sql = "SELECT id, nombre, email FROM usuarios WHERE activo = 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card mb-3" style="font-size: 14px;">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">ID: ' . $row["id"] . '</h5>';
                        echo '<p class="card-text">Nombre: ' . $row["nombre"] . '</p>';
                        echo '<p class="card-text">Email: ' . $row["email"] . '</p>';
                        echo '<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete" data-id="' . $row['id'] . '">Eliminar</a>';
                        echo " ";
                        echo '<a href="blanqueo_contraseña.php?id=' . $row['id'] . '" class="btn btn-warning">Blanquear Clave</a>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación para eliminar -->
    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar a este usuario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="#" class="btn btn-danger" id="confirmDeleteButton">Sí</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).on("click", ".btn-danger", function () {
            var userId = $(this).data('id');
            $("#confirmDeleteButton").attr("href", "eliminar_user.php?id=" + userId + "&confirmar=0");
        });
    </script>
</body>
</html>
