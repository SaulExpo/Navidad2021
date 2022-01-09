<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Curso;
use Illuminate\Http\Request;
use PDF;

class CentroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listadoPdf(){
        $centros=Centro::orderBy("nombre")->limit(10)->get();
        $pdf = PDF::loadView('centros.pdf',compact("centros"))->setPaper('a4', 'landscape');;
        return $pdf->download('listado_centros.pdf');
    }

    public function grafica()
    {
        $cantidad = Centro::count();
        $nombreCentros = Centro::orderBy("id")->pluck('nombre')->join("','");
        $cantidadCursos = Curso::selectRaw('centro_id, count(*) as cantidad')->groupBy('centro_id')->pluck('cantidad')->join(',');

        $colores = join(",", array_map('randomColor', range(0, $cantidad - 1)));

        return view('centros.grafica', compact('nombreCentros', 'cantidadCursos', 'colores'));
    }

    public function index()
    {
        $centros=Centro::orderBy("id")->get();
        return view("centros.index",compact("centros"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("centros.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos=$request->all();
		Centro::create($datos);
		return redirect("/centros");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function show(Centro $centro)
    {
        return view("centros.show", compact("centro"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function edit(Centro $centro)
    {
        return view("centros.create",compact("centro"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Centro $centro)
    {
        $datos=$request->all();
		$centro->update($datos);
		return redirect("/centros");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Centro $centro)
    {
        if ($centro){   //si centro se encontrรณ
			$centro->delete();
			return "ok";
		}else{
			return "error";
		}
    }
}
