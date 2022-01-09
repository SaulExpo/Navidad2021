@extends("layouts.app1")


@section("contenido")

	<h3>Formulario para @if (isset($examene)) actualizar @else insertar @endif</h3>

<form method="POST" action="{{isset($examene)?route('examenes.update',[$examene->id]):route('examenes.store')}}">
  <div class="form-group">
    <label for="nota">Nota</label>
    <input type="text" class="form-control" id="nota" name="nota"  value='{{$examene->nota??''}}'>
  </div>
  <div class="form-group">
    <label for="fecha">Fecha</label>
    <input type="date" class="form-control" id="fecha" name="fecha"  value='{{$examene->fecha??''}}'>
  </div>
  <div class="form-group">
    <label for="alumno_id">Alumno</label>
    <select style="width: 100%" id="alumno_id" class="form-control select2" name="alumno_id">
		@foreach($alumnos as $alumno)
		  <option value="{{$alumno->id}}">{{$alumno->nombre}} {{$alumno->apellidos}}</option>
		@endforeach
	  </select>
  </div>

  <div class="form-group">
    <label for="profesor_id">Profesor</label>
    <select style="width: 100%" id="profesor_id" class="form-control select2" name="profesor_id">
		@foreach($profesores as $profesor)
		  <option value="{{$profesor->id}}">{{$profesor->nombre}} {{$profesor->apellidos}}</option>
		@endforeach
	  </select>
  </div>
	@csrf
	
	@if (isset($examene))
		<input type="hidden" name="_method" value="PUT">
	@endif
  <button type="submit" class="btn btn-primary">{{isset($examene)? 'Actualizar':'Insertar'}}</button>
  <a href="{{route('examenes.index')}}" class="btn btn-secondary">Volver</a>
</form>

<script>
	$(document).ready(function() {
		$('.select2').select2();
	});
	var selectedValues = $("#sourceValues").val().split(',');
	$(".select2").val(selectedValues).trigger("change");
</script>

@endsection