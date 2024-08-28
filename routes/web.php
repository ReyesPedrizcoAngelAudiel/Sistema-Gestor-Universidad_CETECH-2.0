<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\escolares\EspecialidadController;
use App\Http\Controllers\escolares\AlumnoController;
use App\Http\Controllers\escolares\PlanEstudioController;
use App\Http\Controllers\escolares\DocenteController;
use App\Http\Controllers\escolares\EdificioController;
use App\Http\Controllers\escolares\MateriaController;
use App\Http\Controllers\escolares\salonController;
use App\Http\Controllers\escolares\PeriodoController;
use App\Http\Controllers\escolares\MateriaPlanEstudioController;
use App\Http\Controllers\escolares\GrupoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

#Grupo de rutas para home
Route::get('/',[App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

#Grupo de rutas para escolares
Route::group(['middleware' => ['role:escolares']], function () {
    #grupo de rutas para ALUMNOS
    Route::get('/escolares/alumno',[AlumnoController::class, 'index']) -> name('alumno');
    #Ruta para crear un plan de estudio
    Route::post('/escolares/alumno/Crear',[AlumnoController::class, 'createAlumno'])-> name('AlumnoCrear');
    #Ruta para modificar un plan de estudio
    Route::patch('/escolares/alumno/Editar/{id}',[AlumnoController::class, 'updateAlumno'])-> name('AlumnoEditar');
    #Ruta para eliminar un plan de estudio
    Route::delete('/escolares/alumno/Eliminar/{id}',[AlumnoController::class, 'deleteAlumno'])-> name('AlumnoEliminar');

    #Rutas para Docentes
    Route::get('/escolares/Docentes',[DocenteController::class, 'index'])-> name('docentes');
    #Ruta para agregar un docente
    Route::post('/escolares/Docentes/Crear',[DocenteController::class, 'createDocente'])-> name('DocenteCrear');
    #Ruta para modificar un docente
    Route::patch('/escolares/Docentes/Editar/{id}',[DocenteController::class, 'updateDocente'])-> name('DocenteEditar');
    #Ruta para eliminar un docente
    Route::delete('/escolares/Docentes/Eliminar/{id}',[DocenteController::class, 'deleteDocente'])-> name('DocenteEliminar');

    #Rutas para Edificios
    Route::get('/escolares/Edificios',[EdificioController::class, 'index'])-> name('edificio');
    #Ruta para agregar un docente
    Route::post('/escolares/Edificios/Crear',[EdificioController::class, 'createEdificio'])-> name('EdificioCrear');
    #Ruta para modificar un docente
    Route::patch('/escolares/Edificios/Editar/{id}',[EdificioController::class, 'updateEdificio'])-> name('EdificioEditar');
    #Ruta para eliminar un docente
    Route::delete('/escolares/Edificios/Eliminar/{id}',[EdificioController::class, 'deleteEdificio'])-> name('EdificioEliminar');

    #Rutas para Salones
    #Ruta para agregar un docente
    Route::post('/escolares/Salones/Crear',[salonController::class, 'createSalon'])-> name('SalonCrear');
    #Ruta para modificar un docente
    Route::patch('/escolares/Salones/Editar/{id}',[salonController::class, 'updateSalon'])-> name('SalonEditar');
    #Ruta para eliminar un docente
    Route::delete('/escolares/Salones/Eliminar/{id}',[salonController::class, 'deleteSalon'])-> name('SalonEliminar'); 

    #Rutas para periodos
    Route::get('/escolares/Periodo',[PeriodoController::class, 'index'])-> name('Periodo');
    #Ruta para agregar un periodo
    Route::post('/escolares/Periodo/Crear',[PeriodoController::class, 'createPeriodo'])-> name('PeriodoCrear');
    #Ruta para modificar un docente
    Route::patch('/escolares/Periodo/Editar/{id}',[PeriodoController::class, 'updatePeriodo'])-> name('PeriodoEditar');
    #Ruta para eliminar un docente
    Route::delete('/escolares/Periodo/Eliminar/{id}',[PeriodoController::class, 'deletePeriodo'])-> name('PeriodoEliminar'); 
});

#Grupo de rutas para docente
Route::group(['middleware' => ['role:docente']], function () {
    #Ruta para visualizar grupos por docente_id
    Route::get('/Docente/grupos/', [DocenteController::class, 'getGrupo'])->name('DocenteGrupo');
    #Ruta para ver los alumnos asignados
    Route::get('/Docente/grupos/{id}/alumnos', [DocenteController::class, 'getAlumnoDocente'])->name('AlumnoDocenteMostrar');
});

#Grupo de rutas para Division de estudios profesionales.
Route::group(['middleware' => ['role:div_estudios']], function (){
    #Rutas para Materias
    Route::get('/escolares/Materias',[MateriaController::class, 'index'])-> name('materia');
    #Ruta para agregar un docente
    Route::post('/escolares/Materias/Crear',[MateriaController::class, 'createMateria'])-> name('MateriaCrear');
    #Ruta para modificar un docente
    Route::patch('/escolares/Materias/Editar/{id}',[MateriaController::class, 'updateMateria'])-> name('MateriaEditar');
    #Ruta para eliminar un docente
    Route::delete('/escolares/Materias/Eliminar/{id}',[MateriaController::class, 'deleteMateria'])-> name('MateriaEliminar');
    
    #Rutas para Planes de estudio
    Route::get('/escolares/Planes',[PlanEstudioController::class, 'index'])-> name('escolaresPlanesEstudios');
    #Ruta para modificar un plan de estudio
    Route::patch('/escolares/Planes/Editar/{id}',[PlanEstudioController::class, 'updatePlanEstudio'])-> name('PlanesEstudioEditar');
    #Ruta para crear un plan de estudio
    Route::post('/escolares/Planes/Crear',[PlanEstudioController::class, 'createPlanEstudio'])-> name('PlanesEstudioCrear');
    #Ruta para eliminar un plan de estudio
    Route::delete('/escolares/Planes/Eliminar/{id}',[PlanEstudioController::class, 'deletePlanEstudio'])-> name('PlanesEstudioEliminar');
 
    #Rutas para Especialidades
    #Ruta para agregar una Especialidad
    Route::post('/escolares/Especialidad/Crear',[EspecialidadController::class, 'createEspecialidad'])-> name('EspecialidadCrear');
    #Ruta para modificar una Especialidad
    Route::patch('/escolares/Especialidad/Editar/{id}',[EspecialidadController::class, 'updateEspecialidad'])-> name('EspecialidadEditar');
    #Ruta para eliminar una Especialidad
    Route::delete('/escolares/Especialidad/Eliminar/{id}',[EspecialidadController::class, 'deleteEspecialidad'])-> name('EspecialidadEliminar');

    #Rutas para Materias-PlanEstudio
    #Ruta para visualizar
    Route::get('/escolares/Planes/Materias/{id}',[MateriaPlanEstudioController::class, 'getMaterias'])-> name('MateriasPlanMostrar');
    #Ruta para crear
    Route::post('/escolares/Planes/Materias/Crear/{idPlan}',[MateriaPlanEstudioController::class, 'createMateria'])-> name('MateriasPlanCrear');
    #Ruta para eliminar
    Route::delete('/escolares/Planes/Materias/Eliminar/{idPlan}/{idMateria}',[MateriaPlanEstudioController::class, 'deleteMateria'])-> name('MateriasPlanEliminar');

    #Rutas para Grupos
    #Ruta para visualizar
    Route::get('/escolares/Planes/grupo/{id}', [GrupoController::class, 'getGrupo'])->name('escolaresGrupo');
    #Ruta para crear
    Route::post('/escolares/Planes/grupo/create/{idPlan}', [GrupoController::class, 'createGrupo'])->name('grupoCreate');
    #Ruta para modificar
    Route::patch('/escolares/Planes/grupo/editar/{idPlan}/{idGrupo}', [GrupoController::class, 'updateGrupo'])->name('grupoUpdate');
    #Ruta para eliminar
    Route::delete('/escolares/Planes/grupo/delete/{idPlan}/{idMateria}', [GrupoController::class, 'deleteGrupo'])->name('grupoDelete');

    #Rutas para Alumnos-Grupos
    #Ruta para visualizar alumnos del grupo
    Route::get('/escolares/Planes/grupo/{id}/alumnos', [GrupoController::class, 'getGrupoAlumnos'])->name('gruposAlumnoVer');
    #Ruta para Agregar un alumno al grupo
    Route::post('/escolares/Planes/grupo/{id}/alumnos/Agregar/', [GrupoController::class, 'createAlumnoGrupo'])->name('gruposAlumnoAgregar');
    #Ruta para Eliminar un alumno del grupo
    Route::delete('/escolares/Planes/grupo/{id}/alumno/Eliminar/{id_alumno}', [GrupoController::class, 'deleteAlumnoGrupo'])->name('gruposAlumnoEliminar');
});

# Grupo de rutas para alumnos
Route::group(['middleware' => ['role:alumno']], function () {
    # Ruta para mostrar las materias inscritas de un alumno
    Route::get('/alumno/grupos', [GrupoController::class, 'getAlumnoGrupos'])->name('AlumnoGruposMostrar');
});


Auth::routes();