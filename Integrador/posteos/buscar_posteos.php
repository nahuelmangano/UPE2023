<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="stylesheet" href="../estilos/estilo_busqueda.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <title>Buscar Posteos</title>
</head>

<body style="background-color: #d1d5db">
<?php
    include("navbar.php");
    ?>


<div class="container">

<div class="row height d-flex justify-content-center align-items-center">

  <div class="col-md-8">
  <form method="post" action="buscar_new.php">
    <div class="search">
      
      <input type="text" class="form-control" name="busqueda" placeholder="Buscar posteos">
      <button class="btn btn-primary" value="Buscar">Search</button>
    </div>
  </form>
  <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['busqueda'])) {
                        $busqueda = $_POST['busqueda'];

                        require_once('bd.php');

                        if ($conn->connect_error) {
                            die("Conexión a la base de datos fallida: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM posteos WHERE titulo LIKE '%" . $busqueda . "%'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                           echo "<br>";
                            echo "<ul class='navbar-nav ml-auto'>";
                            while ($row = $result->fetch_assoc()) {
                                // Enlace a la página individual del posteo
                                echo "<li><a  href='unposteo.php?id=" . $row["id"] . "'>" . $row["titulo"] . "</a></li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "No se encontraron resultados.";
                        }

                        $conn->close();
                    } else {
                        echo "Ingresa un término de búsqueda.";
                    }
                }
                ?>
    
  </div>
  
</div>
</div>
</body>