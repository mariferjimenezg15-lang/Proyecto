<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $plan = $_POST['plan'];

    $sql = "INSERT INTO clientes (nombre, telefono, correo, plan) VALUES ('$nombre', '$telefono', '$correo', '$plan')";

    if (mysqli_query($conexion, $sql)) {
        header("Location: clientes.php?status=exito");
    } else {
        echo "Error al guardar: " . mysqli_error($conexion);
    }
}
?>
