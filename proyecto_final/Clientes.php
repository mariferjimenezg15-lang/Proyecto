<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Gestión de Clientes</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
body{
    background:#f5f8fc;
    font-family:'Segoe UI',sans-serif;
}

/* NAVBAR */
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

/* CONTENIDO */
.contenedor{
    padding:30px;
}
.card{
    border:none;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

/* BOTONES */
.btn-guardar{
    background:linear-gradient(90deg,#009FDB,#6F42C1,#E83E8C);
    color:white;
    border:none;
}
.btn-editar{
    background:#009FDB;
    color:white;
}
.btn-eliminar{
    background:#E83E8C;
    color:white;
}

/* AVATARES */
.avatar{
    width:45px;
    height:45px;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
    font-weight:bold;
    font-size:18px;
}

table{
    margin-top:20px;
}
thead{
    background:#f1f4f8;
}
</style>
</head>

<body>

<!-- Barra de navegacion con apartado Menu -->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <span class="navbar-brand">Central de Telefonía Móvil</span>

    <!-- Boton responsive -->
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Apartados -->
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

      <!-- Usuario y botón salir -->
      <div>
        <span class="usuario me-3">
          <i class="fa-solid fa-user"></i> Administrador
        </span>
        
</nav>

<div class="container contenedor">
  <div class="card p-4 mb-4">
    <h3><i class="fa-solid fa-users"></i> Registro de Clientes</h3>
    <hr>
    <form action="guardar_cliente.php" method="POST">
    <div class="row">
      <div class="col-md-4 mb-3">
        <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required>
      </div>
      <div class="col-md-4 mb-3">
        <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required>
      </div>
      <div class="col-md-4 mb-3">
        <input type="email" name="correo" class="form-control" placeholder="Correo" required>
      </div>
      <div class="col-md-4 mb-3">
        <select name="plan" class="form-select">
          <option>Prepago</option>
          <option>Pospago</option>
          <option>Empresarial</option>
          <option>Premium</option>
        </select>
      </div>
      <div class="col-md-8 mb-3">
        <button type="submit" class="btn btn-guardar w-100">
          <i class="fa-solid fa-user-plus"></i> Guardar Cliente
        </button>
      </div>
    </div>
 </form>
</div>

  <div class="card p-4">
    <h3><i class="fa-solid fa-address-book"></i> Clientes Registrados</h3>
    <table class="table table-hover" id="tablaClientes">
      <thead>
        <tr>
          <th>Avatar</th>
          <th>ID</th>
          <th>Nombre</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Plan</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include("conexion.php");
        $query = mysqli_query($conexion, "SELECT * FROM clientes");
        while($fila = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
          <td><div class="avatar" style="background:#009FDB"><?php echo strtoupper(substr($fila['nombre'], 0, 1)); ?></div></td>
          <td><?php echo $fila['id']; ?></td>
          <td><?php echo $fila['nombre']; ?></td>
          <td><?php echo $fila['telefono']; ?></td>
          <td><?php echo $fila['correo']; ?></td>
          <td><?php echo $fila['plan']; ?></td>
          <td>
            <a href="editar_cliente.php?id=<?php echo $fila['id']; ?>" class="btn btn-editar btn-sm me-2">
              <i class="fa-solid fa-pen"></i>
            </a>
            <a href="eliminar_cliente.php?id=<?php echo $fila['id']; ?>" class="btn btn-eliminar btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este cliente?');">
              <i class="fa-solid fa-trash"></i>
            </a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<script>
let contador = 1;
const colores = ["#E83E8C","#009FDB","#6F42C1","#28A745","#FF9800","#20C997","#DC3545","#6610F2"];

function agregarCliente(){
  let nombre = document.getElementById("nombre").value;
  let telefono = document.getElementById("telefono").value;
  let correo = document.getElementById("correo").value;
  let plan = document.getElementById("plan").value;

  if(nombre=="" || telefono=="" || correo==""){
    alert("Complete todos los campos");
    return;
  }

  let color = colores[(contador-1)%colores.length];
  let inicial = nombre.charAt(0).toUpperCase();
  let tabla = document.getElementById("tablaClientes").getElementsByTagName("tbody")[0];
  let fila = tabla.insertRow();

  fila.insertCell(0).innerHTML = `<div class="avatar" style="background:${color}">${inicial}</div>`;
  fila.insertCell(1).innerHTML = contador;
  fila.insertCell(2).innerHTML = nombre;
  fila.insertCell(3).innerHTML = telefono;
  fila.insertCell(4).innerHTML = correo;
  fila.insertCell(5).innerHTML = plan;
  fila.insertCell(6).innerHTML =
    `<button class="btn btn-editar btn-sm me-2" onclick="editarFila(this)">
      <i class="fa-solid fa-pen"></i>
    </button>
    <button class="btn btn-eliminar btn-sm" onclick="eliminarFila(this)">
      <i class="fa-solid fa-trash"></i>
    </button>`;

  contador++;
  document.getElementById("nombre").value="";
  document.getElementById("telefono").value="";
  document.getElementById("correo").value="";
}

function eliminarFila(boton){
  if(confirm("¿Desea eliminar este cliente?")){
    let fila = boton.parentNode.parentNode;
    fila.remove();
  }
}

function editarFila(boton){
  let fila = boton.parentNode.parentNode;
  document.getElementById("nombre").value = fila.cells[2].innerHTML;
  document.getElementById("telefono").value = fila.cells[3].innerHTML;
  document.getElementById("correo").value = fila.cells[4].innerHTML;
  fila.remove();
}

function cerrarSesion(){
  if(confirm("¿Desea cerrar sesión?")){
    window.location.href = "TELEFONIA inicio 1.php";
  }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

