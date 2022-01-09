<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://static.thenounproject.com/png/601086-200.png">
    <title>Gestion de Centros</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"crossorigin="anonymous"></script> 
</head>
<style>
    body {
        border: 4px solid salmon;
        margin: 70px 300px;
        padding: 40px;
        border-radius: 20px
    }

    .validation{
        color: red;
    }

    .title{
        margin: -60px auto 20px;
        padding: 30px;
        font-size: 5em;
        text-align:center;
        color: gray;
    }

    .form-control{
        display: inline-block;
        width: 400px;
    }

    .formulario{
        width: 500px;
        margin: 20px auto;
        display: flex;
        justify-content: space-between;
    }

    img{
        display: block;
        margin:auto;
    }
    
    .socialite{
        margin-left: 10px;
        display: inline-block;
        width: 50px;
    }

    .iniciar{
        font-weight: bold;
        display: block;
        padding: 4px;
        text-align: center;
        border: 2px solid black;
        margin: 0 auto 20px;
        width: 280px;
    }

    #git{
        background-color: gray;
        color: white;
    }

    #git:hover{
        background-color: lightgray;
        color:black;
    }

    #face{
        background-color: blue;
        color: white;
    }

    #face:hover{
        background-color: lightblue;
        color:black;
    }

    #google{
        background-color: salmon;
        color: white;
    }

    #google:hover{
        background-color: lightsalmon;
        color:black;
    }

    .boton{
        text-align: center;
        width: 200px;
        margin: 0 auto 10px;
    }

</style>
<body>
    <div class="img"><img src="https://static.thenounproject.com/png/601086-200.png"></div>
    <div class="title">GESTIÓN DE CENTROS</div>
    <div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="validation" :errors="$errors" />
    <form method="POST" action="{{ route('login') }}">
    @csrf
        <div class="formulario">
            <label for="email">E-Mail</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div class="formulario">
            <label for="password">Contraseña</label>

            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
        </div>
        <div class="boton"><button type="submit" class="btn btn-primary">Iniciar Sesión</button></div>
        <div class="boton">O</div>
        <a class="iniciar" id="git" href="/auth/github/redirect"><label>Inicia Sesión con Github</label><img class="socialite" src="https://cdn-icons-png.flaticon.com/512/25/25231.png"></a>
	    <a class="iniciar" id="face" href="/auth/facebook/redirect"><label>Inicia Sesión con Facebook</label><img class="socialite" src="https://images.vexels.com/media/users/3/223136/isolated/preview/984f500cf9de4519b02b354346eb72e0-facebook-icon-redes-sociales.png"></a>
		<a class="iniciar" id="google" href="/auth/google/redirect"><label>Inicia Sesión con Google</label><img class="socialite" src="https://cdn-icons-png.flaticon.com/512/2965/2965278.png"></a>
        <div class="boton">¿No estas Registrado?</div>
        <div class="boton"><a class="btn btn-danger" href="{{ route('register') }}">Regístrate</a></div>
    </form> 
    
</body>
</html>
                