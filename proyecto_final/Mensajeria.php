<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mensajería SMS</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
body{
    background:#f5f8fc;
    font-family:'Segoe UI',sans-serif;
}

.navbar{
    background:linear-gradient(90deg,#009FDB,#6F42C1,#E83E8C);
}
.navbar-brand{
    color:white !important;
    font-weight:bold;
}
.nav-link{
    color:white !important;
    font-weight:500;
}
.usuario{
    color:white;
    font-weight:bold;
}

.contenedor{
    padding:30px;
}
.card{
    border:none;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}
.btn-enviar{
    background:linear-gradient(90deg,#009FDB,#6F42C1,#E83E8C);
    color:white;
    border:none;
}
.btn-eliminar{
    background:#E83E8C;
    color:white;
}
.badge-enviado{
    background:#28A745;
}
.badge-pendiente{
    background:#FFC107;
    color:black;
}
.contador{
    text-align:right;
    color:#666;
    margin-top:5px;
}
thead{
    background:#f1f4f8;
}
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
        <li class="nav-item"><a class="nav-link text-white" href="Menu.php"><i class="fa-solid fa-house"></i> Menú</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="clientes.php">Clientes</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="mensajeria.php">Mensajería</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="llamadas.php">Llamadas</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="recargas.php">Recargas</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="Facturas.php">Facturación</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="reportes.php">Reportes</a></li>
      </ul>

      <div>
        <span class="usuario me-3">
          <i class="fa-solid fa-user"></i> Administrador
        </span>
        
</nav>

<div class="container contenedor">
  <div class="card p-4 mb-4">
  <h3><i class="fa-solid fa-envelope"></i> Nuevo Mensaje SMS</h3>
  <hr>
  <form action="guardar_mensaje.php" method="POST">
    <div class="row">
      <div class="col-md-6 mb-3">
        <input type="text" name="cliente" id="cliente" class="form-control" placeholder="Nombre del cliente" required>
      </div>
      <div class="col-md-6 mb-3">
        <input type="text" name="numero" id="numero" class="form-control" placeholder="Número telefónico" required>
      </div>
      <div class="col-md-12">
        <textarea name="mensaje" id="mensaje" class="form-control" rows="5" maxlength="160" placeholder="Escriba el mensaje..." required></textarea>
        <div class="contador"><span id="contador">0</span>/160 caracteres</div>
      </div>
      <div class="col-md-12 mt-3">
        <button type="submit" class="btn btn-enviar w-100">
          <i class="fa-solid fa-paper-plane"></i> Enviar SMS
        </button>
      </div>
    </div>
  </form>
</div>

  <div class="card p-4">
    <h3><i class="fa-solid fa-clock-rotate-left"></i> Historial de Mensajes</h3>
    <table class="table table-hover" id="tablaMensajes">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Número</th>
          <th>Mensaje</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
    <?php
    include("conexion.php");
    $resultado = mysqli_query($conexion, "SELECT * FROM mensajeria");
    while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td>" . $fila['id'] . "</td>";
    echo "<td>" . $fila['cliente'] . "</td>";
    echo "<td>" . $fila['numero'] . "</td>";
    echo "<td>" . $fila['mensaje'] . "</td>";
    echo "<td><span class='badge badge-enviado'>" . $fila['estado'] . "</span></td>"; 
    echo "<td>";
    echo "<a href='editar_mensaje.php?id=" . $fila['id'] . "' class='btn btn-warning btn-sm me-2 text-white'><i class='fa-solid fa-pen-to-square'></i></a>";       
    echo "<a href='eliminar_mensaje.php?id=" . $fila['id'] . "' class='btn btn-eliminar btn-sm'><i class='fa-solid fa-trash'></i></a>";
    echo "</td>";
}
    ?>
    </tbody>
    </table>
  </div>
</div>

<script>
let contadorMensajes = 1;
const mensaje = document.getElementById("mensaje");

mensaje.addEventListener("input",function(){
  document.getElementById("contador").innerText = mensaje.value.length;
});

function enviarMensaje(){
  let cliente = document.getElementById("cliente").value;
  let numero = document.getElementById("numero").value;
  let texto = document.getElementById("mensaje").value;

  if(cliente=="" || numero=="" || texto==""){
    alert("Complete todos los campos");
    return;
  }

  let tabla = document.getElementById("tablaMensajes").getElementsByTagName("tbody")[0];
  let fila = tabla.insertRow();

  fila.insertCell(0).innerHTML = contadorMensajes;
  fila.insertCell(1).innerHTML = cliente;
  fila.insertCell(2).innerHTML = numero;
  fila.insertCell(3).innerHTML = texto;
  fila.insertCell(4).innerHTML = '<span class="badge badge-enviado">Enviado</span>';
  fila.insertCell(5).innerHTML =
    `<button class="btn btn-eliminar btn-sm" onclick="eliminarMensaje(this)">
      <i class="fa-solid fa-trash"></i>
    </button>`;

  contadorMensajes++;
  document.getElementById("cliente").value="";
  document.getElementById("numero").value="";
  document.getElementById("mensaje").value="";
  document.getElementById("contador").innerText="0";
}

function eliminarMensaje(boton){
  if(confirm("¿Desea eliminar este mensaje?")){
    let fila = boton.parentNode.parentNode;
    fila.remove();
  }
}

function cerrarSesion(){
  if(confirm("¿Desea cerrar sesión?")){
    window.location.href = "TELEFONIA inicio 1.html";
  }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
