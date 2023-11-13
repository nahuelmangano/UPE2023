
<h1>HOLA</h1>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['new_password'])&& isset($_POST['confirm_password'])) {
     $user_id = $_POST['id'];
       
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        echo $user_id;

        // Validar que la nueva contraseña tenga al menos 4 caracteres.
        if (strlen($new_password) < 4) {
            echo "La nueva contraseña debe tener al menos 4 caracteres.";
        } else {
            // Validar que las contraseñas coincidan.
            if ($new_password === $confirm_password) {
                // Verificar la contraseña actual con la contraseña almacenada en tu base de datos.
                require_once('../../registro/connection_mysql.php'); // Asegúrate de que esta línea esté en la ubicación correcta
          

            
                    // La contraseña actual es válida.
                    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                    $update_sql = "UPDATE usuarios SET password = :hashed_password WHERE id = :user_id";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bindParam(':hashed_password', $hashed_password);
                    $update_stmt->bindParam(':user_id', $user_id);

                    if ($update_stmt->execute()) {
                        echo "Contraseña actualizada con éxito.";
                        header('Location: edit_ok.php');
                    } else {
                        echo "Error al actualizar la contraseña.";
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