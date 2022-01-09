<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Models\Curso;
use App\Models\Alumno;
use App\Models\Alumno_Profesor;
use Illuminate\Http\Request;
use PDF;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function grafica()
    {
        $cantidad = Profesor::count();
        $nombreProfesores = Profesor::orderBy("id")->pluck('nombre')->join("','");
        $cantidadAlumnos = Alumno_Profesor::selectRaw('profesor_id, count(*) as cantidad')->groupBy('profesor_id')->pluck('cantidad')->join(',');
        
        $colores = join(",", array_map('randomColor', range(0, $cantidad - 1)));

        return view('profesores.grafica', compact('nombreProfesores', 'cantidadAlumnos', 'colores'));
    }

    public function listadoPdf(){
        $profesores=Profesor::orderBy("nombre")->limit(10)->get();
        $pdf = PDF::loadView('profesores.pdf',compact("profesores"))->setPaper('a4', 'landscape');;
        return $pdf->download('listado_profesores.pdf');
    }

    public function listado($cursoId){
        return Curso::find($cursoId)->profesores;
    }

    public function index()
    {
        $profesores=Profesor::orderBy("id")->get();
        return view("profesores.index",compact("profesores"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alumnos=Alumno::orderBy("id")->get();
        $cursos=Curso::orderBy("id")->get();
        return view("profesores.create",compact("alumnos", "cursos"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
			'nombre' => 'required',
			'dni' => 'required | regex:/^[x]*\d{8}[a-z]$/i',
			'alumno_id' => 'required',
            'curso_id' => 'required',
		]);

        $profesor = new Profesor;
        $profesor->nombre = $request->nombre;
        $profesor->apellidos = $request->apellidos;
        $profesor->f_nacimiento = $request->f_nacimiento;
        $profesor->email = $request->email;
        $profesor->dni = $request->dni;
        $profesor->telefono = $request->telefono;
        $profesor->asignatura_nombre = $request->asignatura_nombre;
        $profesor->asignatura_abreviatura = $request->asignatura_abreviatura;
        $profesor->curso_id = $request->curso_id;
        $profesor->save();
        $alumno_profesor = [];
        foreach($request->alumno_id as $alumno){
            $alumno_profesor[] = [
                'alumno_id' => $alumno,
                'profesor_id' => $profesor->id
            ];
        }
        Alumno_Profesor::insert($alumno_profesor);
		return redirect("/profesores");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profesor=Profesor::find($id);
        return view("profesores.show", compact("profesor"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesor $profesore)
    {
        $alumnos=Alumno::orderBy("id")->get();
        $cursos=Curso::orderBy("id")->get();
		return view("profesores.create",compact("profesore", "alumnos", "cursos"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profesor $profesore)
    {
        $validated = $request->validate([
			'nombre' => 'required',
			'dni' => 'required | regex:/^[x]*\d{8}[a-z]$/i',
            'alumno_id' => 'required',
            'curso_id' => 'required',
		]);

        $datos=$request->all();
		$profesore->update($datos);
		return redirect("/profesores");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profesor $profesore)
    {
        if ($profesore){   //si centro se encontrรณ
			$profesore->delete();
			return "ok";
		}else{
			return "error";
		}
    }
}
