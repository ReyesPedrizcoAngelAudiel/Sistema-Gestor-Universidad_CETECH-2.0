<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periodo;

class PeriodoController extends Controller{
    public function __construct(){
        //Solo los que esten loogeados podran unirse a home sino retorna a loggin
        $this->middleware('auth');
    }

    //Visualizar la base de datos
    public function index (){
        //Retornar el json
        $periodos = Periodo::all();

        //Compactar variables
        return view('escolares.periodos', compact('periodos'));
    }

    public function generarClavePeriodo($anio, $periodo) {
        $clave_anio = substr($anio, -2); // Obtiene los últimos dos dígitos del año
        $clave_periodo = ''; // Inicializa la variable de la clave del periodo
        
        // Asigna la clave del periodo acorde al valor
        switch ($periodo) {
            case '1':
                $clave_periodo = '1'; // Para el primer periodo
                break;
            case '2':
                $clave_periodo = '2'; // Para el segundo periodo
                break;
            case '3':
                $clave_periodo = '3'; // Para el periodo de verano
                break;
            // Puedes agregar más casos según sea necesario para otros periodos
            default:
                $clave_periodo = ''; // Por defecto, la clave del periodo queda vacía
                break;
        }
        
        // Combina el año y la clave del periodo
        $clave = $clave_anio . '/' . $clave_periodo;
        
        return $clave;
    }    

    //Funcion para agregar
    public function createPeriodo(Request $request){
        try {
            //return $request;
            $request->validate([
                'txtAño' => 'required',
                'txtPeriodo' => 'required',
                'txtEstatus' => 'required',
            ]);

            // Dentro de la función createPeriodo
            $clave_periodo = $this->generarClavePeriodo($request->txtAño, $request->txtPeriodo);

            // Array asociativo de nombres de períodos
            $nombres_periodos = [
                '1' => 'Enero - Junio',
                '2' => 'Agosto - Diciembre',
                '3' => 'Verano',
            ];

             // Obtiene el nombre del período según el valor recibido
            $nombre_periodo = $nombres_periodos[$request->txtPeriodo];
    
            // Crea una nuevo periodo
            $periodos = new Periodo();
            $periodos->clave_periodo = $clave_periodo;
            $periodos->nombre_periodo = $nombre_periodo;
            $periodos->estatus = $request->txtEstatus;
    
            $periodos->save(); //Guardamos
    
            return back()->with("¡Correcto!", "Periodo agregado correctamente");
            
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Ese periodo ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar el periodo");
        }
    }

    //Funcion para editar un periodo
    public function updatePeriodo(Request $request, $id) {
        try {
            // Dentro de la función createPeriodo
            $clave_periodo = $this->generarClavePeriodo($request->txtAñoUP, $request->txtPeriodoUP);

            // Array asociativo de nombres de períodos
            $nombres_periodos = [
                '1' => 'Enero - Junio',
                '2' => 'Agosto - Diciembre',
                '3' => 'Verano',
            ];

             // Obtiene el nombre del período según el valor recibido
            $nombre_periodo = $nombres_periodos[$request->txtPeriodoUP];

            // Tu lógica para actualizar el plan de estudios aquí
            $periodos = Periodo::findOrFail($id);
            $periodos->clave_periodo = $clave_periodo;
            $periodos->nombre_periodo = $nombre_periodo;
            $periodos->estatus = $request->txtEstatusUP;

            $periodos->save();

            return back()->with("¡Correcto!", "Periodo modificado correctamente");
        } catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, el periodo ya existe");
            }

            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    //Funcion para eliminar
    public function deletePeriodo($id){
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Buscamos la materia
            $periodos = Periodo::findOrFail($id);
            // Se elimina
            $periodos->delete();
    
            return back()->with("¡Correcto!", "Se ha eliminado el periodo correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error desconocido");
        }
    }
}
