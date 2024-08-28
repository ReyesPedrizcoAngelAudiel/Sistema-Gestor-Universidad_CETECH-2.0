<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model{
    protected $table = 'periodos';
    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;
}
