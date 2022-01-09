<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $appends = ['num_examenes'];

    public function getNumExamenesAttribute(){
        return $this->hasMany('App\Models\Examen')->count();
    }

    public function edad(){
        $number = \Carbon\Carbon::parse($this->f_nacimiento)->age;
        return $number;
    }

    public function examenes()
    {
        return $this->hasMany(Examen::class);
    }

    public function profesores()
    {
        return $this->belongsToMany(Profesor::class);
    }
}
