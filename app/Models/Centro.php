<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
}
