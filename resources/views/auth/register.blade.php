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
        width: 600px;
        margin: 20px auto;
        display: flex;
        justify-content: space-between;
    }

    img{
        display: block;
        margin:auto;
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
    <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="formulario">
            <label for="name">Nombre</label>
            <input id="name" class="form-control" type="name" name="name" :value="old('name')" required autofocus />
        </div>

        <div class="formulario">
            <label for="email">E-Mail</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div class="formulario">
            <label for="password">Contraseña</label>

            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="formulario">
            <label for="password_confirmation">Confirmar Contraseña</label>

            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="current-password_confirmation" />
        </div>

        <div class="boton"><button type="submit" class="btn btn-primary">Registrarse</button></div>
        <div class="boton">¿Ya estas Registrado?</div>
        <div class="boton"><a class="btn btn-danger" href="{{ route('login') }}">Inicia Sesión</a></div>
    </form> 
    
</body>
</html>