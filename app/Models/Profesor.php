<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    protected $table="profesores";
    protected $guarded=[];
    protected $appends = ['num_alumnos'];

    public function getNumAlumnosAttribute(){
        return $this->alumnos->count();
    }

    // public function alumnos()
    // {
    //     return $this->hasMany(Alumno::class);
    // }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function examenes()
    {
        return $this->hasMany(Examen::class);
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class);
    }
}
