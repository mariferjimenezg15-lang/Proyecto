<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM llamadas WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado && mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
        $cliente  = $fila['cliente'];
        $numero   = $fila['numero'];
        $duracion = $fila['duracion'];
        $tipo     = $fila['tipo'];
    } else {
        header("Location: llamadas.php");
        exit();
    }
} else {
    header("Location: llamadas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Llamada</title>
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
                <h3>Modificar Registro de Llamada (ID: <?php echo $id; ?>)</h3>
                <hr>
                <form action="procesar_editar_llamada.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Cliente</label>
                        <input type="text" name="cliente" class="form-control" value="<?php echo htmlspecialchars($cliente); ?>" required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Número</label>
                        <input type="text" name="numero" class="form-control" value="<?php echo htmlspecialchars($numero); ?>" required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Duración (minutos)</label>
                        <input type="number" name="duracion" class="form-control" value="<?php echo $duracion; ?>" required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Tipo de Llamada</label>
                        <select name="tipo" class="form-select">
                          <option value="Entrante" <?php if($tipo == 'Entrante') echo 'selected'; ?>>Entrante</option>
                          <option value="Saliente" <?php if($tipo == 'Saliente') echo 'selected'; ?>>Saliente</option>
                        </select>
                      </div>
                      <div class="col-md-12 d-flex justify-content-between mt-3">
                        <a href="llamadas.php" class="btn btn-secondary">Cancelar</a>
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
