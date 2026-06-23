<?php
include("conexion.php");

$res_cant = mysqli_query($conexion, "SELECT COUNT(*) as total_facturas FROM facturas");
$f_cant = mysqli_fetch_assoc($res_cant);
$facturas_generadas = $f_cant['total_facturas'];

$res_sumas = mysqli_query($conexion, "SELECT SUM(subtotal) as total_sub, SUM(iva) as total_iva, SUM(total) as total_neto FROM facturas");
$f_sumas = mysqli_fetch_assoc($res_sumas);

$ingresos_totales = !empty($f_sumas['total_neto']) ? $f_sumas['total_neto'] : 0;
$iva_acumulado = !empty($f_sumas['total_iva']) ? $f_sumas['total_iva'] : 0;
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Facturación</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
body{ background:#f5f8fc; font-family:'Segoe UI',sans-serif; }
.navbar{ background:linear-gradient(90deg,#009FDB,#6F42C1,#E83E8C); }
.navbar-brand, .nav-link, .usuario{ color:white !important; font-weight:bold; }
.contenedor{ padding:30px; }
.card{ border:none; border-radius:20px; box-shadow:0 5px 15px rgba(0,0,0,.1); }
.btn-factura{ background:linear-gradient(90deg,#009FDB,#6F42C1,#E83E8C); color:white; border:none; }
.btn-editar{ background:#009FDB; color:white; }
.btn-eliminar{ background:#E83E8C; color:white; }
.avatar{ width:45px; height:45px; border-radius:50%; display:flex; justify-content:center; align-items:center; color:white; font-weight:bold; }
.stat{ text-align:center; padding:20px; }
.stat h3{ color:#009FDB; font-weight:bold; }
thead{ background:#f1f4f8; }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <span class="navbar-brand">Central de Telefonía Móvil</span>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="Menu.php"><i class="fa-solid fa-house"></i> Menú</a></li>
        <li class="nav-item"><a class="nav-link" href="clientes.php">Clientes</a></li>
        <li class="nav-item"><a class="nav-link" href="mensajeria.php">Mensajería</a></li>
        <li class="nav-item"><a class="nav-link" href="llamadas.php">Llamadas</a></li>
        <li class="nav-item"><a class="nav-link" href="recargas.php">Recargas</a></li>
        <li class="nav-item"><a class="nav-link" href="Facturas.php">Facturación</a></li>
        <li class="nav-item"><a class="nav-link" href="reportes.php">Reportes</a></li>
      </ul>
      <div><span class="usuario me-3"><i class="fa-solid fa-user"></i> Administrador</span></div>
    </div>
  </div>
</nav>

<div class="container contenedor">
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card stat">
        <h3><?php echo $facturas_generadas; ?></h3>
        <p class="mb-0">Facturas Generadas</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card stat">
        <h3>$<?php echo number_format($ingresos_totales, 2); ?></h3>
        <p class="mb-0">Ingresos Totales</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card stat">
        <h3>$<?php echo number_format($iva_acumulado, 2); ?></h3>
        <p class="mb-0">IVA Acumulado</p>
      </div>
    </div>
  </div>

  <div class="card p-4 mb-4">
    <h3><i class="fa-solid fa-file-invoice-dollar"></i> Generar Factura</h3>
    <hr>
    <form action="guardar_factura.php" method="POST">
      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Cliente</label>
          <input type="text" name="cliente" class="form-control" placeholder="Nombre del cliente" required>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Servicio / Plan</label>
          <select name="servicio" class="form-select">
            <option value="Plan Prepago">Plan Prepago</option>
            <option value="Plan Pospago">Plan Pospago</option>
            <option value="Paquete Datos Ilimitados">Paquete Datos Ilimitados</option>
            <option value="Plan Corporativo">Plan Corporativo</option>
          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Subtotal ($)</label>
          <input type="number" step="0.01" name="subtotal" class="form-control" placeholder="Ej: 500" required>
        </div>
        <div class="col-md-12">
          <button type="submit" class="btn btn-factura w-100">
            <i class="fa-solid fa-receipt"></i> Generar y Guardar Factura
          </button>
        </div>
      </div>
    </form>
  </div>

  <div class="card p-4">
    <h3><i class="fa-solid fa-history"></i> Historial de Facturas</h3>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Avatar</th>
          <th>Folio (ID)</th>
          <th>Cliente</th>
          <th>Servicio</th>
          <th>Subtotal</th>
          <th>IVA (16%)</th>
          <th>Total</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = mysqli_query($conexion, "SELECT * FROM facturas ORDER BY id DESC");
        while($fila = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
          <td><div class="avatar" style="background:#E83E8C"><?php echo strtoupper(substr($fila['cliente'], 0, 1)); ?></div></td>
          <td>#<?php echo $fila['id']; ?></td>
          <td><?php echo htmlspecialchars($fila['cliente']); ?></td>
          <td><span class="badge bg-secondary"><?php echo $fila['servicio']; ?></span></td>
          <td>$<?php echo number_format($fila['subtotal'], 2); ?></td>
          <td>$<?php echo number_format($fila['iva'], 2); ?></td>
          <td><strong>$<?php echo number_format($fila['total'], 2); ?></strong></td>
          <td>
            <a href="editar_factura.php?id=<?php echo $fila['id']; ?>" class="btn btn-editar btn-sm me-2"><i class="fa-solid fa-pen"></i></a>
            <a href="eliminar_factura.php?id=<?php echo $fila['id']; ?>" class="btn btn-eliminar btn-sm" onclick="return confirm('¿Deseas eliminar esta factura?');"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
