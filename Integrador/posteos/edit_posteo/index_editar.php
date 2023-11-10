<!DOCTYPE html>
<html>
<head>
    <?php
    include("../../head.php");
    ?>
    <title>LISTA DE POSTEOS</title>


</head>
<body>
    <div class="container">
        <h1>Lista de Posteos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
              // Conexión a la base de datos ... poner en archivo aparte
              require_once('bd.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

                // Consulta para obtener los posteos
                $sql = "SELECT id, titulo, contenido, imagen_path, fecha_publicacion FROM posteos";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["titulo"] . "</td>";
                        echo "<td>" . $row["contenido"] . "</td>";
                        echo "<td>" . $row["imagen_path"] . "</td>";
                        echo "<td><a href='editar_posteo.php?id=" . $row["id"] . "'>Editar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay posteos disponibles.</td></tr>";
                }

                // Cerrar la conexión a la base de datos
                $conn->close();
                ?>
            </tbody>
        </table>
        <a href="nuevo.php" class="btn btn-primary">Crear Nuevo Posteo</a>
    </div>
</body>
</html>
