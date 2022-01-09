@extends("layouts.app1")

@section('contenido')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <a href="{{route('cursos.index')}}" class="btn btn-success my-2">Volver</a>
    <canvas id="bar-chart" width="1600" height="450"></canvas>
    <canvas id="bar-chart2" width="1600" height="450"></canvas>

    <script>
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: ['{!! $nombreAlumnos !!}'],
                datasets: [{
                    label: "Num. profesores",
                    backgroundColor: [{!! $colores !!}],
                    data: [{!! $cantidadProfesores !!}, 0],
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Número de profesores por alumno'
                }
            }
        });
    </script>

<script>
        new Chart(document.getElementById("bar-chart2"), {
            type: 'bar',
            data: {
                labels: ['{!! $nombreAlumnos !!}'],
                datasets: [{
                    label: "Num. examenes",
                    backgroundColor: [{!! $colores !!}],
                    data: [{!! $cantidadExamenes !!}, 0],
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Número de examenes por alumno'
                }
            }
        });
    </script>



@endsection