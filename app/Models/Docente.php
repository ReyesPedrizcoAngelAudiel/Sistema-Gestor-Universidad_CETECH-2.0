<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model{
    protected $table = 'docentes';
    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;

    /*Funcion nueva | Relacion con User*/
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Definir la relación muchos a muchos con Grupo
    public function grupos() {
        return $this->belongsToMany(Grupo::class, 'docente_grupo', 'docente_id', 'grupo_id');
    }
}
