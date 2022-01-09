<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Profesor;
use App\Models\Examen;
use Illuminate\Http\Request;
use PDF;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listadoPdf(){
        $examenes=Examen::orderBy("id")->limit(10)->get();
        $pdf = PDF::loadView('examenes.pdf',compact("examenes"))->setPaper('a4', 'landscape');;
        return $pdf->download('listado_examenes.pdf');
    }

    public function listado($alumnoId){
        return Alumno::find($alumnoId)->examenes;
    }

    public function index()
    {
        $examenes=Examen::orderBy("id")->get();
         return view("examenes.index",compact("examenes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $alumnos = Alumno::orderBy("id")->get();
        $profesores = Profesor::orderBy("id")->get();
        return view("examenes.create",compact("alumnos", "profesores"));
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
			'nota' => 'required  |integer | max:10 | min:0',
		]);

        $datos=$request->all();
		Examen::create($datos);
		return redirect("/examenes");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Examen  $examen
     * @return \Illuminate\Http\Response
     */
    public function show(Examen $examen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Examen  $examen
     * @return \Illuminate\Http\Response
     */
    public function edit(Examen $examene)
    {

        $alumnos = Alumno::orderBy("id")->get();
        $profesores = Profesor::orderBy("id")->get();
        return view("examenes.create",compact("examene", "alumnos", "profesores"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Examen  $examen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examen $examene)
    {

        $validated = $request->validate([
			'nota' => 'required  |integer | max:10 | min:0',
		]);

        $datos=$request->all();
		$examene->update($datos);
		return redirect("/examenes");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Examen  $examen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examen $examene)
    {
        if ($examene){
			$examene->delete();
			return "ok";
		}else{
			return "error";
		}
    }
}
