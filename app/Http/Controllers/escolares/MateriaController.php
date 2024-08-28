<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materia;

class MateriaController extends Controller{
    public function __construct(){
        //Solo los que esten loogeados podran unirse a home sino retorna a loggin
        $this->middleware('auth');
    }

    //Visualizar la base de datos
    public function index (){
        //Retornar el json
        $materias = Materia::all();

        //Compactar variables
        return view('escolares.materias', compact('materias'));
    }

    //Funcion para agregar
    public function createMateria(Request $request){
        try {
            //return $request;
            $request->validate([
                'txtClaveM' => 'required',
                'txtNameM' => 'required',
                'txtCreditos' => 'required',
            ]);
    
            // Crea una nueva materia
            $materias = new Materia();
            $materias->clave_materia = $request->txtClaveM;
            $materias->nombre = $request->txtNameM;
            $materias->creditos = $request->txtCreditos;
    
            $materias->save(); //Guardamos
    
            return back()->with("¡Correcto!", "Materia agregada correctamente");
            
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa materia ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar la materia");
        }
    }

    //Funcion para editar una materia
    public function updateMateria(Request $request, $id) {
        try {
            // Tu lógica para actualizar el plan de estudios aquí
            $materias = Materia::findOrFail($id);
            $materias->clave_materia = $request->txtClaveMUP;
            $materias->nombre = $request->txtNameMUP;
            $materias->creditos = $request->txtCreditosUP;

            $materias->save();

            return back()->with("¡Correcto!", "Materia modificada correctamente");
        } catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, la materia ya existe");
            }

            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    //Funcion para eliminar
    public function deleteMateria($id){
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Buscamos la materia
            $materias = Materia::findOrFail($id);
            // Se elimina
            $materias->delete();
    
            return back()->with("¡Correcto!", "Se ha eliminado la materia correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error desconocido");
        }
    }
}
