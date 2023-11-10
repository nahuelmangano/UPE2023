<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("../../head.php");
    ?>
    <title>Blanquear Contraseña</title>
</head>
<body style="background-color: #d1d5db;">

    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <h2>Blanquear Contraseña</h2>
                        <form method="post" action="blanqueo_contraseña.php?id=<?php echo $user_id; ?>">
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
                            <a href="../posteos/prueba.php" class="btn btn-warning">Posteos</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
