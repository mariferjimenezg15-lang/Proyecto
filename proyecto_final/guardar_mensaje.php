<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = mysqli_real_escape_string($conexion, $_POST['cliente']);
    $numero  = mysqli_real_escape_string($conexion, $_POST['numero']);
    $mensaje = mysqli_real_escape_string($conexion, $_POST['mensaje']);
    $estado  = "Enviado"; 

    $sql = "INSERT INTO mensajeria (cliente, numero, mensaje, estado) VALUES ('$cliente', '$numero', '$mensaje', '$estado')";

    if (mysqli_query($conexion, $sql)) {
        header("Location: mensajeria.php");
        exit();
    } else {
        echo "Error al enviar el mensaje: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
