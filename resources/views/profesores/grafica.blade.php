@extends("layouts.app1")

@section('contenido')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <a href="{{route('cursos.index')}}" class="btn btn-success my-2">Volver</a>
    <canvas id="bar-chart" width="800" height="450"></canvas>

    <script>
        new Chart(document.getElementById("bar-chart"), {
            type: 'doughnut',
            data: {
                labels: ['{!! $nombreProfesores !!}'],
                datasets: [{
                    label: "Num. alumnos",
                    backgroundColor: [{!! $colores !!}],
                    data: [{!! $cantidadAlumnos !!}, 0],
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Número de alumnos por profesor'
                }
            }
        });
    </script>



@endsection