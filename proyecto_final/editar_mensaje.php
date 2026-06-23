<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("conexion.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $sql = "SELECT * FROM mensajeria WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado && mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
        $cliente = $fila['cliente'];
        $numero = $fila['numero'];
        $mensaje = $fila['mensaje'];
    } else {
        header("Location: mensajeria.php");
        exit();
    }
} else {
    header("Location: mensajeria.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mensaje SMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background: #f5f8fc; font-family: 'Segoe UI', sans-serif; padding: 50px 0; }
        .card { border: none; border-radius: 20px; box-shadow: 0 5px 15px rgba(0,0,0,.1); }
        .btn-actualizar { background: linear-gradient(90deg, #009FDB, #6F42C1,#E83E8C); color: white; border: none; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <h3><i class="fa-solid fa-pen-to-square"></i> Modificar Mensaje SMS (ID: <?php echo $id; ?>)</h3>
                <hr>
                
                <form action="procesar_editar.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre del cliente</label>
                        <input type="text" name="cliente" class="form-control" value="<?php echo htmlspecialchars($cliente); ?>" required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Número telefónico</label>
                        <input type="text" name="numero" class="form-control" value="<?php echo htmlspecialchars($numero); ?>" required>
                      </div>
                      <div class="col-md-12 mb-3">
                        <label class="form-label">Mensaje</label>
                        <textarea name="mensaje" class="form-control" rows="5" maxlength="160" required><?php echo htmlspecialchars($mensaje); ?></textarea>
                      </div>
                      <div class="col-md-12 d-flex justify-content-between">
                        <a href="mensajeria.php" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-actualizar px-4">Guardar Cambios</button>
                      </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>
