@extends("layouts.app1")

@section('contenido')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <a href="{{route('centros.index')}}" class="btn btn-success my-2">Volver</a>
    <canvas id="bar-chart" width="800" height="450"></canvas>

    <script>
        console.log('{!! $nombreCentros !!}')
        console.log('{!! $cantidadCursos !!}')
        console.log('{!! $cantidadCursos !!}')
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: ['{!! $nombreCentros !!}'],
                datasets: [{
                    label: "Num. cursos",
                    backgroundColor: [{!! $colores !!}],
                    data: [{!! $cantidadCursos !!}, 0],
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Número de cursos por centro'
                }
            }
        });
    </script>



@endsection