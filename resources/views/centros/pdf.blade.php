
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<table id="tabla" class="ui yellow table" style="text-align: center;">
	<thead>
		<tr><th>Nombre</th><th>Calle</th><th>Email</th><th>Teléfono</th><th>Web</th><th>Número de cursos</th></tr>
	</thead>
	<tbody>
	@foreach($centros as $centro)
		<tr data-id="{{$centro->id}}">
			<td>{{$centro->nombre}}</td>
			<td>{{$centro->calle}}</td>
			<td>{{$centro->email}}</td>
            <td>{{$centro->telefono}}</td>
            <td>{{$centro->web}}</td>
			<td class='show_cursos'>{{$centro->cursos->count()}}</td>
		</tr>
	@endforeach
	</tbody>	
</table>