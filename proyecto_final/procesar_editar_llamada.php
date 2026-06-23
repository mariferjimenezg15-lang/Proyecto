<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id       = intval($_POST['id']);
    $cliente  = mysqli_real_escape_string($conexion, $_POST['cliente']);
    $numero   = mysqli_real_escape_string($conexion, $_POST['numero']);
    $duracion = intval($_POST['duracion']);
    $tipo     = mysqli_real_escape_string($conexion, $_POST['tipo']);

    $sql = "UPDATE llamadas SET cliente = '$cliente', numero = '$numero', duracion = $duracion, tipo = '$tipo' WHERE id = $id";

    if (mysqli_query($conexion, $sql)) {
        header("Location: llamadas.php");
        exit();
    } else {
        echo "Error al actualizar la llamada: " . mysqli_error($conexion);
    }
}
mysqli_close($conexion);
?>
