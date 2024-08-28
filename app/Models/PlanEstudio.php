<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanEstudio extends Model
{   
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "planes_estudio";
    //protected $fillable = [
    //    'CLAVE',
    //    'carrera',
    //];
    //Quitar el tiempo y hora
    public $timestamps = false;

    public function especialidades (){
        return $this -> hasMany(Especialidad::class, 'plan_id');
    }
    //RELACION 1-1 CON ALUMNOS
    public function alumno() {
        return $this->hasMany(Alumno::class, 'plan_id');
    } 

    //RELACION CON MATERIAS
    public function materias (){
        return $this->belongsToMany(Materia::class, 'materia_plan_estudio', 'plan_estudio_id', 'materia_id');
    }

    //Relacion con grupos
    public function grupos(){
        return $this->hasMany(Grupo::class);
    }
}
