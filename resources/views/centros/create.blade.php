@extends("layouts.app1")


@section("contenido")

	<h3>Formulario para @if (isset($centro)) actualizar @else insertar @endif</h3>

<form method="POST" action="{{isset($centro)?route('centros.update',[$centro->id]):route('centros.store')}}">
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre"  value='{{$centro->nombre??''}}'>
  </div>
  <div class="form-group">
    <label for="calle">Calle</label>
    <input type="text" class="form-control" id="calle" name="calle"  value='{{$centro->calle??''}}'>
  </div>
  <div class="form-group">
    <label for="email">Correo</label>
    <input type="email" class="form-control" id="email" name="email"  value='{{$centro->email??''}}'>
  </div>
  <div class="form-group">
    <label for="telefono">Telefono</label>
    <input type="text" class="form-control" id="telefono" name="telefono"  value='{{$centro->telefono??''}}'>
  </div>
  <div class="form-group">
    <label for="web">Web</label>
    <input type="text" class="form-control" id="web" name="web"  value='{{$centro->web??''}}'>
  </div>
	@csrf
	
	@if (isset($centro))
		<input type="hidden" name="_method" value="PUT">
	@endif
  <button type="submit" class="btn btn-primary">{{isset($centro)? 'Actualizar':'Insertar'}}</button>
  <a href="{{route('centros.index')}}" class="btn btn-secondary">Volver</a>
</form>
@endsection