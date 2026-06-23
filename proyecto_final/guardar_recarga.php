<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente  = mysqli_real_escape_string($conexion, $_POST['cliente']);
    $numero   = mysqli_real_escape_string($conexion, $_POST['numero']);
    $monto    = intval($_POST['monto']);
    $operador = mysqli_real_escape_string($conexion, $_POST['operador']);

    $sql = "INSERT INTO recargas (cliente, numero, monto, operador) VALUES ('$cliente', '$numero', $monto, '$operador')";

    if (mysqli_query($conexion, $sql)) {
        header("Location: recargas.php");
        exit();
    } else {
        echo "Error al registrar la recarga: " . mysqli_error($conexion);
    }
}
mysqli_close($conexion);
?>
