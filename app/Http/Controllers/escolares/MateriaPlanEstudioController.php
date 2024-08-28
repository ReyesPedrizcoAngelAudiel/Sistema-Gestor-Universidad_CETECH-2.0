<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Referenciar el uso de PlanEstuido y Materias
use App\Models\MateriaPlanEstudio;
use App\Models\PlanEstudio;
use App\Models\Materia;

use Illuminate\Database\QueryException;

class MateriaPlanEstudioController extends Controller{
    public function getMaterias($id){
        $planes = PlanEstudio::find($id);
        //return $planes->materias;
        $materias = Materia::all();

        return view('escolares.materias_planes_estudio', compact('materias','planes'));
    }

    //Funcion para agregar
    public function createMateria(Request $request, $idPlan){
        try {
            $planes = PlanEstudio::find($idPlan);
            $planes->materias()->attach($request->txtIdMateria);

            //$materiaPlan = MateriaPlanEstudio::create([
            //    'materia_id' => $request->txtIdMateria,
            //    'plan_estudio_id' => $idPlan
            //]);
            return back()->with("¡Correcto!", "Materia agregada correctamente");
        
        } catch (QueryException $e) {
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar la materia".$e);
        }
    }

    //Funcion para eliminar
    public function deleteMateria($idPlan, $idMateria){
    //Hay que recibir como parametro el id del registro a eliminar
        try {
            $planes = PlanEstudio::find($idPlan);
            $planes->materias()->detach($idMateria);
            return back()->with("¡Correcto!", "Se ha eliminado la materia correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error desconocido");
        }
    }
}
