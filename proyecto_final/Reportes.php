<?php
include("conexion.php");

$res_cli = mysqli_query($conexion, "SELECT COUNT(*) as total FROM clientes");
$f_cli = mysqli_fetch_assoc($res_cli);
$total_clientes = $f_cli['total'];

$res_sms = mysqli_query($conexion, "SELECT COUNT(*) as total FROM mensajeria");
$f_sms = mysqli_fetch_assoc($res_sms);
$total_sms = $f_sms['total'];

$res_lla = mysqli_query($conexion, "SELECT COUNT(*) as total FROM llamadas");
$f_lla = mysqli_fetch_assoc($res_lla);
$total_llamadas = $f_lla['total'];

$res_rec = mysqli_query($conexion, "SELECT COUNT(*) as total FROM recargas");
$f_rec = mysqli_fetch_assoc($res_rec);
$total_recargas = $f_rec['total'];

$res_fac = mysqli_query($conexion, "SELECT SUM(total) as total_monto FROM facturas");
$f_fac = mysqli_fetch_assoc($res_fac);
$total_facturacion = !empty($f_fac['total_monto']) ? $f_fac['total_monto'] : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reportes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<style>
body{ background:#f5f8fc; font-family:'Segoe UI',sans-serif; }
.navbar{ background:linear-gradient(90deg,#009FDB,#6F42C1,#E83E8C); }
.navbar-brand, .nav-link, .usuario{ color:white !important; font-weight:bold; }
.contenedor{ padding:30px; }
.card{ border:none; border-radius:20px; box-shadow:0 5px 15px rgba(0,0,0,.1); }
.kpi{ text-align:center; padding:25px; transition:.3s; }
.kpi:hover{ transform:translateY(-5px); }
.kpi i{ font-size:40px; margin-bottom:10px; }
.kpi h2{ font-weight:bold; }
.clientes i{color:#009FDB;}
.sms i{color:#6F42C1;}
.llamadas i{color:#28A745;}
.recargas i{color:#FF9800;}
.facturacion i{color:#E83E8C;}
.btn-reporte{ background:linear-gradient(90deg,#009FDB,#6F42C1,#E83E8C); color:white; border:none; }
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
  <h2 class="mb-4"><i class="fa-solid fa-chart-line"></i> Panel de Reportes</h2>

  <div class="card p-4 mb-4">
    <h4><i class="fa-solid fa-file-export"></i> Exportación de Reportes</h4>
    <hr>
    <div class="row">
      <div class="col-md-6 mb-2">
        <button class="btn btn-reporte w-100" onclick="exportarPDF()">
          <i class="fa-solid fa-file-pdf"></i> Exportar PDF
        </button>
      </div>
      <div class="col-md-6 mb-2">
        <button class="btn btn-reporte w-100" onclick="exportarExcel()">
          <i class="fa-solid fa-file-excel"></i> Exportar Excel
        </button>
      </div>
    </div>
  </div>

  <div id="reporteContenido">
    <div class="row g-4 mb-4">
      <div class="col-md-4"><div class="card kpi clientes"><i class="fa-solid fa-users"></i><h2><?php echo $total_clientes; ?></h2><p class="mb-0">Clientes Registrados</p></div></div>
      <div class="col-md-4"><div class="card kpi sms"><i class="fa-solid fa-envelope"></i><h2><?php echo $total_sms; ?></h2><p class="mb-0">SMS Enviados</p></div></div>
      <div class="col-md-4"><div class="card kpi llamadas"><i class="fa-solid fa-phone"></i><h2><?php echo $total_llamadas; ?></h2><p class="mb-0">Llamadas Registradas</p></div></div>
      <div class="col-md-6"><div class="card kpi recargas"><i class="fa-solid fa-mobile-screen"></i><h2><?php echo $total_recargas; ?></h2><p class="mb-0">Recargas Realizadas</p></div></div>
      <div class="col-md-6"><div class="card kpi facturacion"><i class="fa-solid fa-file-invoice-dollar"></i><h2>$<?php echo number_format($total_facturacion, 2); ?></h2><p class="mb-0">Facturación Total</p></div></div>
    </div>

    <div class="card p-4">
      <h4><i class="fa-solid fa-clock-rotate-left"></i> Actividad Reciente (Últimos movimientos)</h4>
      <table class="table table-hover" id="tablaActividad">
        <thead>
          <tr><th>Folio/ID</th><th>Módulo</th><th>Descripción</th></tr>
        </thead>
        <tbody>
          <?php
          $query_actividad = "
            (SELECT id, 'Clientes' as modulo, CONCAT('Cliente registrado: ', nombre) as descripcion FROM clientes)
            UNION ALL
            (SELECT id, 'Mensajería' as modulo, CONCAT('SMS enviado a: ', cliente) as descripcion FROM mensajeria)
            UNION ALL
            (SELECT id, 'Llamadas' as modulo, CONCAT('Llamada de: ', cliente, ' (', duracion, ' min)') as descripcion FROM llamadas)
            UNION ALL
            (SELECT id, 'Recargas' as modulo, CONCAT('Recarga de $', monto, ' a ', cliente) as descripcion FROM recargas)
            UNION ALL
            (SELECT id, 'Facturación' as modulo, CONCAT('Factura para: ', cliente, ' (Total: $', total, ')') as descripcion FROM facturas)
            ORDER BY id DESC LIMIT 10
          ";

          $resultado_actividad = mysqli_query($conexion, $query_actividad);
          
          if($resultado_actividad && mysqli_num_rows($resultado_actividad) > 0) {
              while($act = mysqli_fetch_assoc($resultado_actividad)) {
          ?>
          <tr>
            <td>#<?php echo $act['id']; ?></td>
            <td><span class="badge bg-dark"><?php echo $act['modulo']; ?></span></td>
            <td><?php echo htmlspecialchars($act['descripcion']); ?></td>
          </tr>
          <?php 
              }
          } else {
              echo "<tr><td colspan='3' class='text-center'>No hay actividad registrada en el sistema.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
function exportarPDF() {
  const elemento = document.getElementById('reporteContenido');
  const opciones = {
    margin:       10,
    filename:     'Reporte_General_Telefonia.pdf',
    image:        { type: 'jpeg', quality: 0.98 },
    html2canvas:  { scale: 2 },
    jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
  };
  html2pdf().set(opciones).from(elemento).save();
}

function exportarExcel() {
  let tabla = document.getElementById("tablaActividad");
  let hoja = XLSX.utils.table_to_sheet(tabla);
  let libro = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(libro, hoja, "Actividad Reciente");
  XLSX.writeFile(libro, "Reporte_Actividad.xlsx");
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
