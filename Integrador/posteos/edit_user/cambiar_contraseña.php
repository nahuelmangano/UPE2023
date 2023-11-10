<?php
session_start();

// Verifica si el usuario ha iniciado sesión, de lo contrario, redirige a la página de inicio de sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../registro/login.php');
    exit();
}
?>
<?php


if (isset($_SESSION['user_id'])) {
    if (isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $user_id = $_SESSION['user_id'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Validar que la nueva contraseña tenga al menos 4 caracteres.
        if (strlen($new_password) < 4) {
            echo "La nueva contraseña debe tener al menos 4 caracteres.";
        } else {
            // Validar que las contraseñas coincidan.
            if ($new_password === $confirm_password) {
                // Verificar la contraseña actual con la contraseña almacenada en tu base de datos.
                require_once('../../registro/connection_mysql.php'); // Asegúrate de que esta línea esté en la ubicación correcta
                $sql = "SELECT password FROM usuarios WHERE id = :user_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                $row = $stmt->fetch();

                if ($row && password_verify($current_password, $row['password'])) {
                    // La contraseña actual es válida.
                    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                    $update_sql = "UPDATE usuarios SET password = :hashed_password WHERE id = :user_id";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bindParam(':hashed_password', $hashed_password);
                    $update_stmt->bindParam(':user_id', $user_id);

                    if ($update_stmt->execute()) {
                        echo "Contraseña actualizada con éxito.";
                    } else {
                        echo "Error al actualizar la contraseña.";
                    }
                } else {
                    echo "La contraseña actual no es válida.";
                }
            } else {
                echo "Las contraseñas no coinciden.";
            }
        }
    } else {
      
    }
} else {
    echo "El usuario no está autenticado.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php
    include("../../head.php");
    ?>
    <title>Cambiar Contraseña</title>


</head>
<body style="background-color: #d1d5db">
    <div class="container">
    <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
        <h2>Cambiar Contraseña</h2>
        <form method="post" action="cambiar_contraseña.php">
            <div class="form-group">
                <label>Contraseña Actual</label>
                <input type="password" name="current_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nueva Contraseña</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Confirmar Contraseña</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
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






