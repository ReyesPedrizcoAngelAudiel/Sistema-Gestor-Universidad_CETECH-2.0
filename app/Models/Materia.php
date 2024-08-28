<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model{
    protected $table = 'materias';
    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;

    //Relacion con "materia_plan_estudios"
    public function PlanEstudio (){
        return $this->belongsToMany(PlanEstudio::class, 'materia_plan_estudio', 'materia_id', 'plan_estudio_id');
    }
}
