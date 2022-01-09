<style>
    .eleccion_img{
        margin:20px;
        width: 70px;
    }

    .eleccion{
        display: inline-block;
    }

    .total{
        display: flex;
        text-align:center;
        justify-content: space-between;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Has Iniciado Sesión!
                </div>
                <div class="p-6 bg-white border-b border-gray-200 total">
                    <a class="eleccion" href="/centros"><div>Centros</div><img class="eleccion_img" src="https://static.thenounproject.com/png/601086-200.png"></a>
                    <a class="eleccion" href="/cursos"><div>Cursos</div><img class="eleccion_img" src="http://cdn.onlinewebfonts.com/svg/img_383123.png"></a>
                    <a class="eleccion" href="/profesores"><div>Profesores</div><img class="eleccion_img" src="https://cdn1.iconfinder.com/data/icons/occupations-3/100/21-512.png"></a>
                    <a class="eleccion" href="/alumnos"><div>Alumnos</div><img class="eleccion_img" src="https://www.nicepng.com/png/full/121-1215004_graduation-icon-png-image-college-student-icon-png.png"></a>
                    <a class="eleccion" href="/examenes"><div>Examenes</div><img class="eleccion_img" src="https://i.pinimg.com/originals/a2/e0/bf/a2e0bf4f409bc2e9836f79954313832a.png"></a>
                </div>
                
  
  
  
  
            </div>
        </div>
    </div>
</x-app-layout>
