<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $sql = "SELECT * FROM clientes WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado && mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
        $nombre = $fila['nombre'];
        $telefono = $fila['telefono'];
        $correo = $fila['correo'];
        $plan = $fila['plan'];
    } else {
        header("Location: clientes.php");
        exit();
    }
} else {
    header("Location: clientes.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                <h3><i class="fa-solid fa-user-pen"></i> Modificar Cliente (ID: <?php echo $id; ?>)</h3>
                <hr>
                
                <form action="procesar_editar_cliente.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre completo</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($nombre); ?>" required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="<?php echo htmlspecialchars($telefono); ?>" required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="correo" class="form-control" value="<?php echo htmlspecialchars($correo); ?>" required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Plan contratado</label>
                        <select name="plan" class="form-select">
                          <option value="Prepago" <?php if($plan == 'Prepago') echo 'selected'; ?>>Prepago</option>
                          <option value="Pospago" <?php if($plan == 'Pospago') echo 'selected'; ?>>Pospago</option>
                          <option value="Empresarial" <?php if($plan == 'Empresarial') echo 'selected'; ?>>Empresarial</option>
                          <option value="Premium" <?php if($plan == 'Premium') echo 'selected'; ?>>Premium</option>
                        </select>
                      </div>
                      <div class="col-md-12 d-flex justify-content-between mt-3">
                        <a href="clientes.php" class="btn btn-secondary">Cancelar</a>
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
