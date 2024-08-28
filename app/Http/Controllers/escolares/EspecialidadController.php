<?php

namespace App\Http\Controllers\escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\especialidad;
use App\Models\PlanEstudio;

class EspecialidadController extends Controller
{
    public function __construct(){
        /*Solo los que esten loogeados podran unirse a home sino retorna a loggin*/
        $this->middleware('auth');
    }
    
    public function getEspecialidad(){
        $planes = PlanEstudio::all();
        $especialidad = Especialidad::all();

        return view('escolares.planes-estudio', compact('planes', 'especialidad'));
    }

    //Funcion para agregar
    public function createEspecialidad(Request $request){
        try {
            $request->validate([
                'txtEspecialidad' => 'required|string',
                'txtPlanEstudio' => 'required|string',
                // Agrega más reglas de validación para otros campos aquí
                // los 'txt' vienen de la vista
            ]);

            // Crea un nuevo plan
            $especialidad = new Especialidad();
            $especialidad->nombre_especialidad = $request->txtEspecialidad;
            $especialidad->plan_id = $request->txtPlanEstudio;

            $especialidad->save(); //Guardamos

            return back()->with("¡Correcto!", "Especialidad agregada correctamente");
        
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa especialidad ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar la especialidad");
        }
    }

    //Funcion para Editar
    public function updateEspecialidad(Request $request, $id){
        try{
            #$data = $request->all();
            #return $request;
            $especialidad = Especialidad::findOrFail($id);
            //$plan = SELECT * FROM planes_estudio WHERE id = $id
            $especialidad->nombre_especialidad = $request->txtEspecialidad;
            $especialidad->plan_id = $request->txtPlanEstudio;
            
            //Actualiza los campos
            $especialidad->save();

            return back()->with("¡Correcto!", "Especialidad modificada con exito papito");
        }catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, la especialidad ya existe");
            }
        
            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    //Funcion para eliminar
    public function deleteEspecialidad($id){
        //Hay que recibir como parametro el id del registro a eliminar
            try {
                // Buscamos el docente
                $especialidad = Especialidad::findOrFail($id);
                // Se elimina
                $especialidad->delete();
    
                return back()->with("¡Correcto!", "Se ha eliminado la especialidad correctamente");
            } catch (QueryException $e) {
                // Cualquier  error
                return back()->with("Incorrecto", "Error desconocido");
            }
    }
}

