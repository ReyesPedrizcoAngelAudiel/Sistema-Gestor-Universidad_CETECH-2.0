<?php

namespace App\Http\Controllers\escolares;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Models\PlanEstudio;
use App\Models\especialidad;
use Illuminate\Database\QueryException;

class PlanEstudioController extends Controller
{
    public function __construct()
    {
        /*Solo los que esten loogeados podran unirse a home sino retorna a loggin*/
        $this->middleware('auth');
    }
    
    public function index (){
        //Retornar el json
        $planes = PlanEstudio::all();
        $especialidad = Especialidad::all();

        //Compactar variables
        return view('escolares.planes-estudio', compact('planes', 'especialidad'));
    }

    //Funcion para Editar
    public function updatePlanEstudio(Request $request, $id){
        try{
            #$data = $request->all();
            #return $request;
            $plan = PlanEstudio::findOrFail($id);
            //$plan = SELECT * FROM planes_estudio WHERE id = $id
            $plan->CLAVE = $request->txt_clave;
            $plan->carrera = $request->txt_carrera;
            //Actualiza los campos
            $plan->save();
            return back()->with("¡Correcto!", "Plan de estudio modificado con exito papito");
        }catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, la clave del plan ya existe");
            }
        
            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    //Funcion para agregar
    public function createPlanEstudio(Request $request){
        try {
            $request->validate([
                'txtClave' => 'required|string',
                'txtCarrera' => 'required|string',
                // Agrega más reglas de validación para otros campos aquí
                // los 'txt' vienen de la vista
            ]);

            // Crea un nuevo plan
            $plan = new PlanEstudio();
            $plan->CLAVE = $request->txtClave;
            $plan->carrera = $request->txtCarrera;

            $plan->save(); //Guardamos
            
            return back()->with("¡Correcto!", "Plan de estudio agregado correctamente");
        
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa clave de plan de estudios ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar el plan de estudios");
        }
    }

    //Funcion para eliminar
    public function deletePlanEstudio($id){
    //Hay que recibir como parametro el id del registro a eliminar
        try {
                // Buscamos el plan de estudio
            $planEstudio = PlanEstudio::findOrFail($id);
            // Se elimina
            $planEstudio->delete();

            return back()->with("¡Correcto!", "Se ha eliminado el plan de estudio correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error desconocido");
        }
    }
}
