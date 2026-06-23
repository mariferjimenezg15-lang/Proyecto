<?php
include("conexion.php");

$res_total = mysqli_query($conexion, "SELECT COUNT(*) as total FROM recargas");
$f_total = mysqli_fetch_assoc($res_total);
$total_recargas = $f_total['total'];

$res_monto = mysqli_query($conexion, "SELECT SUM(monto) as total_monto FROM recargas");
$f_monto = mysqli_fetch_assoc($res_monto);
$monto_recaudado = !empty($f_monto['total_monto']) ? $f_monto['total_monto'] : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recargas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
body{ background:#f5f8fc; font-family:'Segoe UI',sans-serif; }
.navbar{ background:linear-gradient(90deg,#009FDB,#6F42C1,#E83E8C); }
.navbar-brand, .nav-link, .usuario{ color:white !important; font-weight:bold; }
.contenedor{ padding:30px; }
.card{ border:none; border-radius:20px; box-shadow:0 5px 15px rgba(0,0,0,.1); }
.btn-recarga{ background:linear-gradient(90deg,#009FDB,#6F42C1,#E83E8C); color:white; border:none; }
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
    <div class="col-md-6">
      <div class="card stat">
        <h3><?php echo $total_recargas; ?></h3>
        <p class="mb-0">Total de Recargas</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card stat">
        <h3>$<?php echo $monto_recaudado; ?></h3>
        <p class="mb-0">Monto Recaudado</p>
      </div>
    </div>
  </div>

  <div class="card p-4 mb-4">
    <h3><i class="fa-solid fa-mobile-screen"></i> Registrar Recarga</h3>
    <hr>
    <form action="guardar_recarga.php" method="POST">
      <div class="row">
        <div class="col-md-3 mb-3"><input type="text" name="cliente" class="form-control" placeholder="Cliente" required></div>
        <div class="col-md-3 mb-3"><input type="text" name="numero" class="form-control" placeholder="Número" required></div>
        <div class="col-md-3 mb-3"><input type="number" name="monto" class="form-control" placeholder="Monto" required></div>
        <div class="col-md-3 mb-3">
          <select name="operador" class="form-select">
            <option value="AT&T">AT&T</option>
            <option value="Telcel">Telcel</option>
            <option value="Movistar">Movistar</option>
            <option value="Unefon">Unefon</option>
          </select>
        </div>
        <div class="col-md-12">
          <button type="submit" class="btn btn-recarga w-100">
            <i class="fa-solid fa-money-bill-wave"></i> Registrar Recarga
          </button>
        </div>
      </div>
    </form>
  </div>

  <div class="card p-4">
    <h3><i class="fa-solid fa-clock-rotate-left"></i> Historial de Recargas</h3>
    <table class="table table-hover" id="tablaRecargas">
      <thead>
        <tr>
          <th>Avatar</th>
          <th>ID</th>
          <th>Cliente</th>
          <th>Número</th>
          <th>Monto</th>
          <th>Operador</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = mysqli_query($conexion, "SELECT * FROM recargas ORDER BY id DESC");
        while($fila = mysqli_fetch_assoc($query)) {
            // Formatear la fecha limpia para el usuario
            $fecha_formateada = date("d/m/Y", strtotime($fila['fecha']));
        ?>
        <tr>
          <td><div class="avatar" style="background:#6F42C1"><?php echo strtoupper(substr($fila['cliente'], 0, 1)); ?></div></td>
          <td><?php echo $fila['id']; ?></td>
          <td><?php echo $fila['cliente']; ?></td>
          <td><?php echo $fila['numero']; ?></td>
          <td>$<?php echo $fila['monto']; ?></td>
          <td><?php echo $fila['operador']; ?></td>
          <td><?php echo $fecha_formateada; ?></td>
          <td>
            <a href="editar_recarga.php?id=<?php echo $fila['id']; ?>" class="btn btn-editar btn-sm me-2"><i class="fa-solid fa-pen"></i></a>
            <a href="eliminar_recarga.php?id=<?php echo $fila['id']; ?>" class="btn btn-eliminar btn-sm" onclick="return confirm('¿Deseas eliminar esta recarga?');"><i class="fa-solid fa-trash"></i></a>
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