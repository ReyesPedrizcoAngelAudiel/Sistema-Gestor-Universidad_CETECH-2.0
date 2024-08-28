<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\PlanEstudio;
use App\Models\Materia;
use App\Models\Docente;
use App\Models\alumno_grupo;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class GrupoController extends Controller{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getGrupo($id) {
        $planEstudio = PlanEstudio::find($id);
        $grupos = Grupo::all();
        //$grupos = Grupo::with('periodos')->get();
        $periodos = Periodo::all();
        $materias = Materia::all();
        $docentes = Docente::all();
        return view('escolares.grupos', compact('grupos', 'planEstudio','periodos','materias','docentes'));
    }

    public function createGrupo(Request $request, $idPlan) {
        try {
            $request->validate([
                'selectPeriGrupo' => 'required',
                'selectMatGrup' => 'required',
                'txtSemGrupo' => 'required',
                'txtLetraGrupo' => 'required',
                'txtCapGrupo' => 'required',
                'selectDocenGrup' => 'required',
            ]);

            // Crea un nuevo plan
            $planEstudio = PlanEstudio::findOrFail($idPlan);

            $grupo = new Grupo();

            $grupo->periodo_id = $request->selectPeriGrupo;
            $grupo->plan_estudio_id = $idPlan;
            $grupo->materia_id = $request->selectMatGrup;
            $grupo->semestre = $request->txtSemGrupo;
            $grupo->letra_grupo = $request->txtLetraGrupo;
            $grupo->capacidad = $request->txtCapGrupo;
            $grupo->docente_id = $request->selectDocenGrup;

            $planEstudio->grupos()->save($grupo);

            return back()->with("¡Correcto!", "Materia creada correctamente");

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa materia ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error desconocido: " . $e->getMessage() . " (Código: " . $e->errorInfo[1] . ")");

        }
    }

    public function updateGrupo(Request $request, $idPlan, $idGrupo) {
        try {
            // Validar los datos
            $request->validate([
                'selectPeriGrupoUp' => 'required',
                'selectMatGrupUp' => 'required',
                'txtSemGrupoUp' => 'required',
                'txtLetraGrupoUp' => 'required',
                'txtCapGrupoUp' => 'required',
                'selectDocenGrupUp' => 'required',
            ]);

            $planEstudio = PlanEstudio::findOrFail($idPlan);
            $grupo = $planEstudio->grupos()->findOrFail($idGrupo);

            $grupo->periodo_id = $request->selectPeriGrupoUp;
            $grupo->materia_id = $request->selectMatGrupUp;
            $grupo->semestre = $request->txtSemGrupoUp;
            $grupo->letra_grupo = $request->txtLetraGrupoUp;
            $grupo->capacidad = $request->txtCapGrupoUp;
            $grupo->docente_id = $request->selectDocenGrupUp;
            $grupo->save();

            return back()->with("¡Correcto!", "Grupo modificado correctamente");
        } catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, el grupo ya existe");
            }
            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido: " . $e->getMessage() . " (Código: " . $e->errorInfo[1] . ")");
        }
    }

    public function deleteGrupo($idPlan, $idGrupo) {
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Buscamos el plan de estudio
            $planEstudio = PlanEstudio::findOrFail($idPlan);
            $grupo = $planEstudio->grupos()->findOrFail($idGrupo);
            // Se elimina
            $grupo->delete();

            return back()->with("¡Correcto!", "Se ha eliminado la materia correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar la materia");
        }
    }

    // Funciones para los alumnos
    public function getAlumnoGrupos(){
        $alumnoGrupos = alumno_grupo::with('grupo.periodo', 'grupo.planEstudio', 'grupo.materia')->get();
        return view('escolares.alumno_grupo', ['grupos' => $alumnoGrupos]);
    }

    //Funciones para alumnos y grupos | Ver
    public function getGrupoAlumnos($id) {
        $grupo_docente = alumno_grupo::where('grupo_id', $id)->get();
        $alumnos = Alumno::all();
        // Encontrar el grupo por su ID
        $grupo = Grupo::with('periodo', 'planEstudio', 'materia', 'docente')->find($id);
        
        //return $grupo_docente;
        return view('escolares.new_alumno_grupo', compact('grupo', 'grupo_docente', 'alumnos'));
    }    
    
    //Funcion para agregar un alumno al grupo | Agregar
    public function createAlumnoGrupo(Request $request, $id){
        try {
            $request->validate([
                'numero_control' => 'required',
            ]);
    
            // Obtiene el número de control del formulario
            $numero_control = $request->input('numero_control');
    
            // Busca al alumno por su número de control
            $alumno = Alumno::where('numero_control', $numero_control)->first();
    
            // Verifica si se encontró al alumno
            if($alumno) {
                // Crea una nueva relación alumno-grupo
                $alumnoGrupo = new alumno_grupo();
                $alumnoGrupo->grupo_id = $id;
                $alumnoGrupo->alumno_id = $alumno->id;
                $alumnoGrupo->save();
    
                return back()->with("¡Correcto!", "Alumno agregado correctamente");
            } else {
                // Si no se encuentra al alumno, devuelve un mensaje de error
                return back()->with("Incorrecto", "El alumno con el número de control proporcionado no existe");
            }
        } catch (QueryException $e) {
            // Cualquier otro error
            return back()->with("Incorrecto", "Error desconocido: " . $e->getMessage() . " (Código: " . $e->errorInfo[1] . ")");
        }
    }     
    
    //Funciones para alumnos y grupos | Eliminar
    public function deleteAlumnoGrupo($grupo_id, $alumno_id){
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Encuentra el registro del alumno en el grupo
            $alumnoGrupo = alumno_grupo::where('grupo_id', $grupo_id)
            ->where('alumno_id', $alumno_id)
            ->first();
            // Se elimina
            $alumnoGrupo->delete();

            return back()->with("¡Correcto!", "¡Alumno eliminado del grupo correctamente!");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar el alumno del grupo");
        }
    }
}