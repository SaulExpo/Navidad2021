@extends("layouts.app1")


@section("contenido")

	<h3>Formulario para @if (isset($alumno)) actualizar @else insertar @endif</h3>

<form method="POST" action="{{isset($alumno)?route('alumnos.update',[$alumno->id]):route('alumnos.store')}}">
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre"  value='{{$alumno->nombre??''}}'>
  </div>
  <div class="form-group">
    <label for="apellidos">Apellido</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos"  value='{{$alumno->apellidos??''}}'>
  </div>
  <div class="form-group">
    <label for="f_nacimiento">Fecha de nacimiento</label>
    <input type="date" class="form-control" id="f_nacimiento" name="f_nacimiento"  value='{{$alumno->f_nacimiento??''}}'>
  </div>
  <div class="form-group">
    <label for="email">Correo</label>
    <input type="email" class="form-control" id="email" name="email"  value='{{$alumno->email??''}}'>
  </div>
  <div class="form-group">
    <label for="dni">DNI</label>
    <input type="text" class="form-control" id="dni" name="dni"  value='{{$alumno->dni??''}}'>
  </div>
  <div class="form-group">
    <label for="profesor_id">Profesor</label>
    <select style="width: 100%" id="profesor_id" class="form-control select2" name="profesor_id[]" multiple="multiple">
		@foreach($profesores as $profesor)
		  <option value="{{$profesor->id}}">{{$profesor->nombre}} {{$profesor->apellidos}}, del centro: {{$profesor->curso->centro->nombre}}</option>
		@endforeach
	  </select>
  </div>
	@csrf
	
	@if (isset($alumno))
		<input type="hidden" name="_method" value="PUT">
	@endif
  <button type="submit" class="btn btn-primary">{{isset($alumno)? 'Actualizar':'Insertar'}}</button>
  <a href="{{route('alumnos.index')}}" class="btn btn-secondary">Volver</a>
</form>

<script>
	$(document).ready(function() {
		$('.select2').select2();
	});
	var selectedValues = $("#sourceValues").val().split(',');
	$(".select2").val(selectedValues).trigger("change");
</script>

@endsection