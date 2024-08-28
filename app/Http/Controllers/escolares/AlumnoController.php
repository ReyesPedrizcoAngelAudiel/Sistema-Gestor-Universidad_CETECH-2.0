<?php

namespace App\Http\Controllers\escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno;
//RELACIONES CON OTROS MODELOS
use App\Models\User;
use App\Models\PlanEstudio;
use App\Models\estatus;
use App\Models\tiposAlumno;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class AlumnoController extends Controller{
    public function __construct(){
        /*Solo los que esten loogeados podran unirse a home sino retorna a loggin*/
        $this->middleware('auth');
    }
    
    public function index (){
        //Retornar el json
        $alumnos = Alumno::all();
        $planes = PlanEstudio::all();
        $estatus = Estatus::all();
        $TAlumnos = tiposAlumno::all();

        //Compactar variables
        return view('escolares.alumno', compact('alumnos','planes','estatus','TAlumnos'));
    }

    //Funcion para agregar
    public function createAlumno(Request $request){
        try {
            //return $request;
            $request->validate([
                'txtNoControl' => 'required',
                'txtNameA' => 'required',
                'txtAPA' => 'required',
                'txtAMA' => 'required',
                'txtCURPA' => 'required',
                'txtPlanID' => 'required',
                'txtSemestre' => 'required',
                'txtStatusID' => 'required',
                'txtTipo' => 'required',
            ]);
            
            $fecha_nacimiento = substr($request->txtCURPA, 4, 6);
            $email = 'l'.$request->txtNoControl.'@sjuanrio.tecnm.mx';
            
            $user = User::create([
                'name' => $request->txtNameA.' '.$request->txtAPA.' '.$request->txtAMA,
                'email' => $email,
                'password' => Hash::make('Tecsj+'.$fecha_nacimiento),
            ]);

            $user->assignRole('alumno');
    
            // Crea un nuevo alumno
            $alumno = new Alumno();
            $alumno->numero_control = $request->txtNoControl;
            $alumno->nombre_alumno = $request->txtNameA;
            $alumno->ap_paterno = $request->txtAPA;
            $alumno->ap_materno = $request->txtAMA;
            $alumno->curp = $request->txtCURPA;
            $alumno->plan_id = $request->txtPlanID;
            $alumno->semestre = $request->txtSemestre;
            $alumno->estatus_id = $request->txtStatusID;
            $alumno->tipoA_id = $request->txtTipo;
            $alumno->user_id = $user->id;
    
            $alumno->save(); //Guardamos
    
            return back()->with("¡Correcto!", "Alumno agregado correctamente");
            
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Ese Número de control ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar al alumno");
        }
    }

    //Funcion para editar un alumno
    public function updateAlumno(Request $request, $id) {
        try {
            // Tu lógica para actualizar el plan de estudios aquí
            $alumnos = Alumno::findOrFail($id);
            $alumnos->numero_control = $request->txtNoControlUP;
            $alumnos->nombre_alumno = $request->txtNameAUP;
            $alumnos->ap_paterno = $request->txtAPAUP;
            $alumnos->ap_materno = $request->txtAMAUP;
            $alumnos->curp = $request->txtCURPAUP;
            $alumnos->semestre = $request->txtSemestreUP;
            //foraneas
            $alumnos->plan_id = $request->txtPlanIDUP;
            $alumnos->estatus_id = $request->txtStatusIDUP;
            $alumnos->tipoA_id = $request->txtTipoUP;

            $alumnos->save();

            return back()->with("¡Correcto!", "Alumno modificado correctamente");
        } catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, el alumno ya existe");
            }

            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    //Funcion para eliminar
    public function deleteAlumno($id){
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Buscamos el Alumno
            $alumno = Alumno::findOrFail($id);
            // Se elimina
            $alumno->delete();
    
            return back()->with("¡Correcto!", "Se ha eliminado el alumno correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error desconocido");
        }
    }
}
