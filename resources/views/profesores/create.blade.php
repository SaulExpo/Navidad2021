@extends("layouts.app1")


@section("contenido")

	<h3>Formulario para @if (isset($profesore)) actualizar @else insertar @endif</h3>

<form method="POST" action="{{isset($profesore)?route('profesores.update',[$profesore->id]):route('profesores.store')}}">
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre"  value='{{$profesore->nombre??''}}'>
  </div>
  <div class="form-group">
    <label for="apellidos">Apellido</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos"  value='{{$profesore->apellidos??''}}'>
  </div>
  <div class="form-group">
    <label for="f_nacimiento">Fecha de nacimiento</label>
    <input type="date" class="form-control" id="f_nacimiento" name="f_nacimiento"  value='{{$profesore->f_nacimiento??''}}'>
  </div>
  <div class="form-group">
    <label for="email">Correo</label>
    <input type="email" class="form-control" id="email" name="email"  value='{{$profesore->email??''}}'>
  </div>
  <div class="form-group">
    <label for="dni">DNI</label>
    <input type="text" class="form-control" id="dni" name="dni"  value='{{$profesore->dni??''}}'>
  </div>
  <div class="form-group">
    <label for="telefono">Telefono</label>
    <input type="text" class="form-control" id="telefono" name="telefono"  value='{{$profesore->telefono??''}}'>
  </div>
  <div class="form-group">
    <label for="asignatura_nombre">Asignatura</label>
    <input type="text" class="form-control" id="asignatura_nombre" name="asignatura_nombre"  value='{{$profesore->asignatura_nombre??''}}'>
  </div>
  <div class="form-group">
    <label for="asignatura_abreviatura">Abreviatura de asignatura</label>
    <input type="text" class="form-control" id="asignatura_abreviatura" name="asignatura_abreviatura"  value='{{$profesore->asignatura_abreviatura??''}}'>
  </div>
  <div class="form-group">
    <label for="curso_id">Curso</label>
    <select style="width: 100%" id="curso_id" class="form-control select2" name="curso_id">
		@foreach($cursos as $curso)
		  <option value="{{$curso->id}}">{{$curso->nombre}} del centro: {{$curso->centro->nombre}} </option>
		@endforeach
	  </select>
  </div>
  <div class="form-group">
    <label for="alumno_id">Alumnos</label>
    <select style="width: 100%" id="alumno_id" class="form-control select2" name="alumno_id[]" multiple="multiple">
		@foreach($alumnos as $alumno)
		  <option value="{{$alumno->id}}">{{$alumno->nombre}} {{$alumno->apellidos}}</option>
		@endforeach
	  </select>
  </div>
	@csrf
	
	@if (isset($profesore))
		<input type="hidden" name="_method" value="PUT">
	@endif
  <button type="submit" class="btn btn-primary">{{isset($profesore)? 'Actualizar':'Insertar'}}</button>
  <a href="{{route('profesores.index')}}" class="btn btn-secondary">Volver</a>
</form>

<script>
	$(document).ready(function() {
		$('.select2').select2();
	});
	var selectedValues = $("#sourceValues").val().split(',');
	$(".select2").val(selectedValues).trigger("change");
</script>

@endsection