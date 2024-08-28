<?php

namespace App\Http\Controllers\escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salon;
use App\Models\Edificio;
use App\Models\Docente;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class EdificioController extends Controller
{
    public function __construct(){
        /*Solo los que esten loogeados podran unirse a home sino retorna a loggin*/
        $this->middleware('auth');
    }
    
    
    public function index (){
        //Retornar el json
        $edificios = Edificio::all();
        $salon = Salon::all();
        //Mandar variable a la vista
        //return view('escolares.docente', ['perro' => $test]);

        //Compactar variables
        return view('escolares.edificio', compact('edificios', 'salon'));
    }

    //Funcion para agregar
    public function createEdificio(Request $request){
        try {
            $request->validate([
                'txtNombreE' => 'required|string',
                'txtDescripcion' => 'string',
                // Agrega más reglas de validación para otros campos aquí
                // los 'txt' vienen de la vista
            ]);

            // Crea un nuevo plan
            $edificios = new Edificio();
            $edificios->nombre_edificio = $request->txtNombreE;
            $edificios->descripcion = $request->txtDescripcion;

            $edificios->save(); //Guardamos

            return back()->with("¡Correcto!", "Edificio agregado correctamente");
        
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Ese Edificio ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar al edificio");
        }
    }

    //Funcion para Editar
    public function updateEdificio(Request $request, $id){
        try{
            #$data = $request->all();
            #return $request;
            $edificios = Edificio::findOrFail($id);
            //$plan = SELECT * FROM planes_estudio WHERE id = $id
            $edificios->nombre_edificio = $request->txtNombreE;
            $edificios->descripcion = $request->txtDescripcion;
            
            //Actualiza los campos
            $edificios->save();
            return back()->with("¡Correcto!", "Edificio modificado con exito papito");
        }catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, el edificio ya existe");
            }
        
            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    //Funcion para eliminar
    public function deleteEdificio($id){
        //Hay que recibir como parametro el id del registro a eliminar
            try {
                // Buscamos el docente
                $edificios = Edificio::findOrFail($id);
                // Se elimina
                $edificios->delete();
    
                return back()->with("¡Correcto!", "Se ha eliminado el edificio correctamente");
            } catch (QueryException $e) {
                // Cualquier  error
                return back()->with("Incorrecto", "Error desconocido");
            }
    }
}
