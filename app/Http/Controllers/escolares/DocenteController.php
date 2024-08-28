<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Asegúrate de importar Auth correctamente
use App\Models\Docente;
use App\Models\Alumno;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\alumno_grupo;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class DocenteController extends Controller
{
    public function __construct(){
        /*Solo los que esten loogeados podran unirse a home sino retorna a loggin*/
        $this->middleware('auth');
    }
    
    public function index (){
        //Retornar el json
        $docentes = Docente::all();

        //Compactar variables
        return view('escolares.docente', compact('docentes'));
    }

    //Funcion para agregar
    public function createDocente(Request $request){
        try {
            $request->validate([
                'txtRfc' => 'required|string',
                'txtName' => 'required|string',
                'txtAP' => 'required|string',
                'txtAM' => 'required|string',
                'txtCURP' => 'required|string',
                'txtEmail' => 'required|string',
            ]);

            $fecha_nacimiento = substr($request->txtCURP, 4, 6);

            $user = User::create([
                'name' => $request->txtName.' '.$request->txtAP.' '.$request->txtAM,
                'email' => $request->txtEmail,
                'password' => Hash::make('Tecsj+'.$fecha_nacimiento),
            ]);

            $user->assignRole('docente');

            // Crea un nuevo plan
            $docente = new Docente();
            $docente->rfc = $request->txtRfc;
            $docente->nombre = $request->txtName;
            $docente->ap_paterno = $request->txtAP;
            $docente->ap_materno = $request->txtAM;
            $docente->curp = $request->txtCURP;
            $docente->email = $request->txtEmail;
            $docente->user_id = $user->id;

            $docente->save(); //Guardamos

            return back()->with("¡Correcto!", "Docente agregado correctamente");
        
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Ese RFC ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar al docente");
        }
    }

    //Funcion para Editar
    public function updateDocente(Request $request, $id){
        try{
            #$data = $request->all();
            #return $request;
            $docente = Docente::findOrFail($id);
            //$plan = SELECT * FROM planes_estudio WHERE id = $id
            $docente->rfc = $request->txtRfc;
            $docente->nombre = $request->txtName;
            $docente->ap_paterno = $request->txtAP;
            $docente->ap_materno = $request->txtAM;
            $docente->curp = $request->txtCURP;
            $docente->email = $request->txtEmail;
            
            //Actualiza los campos
            $docente->save();
            return back()->with("¡Correcto!", "Docente modificado con exito papito");
        }catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, el docente ya existe");
            }
        
            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    //Funcion para eliminar
    public function deleteDocente($id){
        //Hay que recibir como parametro el id del registro a eliminar
            try {
                // Buscamos el docente
                $docente = Docente::findOrFail($id);
                // Se elimina
                $docente->delete();
    
                return back()->with("¡Correcto!", "Se ha eliminado el docente correctamente");
            } catch (QueryException $e) {
                // Cualquier  error
                return back()->with("Incorrecto", "Error desconocido");
            }
    }

    //Funcion para grupos-docente
    //public function getGrupo() {
    //    $docente = Docente::all();
    //    $grupos = Grupo::all();
    //    $alumnos = Alumno::all();
    //    $grupo_docente = alumno_grupo::all();
    //    return $grupos;
        //return view('escolares.grupos_docente', compact('docente', 'grupos', 'grupo_docente', 'alumnos'));
    //}

    public function getGrupo(){
        // Obtener el usuario autenticado
        $user = Auth::user();
        // Obtener el docente asociado al usuario autenticado
        $docente = $user->docente;

        // Verificar si el docente existe
        if ($docente) {
            $docenteId = $docente->id;
            // Obtener los grupos del docente autenticado
            $grupos = Grupo::where('docente_id', $docenteId)->get();
            //return $grupos; // Retorna los grupos en formato JSON
            return view('escolares.grupos_docente', compact('grupos'));
            // return view('escolares.grupos_docente', compact('grupos'));
        } else {
            return response()->json(['error' => 'Docente no encontrado'], 404);
        }
    }

    // Función para grupos-docente-alumno
    public function getAlumnoDocente($grupo_id) {
        // Obtener el docente correspondiente al grupo (opcional, dependiendo de tu lógica)
        // $docente = Docente::find($id);
        
        // Obtener solo el grupo específico basado en el grupo_id
        $grupo = Grupo::where('id', $grupo_id)->first();
        
        // Obtener todos los docentes, alumnos y la relación de grupo_docente
        $docentes = Docente::all();
        $alumnos = Alumno::all();
        $grupo_docente = alumno_grupo::where('grupo_id', $grupo_id)->get();
        
        // Retornar la vista con los datos filtrados
        return view('escolares.grupos_docente_alumnos', compact('docentes', 'grupo', 'grupo_docente', 'alumnos'));
    }
}
