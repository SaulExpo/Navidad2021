
@extends('layouts.app1')

@section("contenido")
<h1>Profesores</h1>
<a href="{{route('profesores.create')}}" class="btn btn-success my-2">+ Insertar</a>
<a href="{{route('profesores.pdf')}}" class="btn btn-info my-2">Generar PDF</a>
<a href="{{route('profesores.grafica')}}" class="btn btn-danger my-2">Gráfica</a>
<table id="tabla" class="ui red table" style="text-align: center;">
	<thead>
		<tr><th>Nombre</th><th>Apellido</th><th>Fecha de Nacimiento</th><th>Email</th><th>Dni</th><th>Teléfono</th><th>Alumnos</th><th>Asignatura</th><th>Curso</th><th>Centro</th><th>Borrar</th><th>Editar</th><th>Mostrar</th></tr>
	</thead>
	<tbody>
	@foreach($profesores as $profesor)
		<tr data-id="{{$profesor->id}}">
			<td>{{$profesor->nombre}}</td>
			<td>{{$profesor->apellidos}}</td>
			<td>{{\Carbon\Carbon::parse($profesor->f_nacimiento)->format('d/m/Y')}}</td>
            <td>{{$profesor->email}}</td>
            <td>{{$profesor->dni}}</td>
            <td>{{$profesor->telefono}}</td>
			<td><ul>@foreach($profesor->alumnos as $alumno)<li>{{$alumno->nombre}}</li>@endforeach</ul></td>
            <td>{{$profesor->asignatura_nombre}} ({{$profesor->asignatura_abreviatura}})</td>
			<td>{{$profesor->curso->nombre}}</td>
			<td>{{$profesor->curso->centro->nombre}}</td>
			<td><img class='btn_borrar' width="32px" src="https://cdn.iconscout.com/icon/free/png-256/recycle-bin-1-461646.png"></td>
			<td><a href='{{url("profesores/$profesor->id/edit")}}'><img class='btn_editar' width="32px" src="https://cdn.iconscout.com/icon/free/png-256/edit-2653317-2202989.png"></a></td>
			<td><a href='{{url("profesores/$profesor->id")}}'><img class='btn_show' width="32px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Eye_open_font_awesome.svg/1200px-Eye_open_font_awesome.svg.png"></a></td>
		</tr>
		
		
	@endforeach
	</tbody>	
</table>


<script>
	$(document).ready(function(){
		$("#tabla").DataTable({
			language: { url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" },
            rowReorder: true,
		});
		
		$(".btn_borrar").click(function(){
			const $tr=$(this).closest("tr");
			const id=$tr.data("id");
			
			Swal.fire({
			  title: '¿Estás seguro que quieres borrar este profesor?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Borrar',
			  cancelButtonText: 'Cancelar',
			}).then((result) => {
			  if (result.isConfirmed) {	//se pulsó el botón de confirmado
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
				$.ajax({
					method  : "POST",
					url		: "{{url('/profesores')}}/"+id,
					data    : {
						_method    : 'DELETE',
						_token  : "{{csrf_token()}}", 
					},
					success : function() {
						$tr.fadeOut()
					} 

				})	  
		  }
			})
					
		});
		
	});

</script>

@endsection