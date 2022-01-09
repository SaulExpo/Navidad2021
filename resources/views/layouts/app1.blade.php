<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="https://static.thenounproject.com/png/601086-200.png">
        <title>Gestion de Centros</title>

<link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">
<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key={{env('BING_MAP_API_KEY')}}' defer></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>

  body{
    height: fit-content;
    padding: 30px;
  }

  .eleccion{
    text-align: center;
    font-size: 1.5em;
  }

  a{
    color: black;
  }

  a:hover{
    color:red;
  }

  .eleccion_img{
    margin:20px;
    width: 70px;
  }

  .navbar{
    margin: -30px;
    border-bottom: 2px solid black;
    padding-top: 20px;
    background-color: #fad2c5;
    margin-bottom: 30px;
  }

  .container{
    margin-bottom: 20px;
  }

  

</style>

<nav class="navbar navbar-light justify-content-between">
<a class="eleccion" href="/dashboard"><div>Volver</div><img class="eleccion_img" src="http://cdn.onlinewebfonts.com/svg/img_68649.png"></a>
  <a class="eleccion" href="/centros"><div>Centros</div><img class="eleccion_img" src="https://static.thenounproject.com/png/601086-200.png"></a>
  <a class="eleccion" href="/cursos"><div>Cursos</div><img class="eleccion_img" src="http://cdn.onlinewebfonts.com/svg/img_383123.png"></a>
  <a class="eleccion" href="/profesores"><div>Profesores</div><img class="eleccion_img" src="https://cdn1.iconfinder.com/data/icons/occupations-3/100/21-512.png"></a>
  <a class="eleccion" href="/alumnos"><div>Alumnos</div><img class="eleccion_img" src="https://www.nicepng.com/png/full/121-1215004_graduation-icon-png-image-college-student-icon-png.png"></a>
  <a class="eleccion" href="/examenes"><div>Examenes</div><img class="eleccion_img" src="https://i.pinimg.com/originals/a2/e0/bf/a2e0bf4f409bc2e9836f79954313832a.png"></a>
</nav>


<div class="container">
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	@yield("contenido")
</div>