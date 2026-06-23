<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente  = mysqli_real_escape_string($conexion, $_POST['cliente']);
    $servicio = mysqli_real_escape_string($conexion, $_POST['servicio']);
    $subtotal = floatval($_POST['subtotal']);
    
    $iva   = $subtotal * 0.16;
    $total = $subtotal + $iva;

    $sql = "INSERT INTO facturas (cliente, servicio, subtotal, iva, total) VALUES ('$cliente', '$servicio', $subtotal, $iva, $total)";

    if (mysqli_query($conexion, $sql)) {
        header("Location: Facturas.php");
        exit();
    } else {
        echo "Error al guardar la factura: " . mysqli_error($conexion);
    }
}
mysqli_close($conexion);
?>
