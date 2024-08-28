<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model{
    protected $table = 'alumnos';
    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;

    /*Funcion nueva | Relacion con User*/
    public function user(){
        return $this->belongsTo(User::class);
    }

    /*RELACION 1-1 CON PLAN ESTUDIO*/
    public function planEstudio() {
        return $this->belongsTo(PlanEstudio::class);
    } 
    
    /*RELACION 1-1 CON ESTATUS*/
    public function Estatus() {
        return $this->belongsTo(Estatus::class);
    }  

    /*RELACION 1-1 CON TIPOS DE ALUMNOS*/
    public function talumno() {
        return $this->belongsTo(TiposAlumno::class);
    }

    //rELACION CON GRUPOS
    public function grupo() {
        return $this->belongsTo(Grupo::class);
    }
}
