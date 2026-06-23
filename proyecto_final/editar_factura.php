<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM facturas WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado && mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
        $cliente  = $fila['cliente'];
        $servicio = $fila['servicio'];
        $subtotal = $fila['subtotal'];
    } else {
        header("Location: Facturas.php");
        exit();
    }
} else {
    header("Location: Facturas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f8fc; font-family: 'Segoe UI', sans-serif; padding: 50px 0; }
        .card { border: none; border-radius: 20px; box-shadow: 0 5px 15px rgba(0,0,0,.1); }
        .btn-actualizar { background: linear-gradient(90deg, #009FDB, #6F42C1); color: white; border: none; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <h3>Modificar Factura (Folio: #<?php echo $id; ?>)</h3>
                <hr>
                <form action="procesar_editar_factura.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Cliente</label>
                        <input type="text" name="cliente" class="form-control" value="<?php echo htmlspecialchars($cliente); ?>" required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Servicio</label>
                        <select name="servicio" class="form-select">
                          <option value="Plan Prepago" <?php if($servicio == 'Plan Prepago') echo 'selected'; ?>>Plan Prepago</option>
                          <option value="Plan Pospago" <?php if($servicio == 'Plan Pospago') echo 'selected'; ?>>Plan Pospago</option>
                          <option value="Paquete Datos Ilimitados" <?php if($servicio == 'Paquete Datos Ilimitados') echo 'selected'; ?>>Paquete Datos Ilimitados</option>
                          <option value="Plan Corporativo" <?php if($servicio == 'Plan Corporativo') echo 'selected'; ?>>Plan Corporativo</option>
                        </select>
                      </div>
                      <div class="col-md-12 mb-3">
                        <label class="form-label">Subtotal original ($)</label>
                        <input type="number" step="0.01" name="subtotal" class="form-control" value="<?php echo $subtotal; ?>" required>
                      </div>
                      <div class="col-md-12 d-flex justify-content-between mt-3">
                        <a href="Facturas.php" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-actualizar px-4">Recalcular y Guardar</button>
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
