<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id       = intval($_POST['id']);
    $nombre   = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $correo   = mysqli_real_escape_string($conexion, $_POST['correo']);
    $plan     = mysqli_real_escape_string($conexion, $_POST['plan']);

    $sql = "UPDATE clientes SET nombre = '$nombre', telefono = '$telefono', correo = '$correo', plan = '$plan' WHERE id = $id";

    if (mysqli_query($conexion, $sql)) {
        header("Location: clientes.php");
        exit();
    } else {
        echo "Error al actualizar los datos del cliente: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
