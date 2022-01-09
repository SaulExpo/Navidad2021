
@extends('layouts.app1')

@section("contenido")

<style>
	#mapDiv {
        height: 500px;
        width: 100%;
        padding: 15px;
    }
</style>

<h1>Centros</h1>
<a href="{{route('centros.create')}}" class="btn btn-success my-2">+ Insertar</a>
<a href="{{route('centros.pdf')}}" class="btn btn-info my-2">Generar PDF</a>
<a href="{{route('centros.grafica')}}" class="btn btn-danger my-2">Gráfica</a>
<table id="tabla" class="ui yellow table" style="text-align: center;">
	<thead>
		<tr><th>Nombre</th><th>Calle</th><th>Email</th><th>Teléfono</th><th>Web</th><th>Número de cursos</th><th>Borrar</th><th>Editar</th><th>Mostrar</th><th>Mapa</th></tr>
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
			<td><img class='btn_borrar' width="32px" src="https://cdn.iconscout.com/icon/free/png-256/recycle-bin-1-461646.png"></td>
			<td><a href='{{url("centros/$centro->id/edit")}}'><img class='btn_editar' width="32px" src="https://cdn.iconscout.com/icon/free/png-256/edit-2653317-2202989.png"></a></td>
      <td><a href='{{url("centros/$centro->id")}}'><img class='btn_show' width="32px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Eye_open_font_awesome.svg/1200px-Eye_open_font_awesome.svg.png"></a></td>
      <td class='enlace_mapa' data-latitud='{{$centro->latitud}}' data-longitud='{{$centro->longitud}}'><img class='btn_show' width="32px" src="https://cdn-icons-png.flaticon.com/512/64/64113.png"></td>
    </tr>
		
	@endforeach
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


<!-- Modal -->
<div class="modal fade" id="cursos_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cursos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal_body" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="profesores_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Profesores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal_body_profesores" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="alumnos_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alumnos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal_body_alumnos" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

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
		
		$(".show_cursos").click(function(){
            const centroId=$(this).closest("tr").data("id");
            $.ajax({
                url    : "{{url('/cursos/listado')}}/"+centroId,
                success: function(datos){
					let htmlTable="<table class='table table-bordered table-striped'>";
					htmlTable+="<tr><th>Nombre</th><th>Abreviatura</th><th>Nivel</th><th>Año</th><th>Número de Profesores</th></tr>"
                    $("#modal_body").html("");
                    for(let i=0;i<datos.length;i++){
                      htmlProfesores=`<a href='#' class='show_profesores' data-id='${datos[i].id}'>${datos[i].num_profesores}</a>`;
						htmlTable+=`<tr data-id='${datos[i].id}'><td>${datos[i].nombre}</td><td>${datos[i].abreviatura}</td><td>${datos[i].nivel}</td><td>${datos[i].año}</td><td>${htmlProfesores}</td></tr>`;
                    }
					htmlTable+="</table>";
                    $("#modal_body").append(htmlTable);
                    $("#cursos_modal").modal();


                }
            })    
        })
		
		
        $("body").on("click",".show_profesores", function(e){
            e.preventDefault();
            console.log("estoy aqui");

            const cursoId=$(this).closest("tr").data("id");
            $.ajax({
                url    : "{{url('/profesores/listado')}}/"+cursoId,
                success: function(datos){
					console.log(datos)
					let htmlTable="<table class='table table-bordered table-striped'>";
					htmlTable+="<tr><th>Nombre</th><th>Fecha de Nacimiento</th><th>Email</th><th>Dni</th><th>Asignatura</th><th>Número de Alumnos</th></tr>"
                    $("#modal_body_profesores").html("");
                    for(let i=0;i<datos.length;i++){
						htmlAlumnos=`<a href='#' class='show_alumnos' data-id='${datos[i].id}'>${datos[i].num_alumnos}</a>`;
						htmlTable+=`<tr data-id='${datos[i].id}'><td>${datos[i].nombre} ${datos[i].apellidos}</td><td>${datos[i].f_nacimiento}</td><td>${datos[i].email}</td><td>${datos[i].dni}</td><td>${datos[i].asignatura_nombre} (${datos[i].asignatura_abreviatura})</td><td>${htmlAlumnos}</td></tr>`;
                    }
					htmlTable+="</table>";
                    $("#modal_body_profesores").append(htmlTable);
                    $("#profesores_modal").modal();


                }
            })    
        }) 

		$("body").on("click",".show_alumnos", function(e){
            e.preventDefault();
            console.log("estoy aqui");

            const profesorId=$(this).closest("tr").data("id");
            $.ajax({
                url    : "{{url('/alumnos/listado')}}/"+profesorId,
                success: function(datos){
					console.log(datos)
					let htmlTable="<table class='table table-bordered table-striped'>";
					htmlTable+="<tr><th>Nombre</th><th>Fecha de Nacimiento</th><th>Email</th><th>Dni</th><th>Número de Exámenes</th></tr>"
                    $("#modal_body_alumnos").html("");
                    for(let i=0;i<datos.length;i++){
						htmlExamenes=`<a href='#' class='show_examenes' data-id='${datos[i].id}'>${datos[i].num_examenes}</a>`;
						htmlTable+=`<tr data-id='${datos[i].id}'><td>${datos[i].nombre} ${datos[i].apellidos}</td><td>${datos[i].f_nacimiento}</td><td>${datos[i].email}</td><td>${datos[i].dni}</td><td>${htmlExamenes}</td></tr>`;
                    }
					htmlTable+="</table>";
                    $("#modal_body_alumnos").append(htmlTable);
                    $("#alumnos_modal").modal();


                }
            })    
        }) 

		$("body").on("click",".show_examenes", function(e){
            e.preventDefault();
            console.log("estoy aqui");

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