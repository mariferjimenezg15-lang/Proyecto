<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id      = intval($_POST['id']);
    $cliente = mysqli_real_escape_string($conexion, $_POST['cliente']);
    $numero  = mysqli_real_escape_string($conexion, $_POST['numero']);
    $mensaje = mysqli_real_escape_string($conexion, $_POST['mensaje']);

    $sql = "UPDATE mensajeria SET cliente = '$cliente', numero = '$numero', mensaje = '$mensaje' WHERE id = $id";

    if (mysqli_query($conexion, $sql)) {
        header("Location: mensajeria.php");
        exit();
    } else {
        echo "Error al actualizar el registro: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>