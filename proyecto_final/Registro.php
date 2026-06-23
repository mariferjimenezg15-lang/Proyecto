<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registro</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(
        135deg,
        #009FDB,
        #6F42C1,
        #E83E8C
    );
}

.card{

    width:500px;

    border:none;

    border-radius:25px;

    padding:30px;
}

.btn-registrar{

    background:
    linear-gradient(
        90deg,
        #009FDB,
        #6F42C1,
        #E83E8C
    );

    color:white;

    border:none;
}

</style>
</head>

<body>

<div class="card shadow">

<h2 class="text-center mb-4">
Registro de Usuario
</h2>

<input type="text"
class="form-control mb-3"
placeholder="Nombre completo">

<input type="email"
class="form-control mb-3"
placeholder="Correo electrónico">

<input type="text"
class="form-control mb-3"
placeholder="Usuario">

<input type="password"
class="form-control mb-3"
placeholder="Contraseña">

<button
class="btn btn-registrar w-100">
Registrarse
</button>

<a href="index.php"
class="btn btn-outline-secondary w-100 mt-2">
Volver al Login
</a>

</div>

</body>
</html>