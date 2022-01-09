@extends("layouts.app1")


@section("contenido")

	<h3>Formulario para @if (isset($curso)) actualizar @else insertar @endif</h3>

<form method="POST" action="{{isset($curso)?route('cursos.update',[$curso->id]):route('cursos.store')}}">
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre"  value='{{$curso->nombre??''}}'>
  </div>
  <div class="form-group">
    <label for="abreviatura">Abreviatura</label>
    <input type="text" class="form-control" id="abreviatura" name="abreviatura"  value='{{$curso->abreviatura??''}}'>
  </div>
  <div class="form-group">
    <label for="nivel">Nivel (1 o 2)</label>
    <input type="number" class="form-control" id="nivel" name="nivel"  value='{{$curso->nivel??''}}'>
  </div>
  <div class="form-group">
    <label for="año">Año (yyyy)</label>
    <input type="text" class="form-control" id="año" name="año"  value='{{$curso->año??''}}'>
  </div>
  <div class="form-group">
    <label for="centro_id">Centro</label>
    <select style="width: 100%" id="centro_id" class="form-control select2" name="centro_id">
		@foreach($centros as $centro)
		  <option value="{{$centro->id}}">{{$centro->nombre}}</option>
		@endforeach
	  </select>
  </div>
	@csrf
	
	@if (isset($curso))
		<input type="hidden" name="_method" value="PUT">
	@endif
  <button type="submit" class="btn btn-primary">{{isset($curso)? 'Actualizar':'Insertar'}}</button>
  <a href="{{route('cursos.index')}}" class="btn btn-secondary">Volver</a>
</form>

<script>
	$(document).ready(function() {
		$('.select2').select2();
	});
	var selectedValues = $("#sourceValues").val().split(',');
	$(".select2").val(selectedValues).trigger("change");
</script>

@endsection