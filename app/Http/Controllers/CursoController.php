<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Centro;
use App\Models\Profesor;
use Illuminate\Http\Request;
use PDF;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listadoPdf(){
        $cursos=Curso::orderBy("nombre")->limit(10)->get();
        $pdf = PDF::loadView('cursos.pdf',compact("cursos"))->setPaper('a4', 'landscape');;
        return $pdf->download('listado_cursos.pdf');
    }

    public function grafica()
    {
        $cantidad = Curso::count();
        $nombreCursos = Curso::orderBy("id")->pluck('nombre')->join("','");
        $cantidadProfesores = Profesor::selectRaw('curso_id, count(*) as cantidad')->groupBy('curso_id')->pluck('cantidad')->join(',');

        $colores = join(",", array_map('randomColor', range(0, $cantidad - 1)));

        return view('cursos.grafica', compact('nombreCursos', 'cantidadProfesores', 'colores'));
    }

    public function listado($centroId){
        return Centro::find($centroId)->cursos;
    }

    public function index()
    {
        $cursos=Curso::orderBy("id")->get();
        return view("cursos.index",compact("cursos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $centros = Centro::orderBy("id")->get();
        return view("cursos.create",compact("centros"));
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
			'nivel' => 'required | regex:/^[1-2]$/i',
            'año' => 'regex:/^[0-9]{4}$/i'
		]);

        $datos=$request->all();
		Curso::create($datos);
		return redirect("/cursos");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        $centros = Centro::orderBy("id")->get();
        return view("cursos.create",compact("curso", "centros"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
        $validated = $request->validate([
			'nivel' => 'required | regex:/^[1-2]$/i',
            'año' => 'regex:/^[0-9]{4}$/i',
		]);

        $datos=$request->all();
		$curso->update($datos);
		return redirect("/cursos");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        if ($curso){   //si centro se encontrรณ
			$curso->delete();
			return "ok";
		}else{
			return "error";
		}
    }
}
