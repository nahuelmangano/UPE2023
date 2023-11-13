<?php
       // Conectar a la base de datos
       require_once('../../registro/connection_mysql.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['nombre_nuevo']) && isset($_POST['nombre_email'])) {
        $id = $_POST['id'];
        $nombre_nuevo = $_POST['nombre_nuevo'];
        $email_nuevo = $_POST['nombre_email'];

     

        // Actualizar el posteo en la base de datos
        $sql = "UPDATE usuarios SET nombre = '$nombre_nuevo', email = '$email_nuevo' WHERE id = $id";


        $result = $conn->query($sql);

        if ($result) {
            header('Location: edit_ok.php');
            echo "Los cambios se guardaron con éxito.";
            echo '<br>';
            echo '<br>';
            echo '<a href="../prueba.php" class="btn btn-default"> Ir a Posteos</a> ';
        } else {
            echo "Error al guardar los cambios: " . $conn->error;
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    } else {
        echo "Datos faltantes.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>
