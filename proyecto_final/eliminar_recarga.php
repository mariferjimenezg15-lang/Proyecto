<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM recargas WHERE id = $id";

    if (mysqli_query($conexion, $sql)) {
        header("Location: recargas.php");
        exit();
    } else {
        echo "Error al eliminar la recarga: " . mysqli_error($conexion);
    }
} else {
    header("Location: recargas.php");
    exit();
}
mysqli_close($conexion);
?>
