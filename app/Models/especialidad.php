<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidad';
    
    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;

    public function planEstudio() {
        return $this->belongsTo(PlanEstudio::class, 'plan_id');
    }    
}