<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Central de Telefonia Móvil</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(
        135deg,
        #009FDB 0%,
        #6F42C1 50%,
        #E83E8C 100%
    );
}

.login-box{

    width:450px;

    background:rgba(255,255,255,.95);

    border-radius:25px;

    padding:40px;

    box-shadow:
    0 15px 40px rgba(0,0,0,.2);

    text-align:center;
}

.logo{

    width:110px;
    height:110px;

    margin:auto;

    border-radius:50%;

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

    color:white;

    font-size:50px;
}

h1{

    color:#003B64;

    margin-top:20px;

    font-weight:bold;
}

.subtitulo{

    color:#666;

    margin-bottom:25px;
}

.input-group{

    margin-bottom:18px;
}

.input-group-text{

    background:#009FDB;

    color:white;

    border:none;
}

.form-control{

    height:55px;
}

.form-control:focus{

    border-color:#6F42C1;

    box-shadow:
    0 0 10px rgba(111,66,193,.25);
}

.btn-login{

    width:100%;

    height:55px;

    border:none;

    border-radius:12px;

    color:white;

    font-size:18px;

    font-weight:bold;

    background:
    linear-gradient(
        90deg,
        #009FDB,
        #6F42C1,
        #E83E8C
    );
}

.btn-login:hover{
    opacity:.9;
}

.btn-registro{

    width:100%;

    margin-top:10px;

    border-radius:12px;
}

.info{

    margin-top:20px;

    color:#666;
}

</style>

</head>

<body>

<div class="login-box">

    <div class="logo">
        <i class="fa-solid fa-tower-cell"></i>
    </div>

    <h1>Telefonia Móvil</h1>

    <p class="subtitulo">
        Sistema Integral de Telecomunicaciones
    </p>

    <div class="input-group">

        <span class="input-group-text">
            <i class="fa-solid fa-user"></i>
        </span>

        <input
        type="text"
        id="usuario"
        class="form-control"
        placeholder="Usuario">

    </div>

    <div class="input-group">

        <span class="input-group-text">
            <i class="fa-solid fa-lock"></i>
        </span>

        <input
        type="password"
        id="password"
        class="form-control"
        placeholder="Contraseña">

    </div>

    <button
    class="btn-login"
    onclick="login()">

        <i class="fa-solid fa-right-to-bracket"></i>
        Iniciar Sesión

    </button>

    <button
    class="btn btn-outline-primary btn-registro"
    data-bs-toggle="modal"
    data-bs-target="#registroModal">

        <i class="fa-solid fa-user-plus"></i>
        Registrarse

    </button>

    <div class="info">

        <i class="fa-solid fa-shield-halved"></i>
        Acceso seguro al sistema

    </div>

</div>

<div class="modal fade"
id="registroModal"
tabindex="-1">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">

<i class="fa-solid fa-user-plus"></i>
 Registro de Usuario

</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<input
type="text"
class="form-control mb-3"
placeholder="Nombre completo">

<input
type="email"
class="form-control mb-3"
placeholder="Correo electrónico">

<input
type="text"
class="form-control mb-3"
placeholder="Usuario">

<input
type="password"
class="form-control"
placeholder="Contraseña">

</div>

<div class="modal-footer">

<button
type="button"
class="btn btn-secondary"
data-bs-dismiss="modal">

Cancelar

</button>

<button
type="button"
class="btn btn-primary"
onclick="registrar()">

Registrarse

</button>

</div>

</div>

</div>

</div>

<script>

function login(){

    let usuario =
    document.getElementById("usuario").value;

    let password =
    document.getElementById("password").value;

    if(
        usuario === "admin" &&
        password === "12345"
    ){

        alert(
        "Bienvenido al sistema"
        );

        window.location.href =
        "Menu.html";

    }
    else{

        alert(
        "Usuario o contraseña incorrectos"
        );

    }

}

function registrar(){

    alert(
    "Usuario registrado correctamente"
    );

}

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>