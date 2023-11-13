<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../../head.php"); ?>
    <title>Cambios Guardados</title>
    <style>
        body {
            background-color: #d1d5db;
            text-align: center;
            padding: 50px;
        }

        .success-message {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Cambios Guardados</h1>

        <div class="success-message">
            <p>Los cambios se han guardado con éxito.</p>
        </div>

        <a href="../prueba.php" class="btn btn-primary">Posteos</a>
    </div>
</body>

</html>
