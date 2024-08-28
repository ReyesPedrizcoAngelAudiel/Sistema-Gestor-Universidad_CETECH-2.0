@extends('layouts.plantilla')
@section('content')    
    <div class="box">
        <h1 class="title is-2 has-text-centered">Alumnos</h1>
        @if (session('¡Correcto!'))
            <div class="notification is-success">
                <button class="delete"></button>
                {{ session('¡Correcto!') }}
            </div>
        @endif

        @if (session('Incorrecto'))
            <div class="notification is-danger">
                <button class="delete"></button>
                {{ session('Incorrecto') }}
            </div>
        @endif
        <hr>
        <!--Boton de acciones-->
        <div class="buttons is-centered">
            <a class="button is-danger" href="{{ route('home') }}">
                <span class="icon">
                    <i class="fas fa-arrow-left"></i> <!-- Icono de flecha hacia la izquierda -->
                </span>
                <span>Regresar</span>
            </a>
            <a class="button is-info js-modal-trigger" data-target="modal-nvo-alumno">
                <span>Nuevo Alumno</span>
            </a>
        </div>

        <!-- Tabla de elemenos a mostrar -->
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th class="is-hidden-mobile has-text-centered">NO.CONTROL</th>
                    <th class="has-text-centered">NOMBRE</th>
                    <th class="has-text-centered">PATERNO</th>
                    <th class="has-text-centered">MATERNO</th>
                    <th class="is-hidden-mobile has-text-centered">CURP</th>
                    <th class="is-hidden-mobile has-text-centered">CARRERA</th>
                    <th class="is-hidden-mobile has-text-centered">SEMESTRE</th>
                    <th class="is-hidden-mobile has-text-centered">ESTADO</th>
                    <th class="is-hidden-mobile has-text-centered">TIPO</th>
                    <th class="has-text-centered">ACCIONES</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr class="has-text-centered">
                        <td>{{$alumno->numero_control}}</td>
                        <td class="is-hidden-mobile">{{$alumno->nombre_alumno}}</td>
                        <td class="is-hidden-mobile">{{$alumno->ap_paterno}}</td>
                        <td class="is-hidden-mobile">{{$alumno->ap_materno}}</td>
                        <td class="is-hidden-mobile">{{$alumno->curp}}</td>
                        <!--PLANES DE ESTUDIO | VISUALIZACION-->
                        <td class="is-hidden-mobile">
                            @foreach ($planes as $planEstudio)
                                @if ($alumno->plan_id == $planEstudio->id)
                                    {{ $planEstudio->CLAVE }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$alumno->semestre}}</td>
                        <!--ESTADO DEL ALUMNO | VISUALIZACION-->
                        <td>
                            @foreach ($estatus as $Estatus)
                                @if ($alumno->estatus_id == $Estatus->id)
                                    {{ $Estatus->nombre_estatus }}
                                @endif
                            @endforeach
                        </td>
                        <!--TIPO DE ALUMNO | VISUALIZACION-->
                        <td>
                            @foreach ($TAlumnos as $talumno)
                                @if ($alumno->tipoA_id == $talumno->id)
                                    {{ $talumno->nombre_tipo }}
                                @endif
                            @endforeach
                        </td>
                        <!--BOTONES ACCIONARIOS EN LA TABLA-->
                        <td>
                            <div class="has-text-centered">
                                <button class="button is-info js-modal-trigger" data-target="modal-{{$alumno->id}}">
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </button>
                                <button class="button is-danger js-delete-button" data-action="{{ route('AlumnoEliminar', $alumno->id) }}">
                                    <span class="icon">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!--Modal para agregar el nuevo Alumno-->
        <div id="modal-nvo-alumno" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Agregar Alumno</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form method="POST" action="{{ route('AlumnoCrear') }}">
                        @csrf
                        @method('POST')
                        <!--INPUT NOCONTROL-->
                        <div class="field">
                            <label class="label">No.Control:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtNoControl">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtNoControl')
                                <p class="help is-danger">Ingresa el No. Control</p>
                            @enderror
                        </div>
                        <!--INPUT NOMBRE ALUMNO-->
                        <div class="field">
                            <label class="label">Nombre alumno:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtNameA">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtNameA')
                                <p class="help is-danger">Ingresa el nombre del docente</p>
                            @enderror
                        </div>
                        <!--INPUT APELLIDO PATERNO-->
                        <div class="field">
                            <label class="label">Apellido Paterno:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtAPA">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('txtAPA')
                                <p class="help is-danger">Ingresa el Apellido Paterno</p>
                            @enderror
                        </div>
                        <!--INPUT APELLIDO MATERNO-->
                        <div class="field">
                            <label class="label">Apellido Materno:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtAMA">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('txtAMA')
                                <p class="help is-danger">Ingresa el Apellido Materno</p>
                            @enderror
                        </div>
                        <!--INPUT CURP-->
                        <div class="field">
                            <label class="label">CURP del alumno:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtCURPA">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('txtCURPA')
                                <p class="help is-danger">Ingresa el CURP</p>
                            @enderror
                        </div>
                        <!--INPUT SEMESTRE-->
                        <div class="field">
                            <label class="label">Semestre:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="number" name="txtSemestre">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('txtSemestre')
                                <p class="help is-danger">Ingresa el Semestre</p>
                            @enderror
                        </div>
                        <!--LISTA DE PLANES-ESTUDIO-->
                        <div class="field">
                            <div class="control">
                                <label class="label">Plan de estudio:</label>
                                <div class="control">
                                    <div class="select" >
                                        <select name='txtPlanID'>
                                            @foreach ($planes as $planEstudio)
                                                <option value="{{ $planEstudio->id }}">
                                                    {{ $planEstudio->CLAVE }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--INPUT STATUS-ALUMNO-->
                        <div class="field">
                            <div class="control">
                                <label class="label">Estatus del alumno:</label>
                                <div class="control">
                                    <div class="select" >
                                        <select name='txtStatusID'>
                                            @foreach ($estatus as $Estatus)
                                                <option value="{{ $Estatus->id }}">
                                                    {{ $Estatus->nombre_estatus }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--INPUT TIPO-->
                        <div class="field">
                            <div class="control">
                                <label class="label">Tipo de alumno:</label>
                                <div class="control">
                                    <div class="select" >
                                        <select name='txtTipo'>
                                            @foreach ($TAlumnos as $talumno)
                                                <option value="{{ $talumno->id }}">
                                                    {{ $talumno->nombre_tipo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--BOTON-->
                        <div class="has-text-centered">
                            <button class="button is-info" type="submit">
                                <span class="icon">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                </span>
                                <span>Guardar</span>
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <!--Modal para Editar un Alumno-->
        @foreach ($alumnos as $alumno)
        <div id="modal-{{$alumno->id}}" class="modal">
            <div class="modal-background"></div>

            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Modificar un Alumno</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form method="POST" action="{{route('AlumnoEditar', $alumno->id)}}">
                        @csrf
                        @method('PATCH')
                        <!--INPUT NOCONTROL-->
                        <div class="field">
                            <label class="label">No.Control:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtNoControlUP" value='{{$alumno->numero_control}}'>
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                        </div>
                        <!--INPUT NOMBRE ALUMNO-->
                        <div class="field">
                            <label class="label">Nombre alumno:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtNameAUP" value='{{$alumno->nombre_alumno}}'>
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                        </div>
                        <!--INPUT APELLIDO PATERNO-->
                        <div class="field">
                            <label class="label">Apellido Paterno:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtAPAUP" value='{{$alumno->ap_paterno}}'>
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                        </div>
                        <!--INPUT APELLIDO MATERNO-->
                        <div class="field">
                            <label class="label">Apellido Materno:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtAMAUP" value='{{$alumno->ap_materno}}'>
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                        </div>
                        <!--INPUT CURP-->
                        <div class="field">
                            <label class="label">CURP del alumno:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtCURPAUP" value='{{$alumno->curp}}'>
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                        </div>
                        <!--INPUT SEMESTRE-->
                        <div class="field">
                            <label class="label">Semestre:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="number" name="txtSemestreUP" value='{{$alumno->semestre}}'>
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                        </div>
                        <!--LISTA DE PLANES-ESTUDIO-->
                        <div class="field">
                            <div class="control">
                                <label class="label">Plan de estudio:</label>
                                <div class="control">
                                    <div class="select" >
                                        <select name='txtPlanIDUP'>
                                            @foreach ($planes as $planEstudio)
                                                <option value="{{ $planEstudio->id }}" {{ $planEstudio->id == $alumno->plan_id ? 'selected' : '' }}>
                                                    {{ $planEstudio->CLAVE }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--INPUT STATUS-ALUMNO-->
                        <div class="field">
                            <div class="control">
                                <label class="label">Estatus del alumno:</label>
                                <div class="control">
                                    <div class="select" >
                                        <select name='txtStatusIDUP'>
                                            @foreach ($estatus as $Estatus)
                                                <option value="{{ $Estatus->id }}" {{ $Estatus->id == $alumno->estatus_id ? 'selected' : '' }}>
                                                    {{ $Estatus->nombre_estatus }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--INPUT TIPO-->
                        <div class="field">
                            <div class="control">
                                <label class="label">Tipo de alumno:</label>
                                <div class="control">
                                    <div class="select" >
                                        <select name='txtTipoUP'>
                                            @foreach ($TAlumnos as $talumno)
                                                <option value="{{ $talumno->id }}" {{ $talumno->id == $alumno->tipoA_id ? 'selected' : '' }}>
                                                    {{ $talumno->nombre_tipo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Boton-->
                        <div class="has-text-centered">
                            <!--Boton de guardar-->
                            <button class="button is-info">
                                <span class="icon">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span>Guardar</span>
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
        @endforeach
        
        <!-- Modal de confirmación para eliminar -->
        <div id="modal-confirmacion" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Confirmar Eliminación</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <p>¿Realmente deseas eliminar este registro?</p>
                </section>
                <footer class="modal-card-foot has-text-centered">
                    <form id="form-eliminar" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button is-danger">
                            <span class="icon">
                                <i class="fas fa-trash-alt"></i>
                            </span>
                            <span>Sí</span>
                        </button>
                        <button class="button is-info">
                            <span class="icon">
                                <i class="fas fa-times"></i>
                            </span>
                            <span>No</span>
                        </button>
                    </form>
                </footer>
            </div>
        </div>
    </div>
@endsection