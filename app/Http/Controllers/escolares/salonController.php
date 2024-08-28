<?php

namespace App\Http\Controllers\escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salon;
use App\Models\Edificio;
use App\Models\Docente;
use App\Models\User;

class salonController extends Controller
{
    public function __construct(){
        /*Solo los que esten loogeados podran unirse a home sino retorna a loggin*/
        $this->middleware('auth');
    }
    
    public function getEdificios(){
        $edificios = Edificio::all();
        $salon = Salon::all();

        return view('escolares.edificio', compact('edificios','salon'));
    }

    //Funcion para agregar
    public function createSalon(Request $request){
        try {
            $request->validate([
                'txtNombreS' => 'required|string',
                'txtEdificio' => 'required|string',
                // Agrega más reglas de validación para otros campos aquí
                // los 'txt' vienen de la vista
            ]);

            // Crea un nuevo plan
            $salon = new Salon();
            $salon->nombre_salon = $request->txtNombreS;
            $salon->edificio_id = $request->txtEdificio;

            $salon->save(); //Guardamos

            return back()->with("¡Correcto!", "Salon agregado correctamente");
        
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Ese Salon ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar al edificio");
        }
    }

    //Funcion para Editar
    public function updateSalon(Request $request, $id){
        try{
            #$data = $request->all();
            #return $request;
            $salon = Salon::findOrFail($id);
            //$plan = SELECT * FROM planes_estudio WHERE id = $id
            $salon->nombre_salon = $request->txtNombreS;
            $salon->edificio_id = $request->txtEdificio;
            
            //Actualiza los campos
            $salon->save();
            return back()->with("¡Correcto!", "Salón modificado con exito papito");
        }catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, el salón ya existe");
            }
        
            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    //Funcion para eliminar
    public function deleteSalon($id){
        //Hay que recibir como parametro el id del registro a eliminar
            try {
                // Buscamos el docente
                $salon = Salon::findOrFail($id);
                // Se elimina
                $salon->delete();
    
                return back()->with("¡Correcto!", "Se ha eliminado el salón correctamente");
            } catch (QueryException $e) {
                // Cualquier  error
                return back()->with("Incorrecto", "Error desconocido");
            }
    }
}
