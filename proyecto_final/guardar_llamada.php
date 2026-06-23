<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente  = mysqli_real_escape_string($conexion, $_POST['cliente']);
    $numero   = mysqli_real_escape_string($conexion, $_POST['numero']);
    $duracion = intval($_POST['duracion']);
    $tipo     = mysqli_real_escape_string($conexion, $_POST['tipo']);

    $sql = "INSERT INTO llamadas (cliente, numero, duracion, tipo) VALUES ('$cliente', '$numero', $duracion, '$tipo')";

    if (mysqli_query($conexion, $sql)) {
        header("Location: llamadas.php");
        exit();
    } else {
        echo "Error al registrar la llamada: " . mysqli_error($conexion);
    }
}
mysqli_close($conexion);
?>
