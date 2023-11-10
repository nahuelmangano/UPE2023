<?php
if (isset($_SESSION['user_id'])) {
    echo '<div class="d-flex justify-content-between">';
    echo "<a href='edit_posteo/editar_posteo.php?id=" . $row["id"] . "' class='btn btn-primary'>Editar</a>";
    echo "<a href='edit_posteo/eliminar_post.php?id=" . $row["id"] . "' class='btn btn-danger'>Eliminar</a>";
    echo "<a href='edit_user/denunciar_post.php?id=" . $row["id"] . "' class='btn btn-dark'>Denunciar Post</a>";
    echo '</div>';
}
?>
