<?php
session_start();

// Verifica si el usuario ha iniciado sesión, de lo contrario, redirige a la página de inicio de sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("../../head.php");
    ?>
    <title>Editar Usuario</title>
</head>
<body style="background-color: #d1d5db">

    <?php

    // Incluir archivo de conexión a la base de datos
    require('../../registro/connection_mysql.php');

    // Comprobar si el formulario se ha enviado
    if (isset($_POST['submit'])) {
        $newName = $_POST['newName'];
        $newEmail = $_POST['newEmail'];
        $userId = $_SESSION['user_id']; // Supongo que ya tienes el ID del usuario

        echo $userId;

        // Actualizar el nombre y el correo electrónico en la base de datos
        $updateQuery = "UPDATE usuarios SET nombre = :name, email = :email WHERE id = :id";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bindParam(':name', $newName);
        $stmt->bindParam(':email', $newEmail);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        // Puedes agregar manejo de errores aquí

        // Redirigir al usuario a la página de perfil o donde desees
        //header('Location: usuarios.php');
    }

    ?>
 <div class="container">
    <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
        <h2>Editar Usuario</h2>
        <form method="post" action="editar_usuario.php">
            <div class="form-group">
            <label for="newName">Nuevo Nombre:</label>
                <input type="text" name="newName" id="newName" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="newEmail">Nuevo Correo Electrónico:</label>
                <input type="email"  name="newEmail" id="newEmail" class="form-control" required>
            </div>
           
            <br>
            <button type="submit" name="submit" class="btn btn-primary">Guardar cambios</button>
           
            <a href="../prueba.php" class="btn btn-warning">Posteos</a>
        </form>
        </div>
        </div>
        </div>
        </div>
        </div>
    </div>
</body>
</html>

