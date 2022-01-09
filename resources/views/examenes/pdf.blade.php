<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<table id="tabla" class="ui purple table" style="text-align: center;">
	<thead>
		<tr><th>Alumno</th><th>Nota</th><th>Fecha</th><th>Asignatura</th></tr>
	</thead>
	<tbody>
	@foreach($examenes as $examen)
		<tr data-id="{{$examen->id}}">
			<td>{{$examen->alumno->nombre}} {{$examen->alumno->apellidos}}</td>
			<td>{{$examen->nota}}</td>
			<td>{{\Carbon\Carbon::parse($examen->fecha)->format('d/m/Y')}}</td>
			<td>{{$examen->profesor->asignatura_nombre}}</td>
		</tr>
	@endforeach
	</tbody>	
</table>