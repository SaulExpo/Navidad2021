<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $table="examenes";
    use HasFactory;
    protected $guarded=[];
    
    public function get_asignatura(){
        return $this->profesor->count();
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
}
