<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("../head.php");
    ?>
    <title>Denuncias Posts</title>


</head>
<body style="background-color: #d1d5db">
<div class="container mt-5"> <!-- Agrega margen superior para separar la barra de navegación -->
    <div class="row justify-content-center"> <!-- Centra los elementos en el centro de la página -->
        <div class="col-md-8"> <!-- Tamaño del contenedor de los posteos -->
    
<h3>POST DENUNCIADOS</h3>
<a href="../registro/dashboard.php" class="btn btn-primary">Panel de usuario</a>
<br>
<br>
<?php
//conecto a la base
require_once('bd.php');


// Consultar los posteos desde la base de datos
$sql = "SELECT id, titulo, contenido FROM posteos WHERE denuncia = 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card mb-3" style="font-size: 14px; ">'; // Agrega el estilo a la tarjeta
     
        echo '<div class="card-body">';
        echo '<h5 class="card-title">ID: ' . $row["id"] . '</h5>';
        echo '<p class="card-text"> Titulo: ' . $row["titulo"] . '</p>';
        echo '<p class="card-text">Descripcion: ' . $row["contenido"] . '</p>';
        echo "<a class='btn btn-danger' href='edit_posteo/eliminar_post.php?id=" . $row["id"] . "'>Eliminar</a>";
        echo " ";
        echo "<a class='btn btn-success' href='edit_user/liberar_post.php?id=" . $row["id"] . "'>Liberar</a>";
        echo " ";
        echo "<a class='btn btn-warning' href='unposteo.php?id=" . $row["id"] . "'> Ver Posteo  </a>";
        
        //corto para poner botones
        ?>

        
      
       <?php
       //sigue aca
        echo '</div>';
    }
}
else{
    echo "<h1>No hay post denunciados</h1>";
}
?>

    
        </div>
    </div>
</div>

</body>
</html>
