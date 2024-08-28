<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPlanEstudio extends Model{
    protected $table = 'materia_plan_estudio';
    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;
    protected $fillable=[
        'materia_id',
        'plan_estudio_id',
    ];
}
