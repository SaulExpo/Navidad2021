
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<table id="tabla" class="ui green table" style="text-align: center;">
	<thead>
		<tr><th>Nombre</th><th>Apellido</th><th>Fecha de Nacimiento</th><th>Email</th><th>Dni</th><th>Profesor</th><th>Curso</th><th>Centro</th><th>Número de Exámenes</th><th>Borrar</th><th>Editar</th><th>Mostrar</th></tr>
	</thead>
	<tbody>
	@foreach($alumnos as $alumno)
		<tr data-id="{{$alumno->id}}">
			<td>{{$alumno->nombre}}</td>
			<td>{{$alumno->apellidos}}</td>
			<td>{{\Carbon\Carbon::parse($alumno->f_nacimiento)->format('d/m/Y')}}</td>
            <td>{{$alumno->email}}</td>
            <td>{{$alumno->dni}}</td>
			<td><ul>@foreach($alumno->profesores as $profesor)<li>{{$profesor->nombre}}</li>@endforeach</ul></td>
            <td>{{$alumno->profesores->first()->curso->nombre}} ({{$alumno->profesores->first()->curso->abreviatura}})</td>
			<td>{{$alumno->profesores->first()->curso->centro->nombre}}</td>
		</tr>
	@endforeach
	</tbody>	
</table>
