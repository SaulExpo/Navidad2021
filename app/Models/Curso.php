<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $appends = ['num_profesores'];

    public function getNumProfesoresAttribute(){
        return $this->hasMany('App\Models\Profesor')->count();
    }

    public function profesores()
    {
        return $this->hasMany(Profesor::class);
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
}
