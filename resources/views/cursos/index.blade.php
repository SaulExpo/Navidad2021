
@extends('layouts.app1')

@section("contenido")
<h1>Cursos</h1>
<a href="{{route('cursos.create')}}" class="btn btn-success my-2">+ Insertar</a>
<a href="{{route('cursos.pdf')}}" class="btn btn-info my-2">Generar PDF</a>
<a href="{{route('cursos.grafica')}}" class="btn btn-danger my-2">Gráfica</a>
<table id="tabla" class="ui blue table" style="text-align: center;">
	<thead>
		<tr><th>Nombre</th><th>Abreviatura</th><th>Nivel</th><th>Año</th><th>Número de Profesores</th><th>Centro</th><th>Borrar</th><th>Editar</th></tr>
	</thead>
	<tbody>
	@foreach($cursos as $curso)
		<tr data-id="{{$curso->id}}">
			<td>{{$curso->nombre}}</td>
			<td>{{$curso->abreviatura}}</td>
			<td>{{$curso->nivel}}</td>
            <td>{{$curso->año}}</td>
			<td>{{$curso->profesores->count()}}</td>
			<td>{{$curso->centro->nombre}}</td>
			<td><img class='btn_borrar' width="32px" src="https://cdn.iconscout.com/icon/free/png-256/recycle-bin-1-461646.png"></td>
			<td><a href='{{url("cursos/$curso->id/edit")}}'><img class='btn_editar' width="32px" src="https://cdn.iconscout.com/icon/free/png-256/edit-2653317-2202989.png"></a></td>
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
			  title: '¿Estás seguro que quieres borrar este curso?',
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
					url		: "{{url('/cursos')}}/"+id,
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