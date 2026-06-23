<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id       = intval($_POST['id']);
    $cliente  = mysqli_real_escape_string($conexion, $_POST['cliente']);
    $servicio = mysqli_real_escape_string($conexion, $_POST['servicio']);
    $subtotal = floatval($_POST['subtotal']);
    
    $iva   = $subtotal * 0.16;
    $total = $subtotal + $iva;

    $sql = "UPDATE facturas SET cliente = '$cliente', servicio = '$servicio', subtotal = $subtotal, iva = $iva, total = $total WHERE id = $id";

    if (mysqli_query($conexion, $sql)) {
        header("Location: Facturas.php");
        exit();
    } else {
        echo "Error al actualizar la factura: " . mysqli_error($conexion);
    }
}
mysqli_close($conexion);
?>
