
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<table id="tabla" class="ui blue table" style="text-align: center;">
	<thead>
		<tr><th>Nombre</th><th>Abreviatura</th><th>Nivel</th><th>Año</th><th>Centro</th></tr>
	</thead>
	<tbody>
	@foreach($cursos as $curso)
		<tr data-id="{{$curso->id}}">
			<td>{{$curso->nombre}}</td>
			<td>{{$curso->abreviatura}}</td>
			<td>{{$curso->nivel}}</td>
            <td>{{$curso->año}}</td>
			<td>{{$curso->centro->nombre}}</td>
		</tr>
	@endforeach
	</tbody>	
</table>