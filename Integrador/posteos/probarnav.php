<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../head.php");
    ?>
    <title>Document</title>
</head>

<body>
    <?php
    include("navbar.php");
    ?>
  <div class="container mt-5"> <!-- Agrega margen superior para separar la barra de navegación -->
    <div class="row justify-content-center"> <!-- Centra los elementos en el centro de la página -->
        <div class="col-md-8"> <!-- Tamaño del contenedor de los posteos -->
            
            <?php
            include('mostrar_posteo.php');
            ?>
        </div>
    </div>
</div>

</body>

</html>