<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<table id="tabla" class="ui red table" style="text-align: center;">
	<thead>
		<tr><th>Nombre</th><th>Fecha de Nacimiento</th><th>Email</th><th>Dni</th><th>Teléfono</th><th>Asignatura</th><th>Curso</th><th>Centro</th></tr>
	</thead>
	<tbody>
	@foreach($profesores as $profesor)
		<tr data-id="{{$profesor->id}}">
			<td>{{$profesor->nombre}} {{$profesor->apellidos}}</td>
			<td>{{\Carbon\Carbon::parse($profesor->f_nacimiento)->format('d/m/Y')}}</td>
            <td>{{$profesor->email}}</td>
            <td>{{$profesor->dni}}</td>
            <td>{{$profesor->telefono}}</td>
            <td>{{$profesor->asignatura_nombre}} ({{$profesor->asignatura_abreviatura}})</td>
			<td>{{$profesor->curso->nombre}}</td>
			<td>{{$profesor->curso->centro->nombre}}</td>
		</tr>
	@endforeach
	</tbody>	
</table>