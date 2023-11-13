<?php
require_once('connection_mysql.php');

$errors = []; // Array para almacenar mensajes de error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar campos vacíos
    if (empty($_POST['nombre'])) {
        $errors[] = "El campo Usuario es obligatorio.";
    }

    if (empty($_POST['email'])) {
        $errors[] = "El campo Correo Electrónico es obligatorio.";
    }

    if (empty($_POST['password'])) {
        $errors[] = "El campo Contraseña es obligatorio.";
    }

    // Validar formato de correo electrónico
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El formato del correo electrónico no es válido.";
    }

    // Validar contraseña (al menos una letra y un número)
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).+$/', $_POST['password'])) {
        $errors[] = "La contraseña debe contener al menos una letra y un número.";
    }

    // Validar si el correo electrónico ya existe en la base de datos
    $existingEmail = $_POST['email'];
    $stmt = $conn->prepare("SELECT email FROM usuarios WHERE email = ?");
    $stmt->execute([$existingEmail]);

    if ($stmt->fetchColumn()) {
        $errors[] = "El correo electrónico ya está registrado.";
    }

    // Si no hay errores, proceder con la inserción en la base de datos
    if (empty($errors)) {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $email, $password]);

        header('Location: login.php');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php
    include("../head.php");
    ?>
    <title>Registrarse</title>
</head>
<body>
    <div class="container">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h2>Registro de Usuario</h2>
                            <!-- Mostrar mensajes de error si los hay -->
                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php foreach ($errors as $error) : ?>
                                            <li><?php echo $error; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <form method="post" action="registro.php">
                                <div class="form-group">
                                    <label>Usuario</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Registrarse</button>
                                <a href="../posteos/prueba.php" class="btn btn-warning">Posteos</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
