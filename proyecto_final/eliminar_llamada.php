<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM llamadas WHERE id = $id";

    if (mysqli_query($conexion, $sql)) {
        header("Location: llamadas.php");
        exit();
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conexion);
    }
} else {
    header("Location: llamadas.php");
    exit();
}
mysqli_close($conexion);
?>
