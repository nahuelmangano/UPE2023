<?php
require_once('connection_mysql.php');
session_start();

$error = ''; // Variable para almacenar el mensaje de error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_email'] = $user['email'];
        header('Location: dashboard.php'); // Redirige a la página de inicio de sesión exitosa
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("../head.php");
    ?>
    <title>Log In</title>
</head>
<body>
    <div class="container">
        <section class="vh-100" style="background-color: #508bfc;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <h3 class="mb-5">Iniciar Sesión</h3>

                                <!-- Mostrar mensaje de error si existe -->
                                <?php if ($error !== ''): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>

                                <form method="post" action="login.php">
                                    <div class="form-group">
                                        <div class="form-outline mb-4">
                                            <input type="email" id="typeEmailX-2" name="email" class="form-control form-control-lg" required />
                                            <label class="form-label" for="typeEmailX-2">Correo Electrónico</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" required />
                                            <label class="form-label" for="typePasswordX-2">Contraseña</label>
                                        </div>

                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Iniciar Sesión</button>

                                        <hr class="my-4">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
