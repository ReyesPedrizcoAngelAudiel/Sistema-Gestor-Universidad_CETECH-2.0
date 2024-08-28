<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposAlumno extends Model{
    use HasFactory;
    
    protected $table = "tipos_alumno";

    public $timestamps = false;

    /*RELACION 1-1 CON ALUMNOS*/
    public function alumno() {
        return $this->hasMany(Alumno::class);
    } 
}
