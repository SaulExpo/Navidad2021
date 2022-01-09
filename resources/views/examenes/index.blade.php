
@extends('layouts.app1')

@section("contenido")
<h1>Examenes</h1>
<a href="{{route('examenes.create')}}" class="btn btn-success my-2">+ Insertar</a>
<a href="{{route('examenes.pdf')}}" class="btn btn-info my-2">Generar PDF</a>
<table id="tabla" class="ui purple table" style="text-align: center;">
	<thead>
		<tr><th>Alumno</th><th>Nota</th><th>Fecha</th><th>Asignatura</th><th>Borrar</th><th>Editar</th></tr>
	</thead>
	<tbody>
	@foreach($examenes as $examen)
		<tr data-id="{{$examen->id}}">
			<td>{{$examen->alumno->nombre}} {{$examen->alumno->apellidos}}</td>
			<td>{{$examen->nota}}</td>
			<td>{{\Carbon\Carbon::parse($examen->fecha)->format('d/m/Y')}}</td>
			<td>{{$examen->profesor->asignatura_nombre}}</td>
			<td><img class='btn_borrar' width="32px" src="https://cdn.iconscout.com/icon/free/png-256/recycle-bin-1-461646.png"></td>
			<td><a href='{{url("examenes/$examen->id/edit")}}'><img class='btn_editar' width="32px" src="https://cdn.iconscout.com/icon/free/png-256/edit-2653317-2202989.png"></a></td>
        </tr>
		
		
	@endforeach
	</tbody>	
</table>


<script>
	$(document).ready(function(){
		$("#tabla").DataTable({
			language: { url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" },
            rowReorder: true,
            columnDefs: [
            { orderable: true, className: 'reorder', targets: 0 },
			{ orderable: true, className: 'reorder', targets: 1 },
            { orderable: false, targets: '_all' }
            ]
		});
		
		$(".btn_borrar").click(function(){
			const $tr=$(this).closest("tr");
			const id=$tr.data("id");
			
			Swal.fire({
			  title: '¿Estás seguro que quieres borrar este examen?',
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
					url		: "{{url('/examenes')}}/"+id,
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