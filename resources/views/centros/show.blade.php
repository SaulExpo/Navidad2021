
@extends('layouts.app1')

@section("contenido")

<style>
	#mapDiv {
        height: 500px;
        width: 100%;
        padding: 15px;
    }
</style>

<h1>{{$centro->nombre}}</h1>
<a href="{{route('centros.create')}}" class="btn btn-success my-2">+ Insertar</a>
<table id="tabla" class="ui yellow table" style="text-align: center;">
	<thead>
		<tr><th>Nombre</th><th>Calle</th><th>Email</th><th>Teléfono</th><th>Web</th><th>Número de cursos</th><th>Borrar</th><th>Editar</th><th>Mapa</th></tr>
	</thead>
	<tbody>
		<tr data-id="{{$centro->id}}">
			<td>{{$centro->nombre}}</td>
			<td>{{$centro->calle}}</td>
			<td>{{$centro->email}}</td>
            <td>{{$centro->telefono}}</td>
            <td>{{$centro->web}}</td>
			<td class='show_cursos'>{{$centro->cursos->count()}}</td>
			<td><img class='btn_borrar' width="32px" src="https://cdn.iconscout.com/icon/free/png-256/recycle-bin-1-461646.png"></td>
			<td><a href='{{url("centros/$centro->id/edit")}}'><img class='btn_editar' width="32px" src="https://cdn.iconscout.com/icon/free/png-256/edit-2653317-2202989.png"></a></td>
			<td class='enlace_mapa' data-latitud='{{$centro->latitud}}' data-longitud='{{$centro->longitud}}'><img class='btn_show' width="32px" src="https://cdn-icons-png.flaticon.com/512/64/64113.png"></td>
		</tr>
	</tbody>	
</table>

<!-- Modal -->
<div class="modal fade" id="modal_mapa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 modal_body_map">
                            <div class="location-map" id="location-map">
                                <div id="mapDiv"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<script>

	function getMap(latitud, longitud) {
            var mapOptions = { //objeto para crear un mapa
                mapTypeId: Microsoft.Maps.MapTypeId.aerial,
                center: new Microsoft.Maps.Location(latitud, longitud),
                zoom: 15,
            };
            // Initialize the map
            map = new Microsoft.Maps.Map(document.getElementById("mapDiv"), mapOptions);
            const centro = new Microsoft.Maps.Location(latitud, longitud);
            const pushpin = new Microsoft.Maps.Pushpin(centro, {
                color: "green"
            });
            map.entities.push(pushpin);
        }

	$(document).ready(function(){
		$("#tabla").DataTable({
			language: { url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" },
            rowReorder: true,
		});

		$('#tabla').on('click', '.enlace_mapa', function() {
                const latitud = $(this).data('latitud');
                const longitud = $(this).data('longitud');
                getMap(latitud, longitud);
                $('#modal_mapa').modal('show');
        });

		$(".btn_borrar").click(function(){
			const $tr=$(this).closest("tr");
			const id=$tr.data("id");
			
			Swal.fire({
			  title: '¿Estás seguro que quieres borrar este centro?',
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
					url		: "{{url('/centros')}}/"+id,
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