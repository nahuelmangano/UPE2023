<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../head.php");
    ?>
    <title>Buscar Posteos</title>
</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="buscar_posteos.php">
                    <input type="text" name="busqueda" placeholder="Buscar posteos">
                    <input type="submit" value="Buscar">
                   
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
                            echo "<h2>Resultados de la Búsqueda:</h2>";
                            echo "<ul>";
                            while ($row = $result->fetch_assoc()) {
                                // Enlace a la página individual del posteo
                                echo "<li><a href='unposteo.php?id=" . $row["id"] . "'>" . $row["titulo"] . "</a></li>";
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

</html>
