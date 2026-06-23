<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Central de Telefonía Móvil</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Segoe UI',sans-serif;
}

body{
  background:#f4f8fc;
}

.navbar{
  background: linear-gradient(90deg,#009FDB,#6F42C1,#E83E8C);
  padding:15px 30px;
}

.navbar-brand{
  color:white !important;
  font-size:28px;
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

.empresa{
  background:white;
  padding:50px;
  margin:40px auto;
  max-width:900px;
  text-align:center;
  box-shadow:0 2px 15px rgba(0,0,0,.08);
  border-radius:15px;
}

.empresa h1{
  color:#003B64;
  font-weight:bold;
  margin-bottom:20px;
}

.empresa p{
  color:#555;
  line-height:1.6;
}

.footer{
  margin-top:50px;
  padding:20px;
  text-align:center;
  color:#777;
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
        <li class="nav-item"><a class="nav-link" href="clientes.php">Clientes</a></li>
        <li class="nav-item"><a class="nav-link" href="mensajeria.php">Mensajería</a></li>
        <li class="nav-item"><a class="nav-link" href="llamadas.php">Llamadas</a></li>
        <li class="nav-item"><a class="nav-link" href="recargas.php">Recargas</a></li>
        <li class="nav-item"><a class="nav-link" href="Facturas.php">Facturación</a></li>
        <li class="nav-item"><a class="nav-link" href="reportes.php">Reportes</a></li>
      </ul>

      <div>
        <span class="usuario me-3">
          <i class="fa-solid fa-user"></i> Administrador
        </span>
        
</nav>

<div class="empresa">
  <h1>Sobre Nosotros</h1>
  <p>
    Central de Telefonía Móvil es una empresa mexicana dedicada a brindar servicios de 
    telecomunicaciones de alta calidad. Nuestro giro principal incluye telefonía móvil, 
    mensajería SMS, planes de datos y soluciones corporativas de comunicación.
  </p>
  <p>
    Con más de 15 años en el mercado, ofrecemos cobertura nacional, atención personalizada 
    y paquetes flexibles que se adaptan a las necesidades de nuestros clientes. 
    Nuestra misión es conectar a las personas y empresas con tecnología confiable, 
    innovadora y accesible.
  </p>
  <p>
    Además, contamos con programas de responsabilidad social y proyectos de expansión 
    digital para impulsar la conectividad en comunidades rurales y urbanas.
  </p>

  <div id="carouselEmpresa" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://images.unsplash.com/photo-1581090700227-4c4d1a3d5d3d?w=1200" class="d-block w-100" alt="Oficinas modernas">
      </div>
      <div class="carousel-item">
        <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=1200" class="d-block w-100" alt="Equipo de trabajo">
      </div>
      <div class="carousel-item">
        <img src="https://images.unsplash.com/photo-1525182008055-f88b95ff7980?w=1200" class="d-block w-100" alt="Tecnología móvil">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselEmpresa" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselEmpresa" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

<div class="footer">© 2025 Central de Telefonía Móvil - Todos los derechos reservados</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


