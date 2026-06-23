<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM facturas WHERE id = $id";

    if (mysqli_query($conexion, $sql)) {
        header("Location: Facturas.php");
        exit();
    } else {
        echo "Error al eliminar la factura: " . mysqli_error($conexion);
    }
} else {
    header("Location: Facturas.php");
    exit();
}
mysqli_close($conexion);
?>
