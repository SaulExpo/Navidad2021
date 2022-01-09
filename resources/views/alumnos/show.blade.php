
@extends('layouts.app1')

@section("contenido")

<h1>{{$alumno->nombre}} {{$alumno->apellidos}}</h1>
<div><img src="../fotos/{{$alumno->foto}}" alt=""></div>
<a href="{{route('alumnos.index')}}" class="btn btn-success my-2">Volver</a>
<table id="tabla" class="ui green table" style="text-align: center;">
	<thead>
		<tr><th>Nombre</th><th>Apellido</th><th>Fecha de Nacimiento</th><th>Email</th><th>Dni</th><th>Profesor</th><th>Curso</th><th>Centro</th><th>Edad</th><th>Número de Exámenes</th><th>Borrar</th><th>Editar</th></tr>
	</thead>
	<tbody>
		<tr data-id="{{$alumno->id}}">
			<td>{{$alumno->nombre}}</td>
			<td>{{$alumno->apellidos}}</td>
			<td>{{$alumno->f_nacimiento}}</td>
            <td>{{$alumno->email}}</td>
            <td>{{$alumno->dni}}</td>
			<td><ul>@foreach($alumno->profesores as $profesor)<li>{{$profesor->nombre}}</li>@endforeach</ul></td>
            <td>{{$alumno->profesores->first()->curso->nombre}} ({{$alumno->profesores->first()->curso->abreviatura}})</td>
			<td>{{$alumno->profesores->first()->curso->centro->nombre}}</td>
			<td>{{$alumno->edad()}}</td>
			<td class='show_examenes'><a href='{{url("alumnos/$alumno->id/examenes")}}'>{{$alumno->examenes->count()}}</a></td>
			<td><img class='btn_borrar' width="32px" src="https://cdn.iconscout.com/icon/free/png-256/recycle-bin-1-461646.png"></td>
			<td><a href='{{url("alumnos/$alumno->id/edit")}}'><img class='btn_editar' width="32px" src="https://cdn.iconscout.com/icon/free/png-256/edit-2653317-2202989.png"></a></td>
		</tr>
	</tbody>	
</table>

<!-- Modal -->
<div class="modal fade" id="examenes_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Examenes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal_body_examenes" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(document).ready(function(){
		$("#tabla").DataTable({
			language: { url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" },
            rowReorder: true,
		});

		$("body").on("click",".show_examenes", function(e){
            e.preventDefault();

            const alumnoId=$(this).closest("tr").data("id");
            $.ajax({
                url    : "{{url('/examenes/listado')}}/"+alumnoId,
                success: function(datos){
					console.log(datos)
					let htmlTable="<table class='table table-bordered table-striped'>";
					htmlTable+="<tr><th>Nota</th><th>Fecha</th></tr>"
                    $("#modal_body_examenes").html("");
                    for(let i=0;i<datos.length;i++){
						htmlTable+=`<tr><td>${datos[i].nota}</td><td> ${datos[i].fecha}</td></tr>`;
                    }
					htmlTable+="</table>";
					htmlTable2="<table class='table table-bordered table-striped'>"
					htmlTable2+="<tr><th>MEDIA</th></tr>"
					media = 0
					for(let i=0;i<datos.length;i++){
						media += datos[i].nota
					}
					total = media / datos.length+1
					htmlTable2+="<tr><td>"+total+"</td></tr>";
                    
					htmlTable2+="</table>";
                    $("#modal_body_examenes").append(htmlTable);
					$("#modal_body_examenes").append(htmlTable2);
                    $("#examenes_modal").modal(); 
                }
            })    
        }) 

		$(".btn_borrar").click(function(){
			const $tr=$(this).closest("tr");
			const id=$tr.data("id");
			
			Swal.fire({
			  title: '¿Estás seguro que quieres borrar este alumno?',
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
					url		: "{{url('/alumnos')}}/"+id,
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