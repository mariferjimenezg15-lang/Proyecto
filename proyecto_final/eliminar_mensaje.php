<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM mensajeria WHERE id = $id";

    if (mysqli_query($conexion, $sql)) {
        header("Location: mensajeria.php");
        exit();
    } else {
        echo "Error al intentar eliminar el registro: " . mysqli_error($conexion);
    }
} else {
    header("Location: mensajeria.php");
    exit();
}

mysqli_close($conexion);
?>
