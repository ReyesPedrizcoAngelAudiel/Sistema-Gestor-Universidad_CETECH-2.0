<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alumno_grupo extends Model{
    protected $table = 'alumno_grupos';
    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;

    //Relacion con alumnos
    public function alumno() {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    //rELACION CON GRUPOS
    public function grupo(){
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
}
