<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Models\Alumno;
use App\Models\Examen;
use App\Models\Alumno_Profesor;
use Illuminate\Http\Request;
use PDF;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listado($profesorId){
        return Profesor::find($profesorId)->alumnos;
    }

    public function grafica()
    {
        $cantidad = Alumno::count();
        $nombreAlumnos = Alumno::orderBy("id")->pluck('nombre')->join("','");
        $cantidadProfesores = Alumno_Profesor::selectRaw('alumno_id, count(*) as cantidad')->groupBy('alumno_id')->pluck('cantidad')->join(',');
        $cantidadExamenes = Examen::selectRaw('alumno_id, count(*) as cantidad')->groupBy('alumno_id')->pluck('cantidad')->join(',');

        $colores = join(",", array_map('randomColor', range(0, $cantidad - 1)));

        return view('alumnos.grafica', compact('nombreAlumnos', 'cantidadProfesores', 'cantidadExamenes', 'colores'));
    }

    public function listadoPdf(){
        $alumnos=Alumno::orderBy("nombre")->limit(10)->get();
        $pdf = PDF::loadView('alumnos.pdf',compact("alumnos"))->setPaper('a4', 'landscape');;
        return $pdf->download('listado_alumnos.pdf');
    }

    public function index()
    {
        $alumnos=Alumno::orderBy("id")->get();
        return view("alumnos.index",compact("alumnos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $profesores=Profesor::orderBy("id")->get();
        return view("alumnos.create",compact("profesores"));
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
            'profesor_id' => 'required'
		]);

        $alumno = new Alumno;
        $alumno->nombre = $request->nombre;
        $alumno->apellidos = $request->apellidos;
        $alumno->f_nacimiento = $request->f_nacimiento;
        $alumno->email = $request->email;
        $alumno->dni = $request->dni;
        $alumno->save();
        $alumno_profesor = [];
        foreach($request->profesor_id as $profesor){
            $alumno_profesor[] = [
                'alumno_id' => $alumno->id,
                'profesor_id' => $profesor
            ];
        }
        Alumno_Profesor::insert($alumno_profesor);
		return redirect("/alumnos");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        return view("alumnos.show", compact("alumno"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        $profesores=Profesor::orderBy("id")->get();
		return view("alumnos.create",compact("alumno", "profesores"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {

        $validated = $request->validate([
			'nombre' => 'required',
			'dni' => 'required | regex:/^[x]*\d{8}[a-z]$/i',
            'profesor_id' => 'required'
		]);


        $alumno->nombre = $request->nombre;
        $alumno->apellidos = $request->apellidos;
        $alumno->f_nacimiento = $request->f_nacimiento;
        $alumno->email = $request->email;
        $alumno->dni = $request->dni;
        $alumno->update();
        $alumno_profesor = [];
        foreach($request->profesor_id as $profesor){
            $alumno_profesor[] = [
                'alumno_id' => $alumno->id,
                'profesor_id' => $profesor
            ];
        }
        Alumno_Profesor::insert($alumno_profesor);
		return redirect("/alumnos");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        if ($alumno){   //si centro se encontrรณ
			$alumno->delete();
			return "ok";
		}else{
			return "error";
		}
    }
}
