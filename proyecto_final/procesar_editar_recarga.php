<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id       = intval($_POST['id']);
    $cliente  = mysqli_real_escape_string($conexion, $_POST['cliente']);
    $numero   = mysqli_real_escape_string($conexion, $_POST['numero']);
    $monto    = intval($_POST['monto']);
    $operador = mysqli_real_escape_string($conexion, $_POST['operador']);

    $sql = "UPDATE recargas SET cliente = '$cliente', numero = '$numero', monto = $monto, operador = '$operador' WHERE id = $id";

    if (mysqli_query($conexion, $sql)) {
        header("Location: recargas.php");
        exit();
    } else {
        echo "Error al actualizar la recarga: " . mysqli_error($conexion);
    }
}
mysqli_close($conexion);
?>
