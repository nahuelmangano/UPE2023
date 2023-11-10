<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("../head.php");
    ?>
    <title>Index</title>
    <style>
    .custom-image {
        width: 100%; /* Ajusta el ancho de la imagen al 100% del contenedor */
        height: auto; /* Mantiene la proporción original de la imagen */
    }
</style>

</head>
<body style="background-color: #d1d5db">
<?php
include('navbar.php');
?>

<div class="container mt-5">
   
            <?php
            include('mostrar_posteo.php');
            ?>
        </div>
 

<!-- Agrega las bibliotecas de Bootstrap al final del cuerpo del documento -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
