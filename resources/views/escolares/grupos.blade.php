@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Gestión de grupos</p>
        <p class="subtitle is-5 has-text-centered">{{ $planEstudio->carrera }}</p>
        
            <!--Botones accionarios-->
            <div class="buttons is-centered">
                <a  class="button is-danger" href="{{route('escolaresPlanesEstudios')}}">Regresar</a>
                <a  class="button is-info js-modal-trigger" data-target="modal-nvo-gpo">Nuevo Grupo</a>
            </div>

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

        <!--Tabla que puestra los valores de los grupos-->
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th class="has-text-centered">Periodo</th>
                    <th class="has-text-centered">Estatus</th>
                    <th class="has-text-centered">Plan Estudio</th>
                    <th class="has-text-centered">Materia</th>
                    <th class="has-text-centered">Semestre</th>
                    <th class="has-text-centered">Grupo</th>
                    <th class="has-text-centered">Capacidad</th>
                    <th class="has-text-centered">Docente</th>
                    <th class="has-text-centered">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planEstudio->grupos as $grupo)
                    <tr>
                        <td class="has-text-centered">{{ $grupo->periodo->clave_periodo.' | '.$grupo->periodo->nombre_periodo }}</td>
                        <td class="has-text-centered">{{ $grupo->periodo->estatus }}</td>
                        <td class="has-text-centered">{{ $grupo->planEstudio->carrera }}</td>
                        <td class="has-text-centered">{{ $grupo->materia->nombre }}</td>
                        <td class="has-text-centered">{{ $grupo->semestre }}</td>
                        <td class="has-text-centered">{{ $grupo->letra_grupo }}</td>
                        <td class="has-text-centered">{{ $grupo->capacidad }}</td>
                        <td class="has-text-centered">{{ $grupo->docente->ap_paterno.' '.$grupo->docente->ap_materno.' '.$grupo->docente->nombre }}</td>
                        <td>
                            <div class="buttons is-centered">
                                <!--BOTON DE EDITAR-->
                                <button class="button is-info js-modal-trigger" data-target="modal-update-{{ $grupo->id }}">
                                    <span class="icon is-small">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </button>
                                <!--BOTON ELIMINAR-->
                                <button title="Eliminar" class="button is-danger js-delete-button" data-action="{{ route('grupoDelete', [$planEstudio->id, $grupo->id]) }}">
                                    <span class="icon is-small">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                </button>
                                <!--BOTON PARA VISUALIZAR LOS ALUMNOS DE ESE GRUPO-->
                                @if ($grupo->periodo->estatus == 'En Curso')
                                <a class="button is-primary is-outlined" href="{{ route('gruposAlumnoVer', ['id' => $grupo->id]) }}">
                                    <span class="icon">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    <span>Visualizar</span>
                                </a>
                                @else
                                    <p class="notification is-primary is-outlined custom-notification">
                                        <span class="icon">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span> No disponible
                                    </p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!--Modal para crear grupos -->
        <div id="modal-nvo-gpo" class="modal">
            <div class="modal-background"></div>
        
            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Grupo</p>
                    <form method="POST" action="{{ route('grupoCreate', $planEstudio->id) }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <label class="label">Letra de grupo:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name = "txtLetraGrupo" 
                                    value="{{ old('txtLetraGrupo') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtLetraGrupo')
                                <p class="help is-danger">Ingresa la letra del grupo</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="label">Periodo:</label>
                            <div class="control has-icons-left">
                                <div class="select">
                                    <select name="selectPeriGrupo">
                                        <option value="">Seleccionar</option>
                                        @foreach ($periodos as $periodo)
                                            @if ($periodo->estatus != 'Cerrado')
                                                <option value="{{ $periodo->id }}">
                                                    {{ $periodo->nombre_periodo }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>                
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('selectPeriGrupo')
                                <p class="help is-danger">Ingresa el periodo</p>
                            @enderror
                        </div> 
                        <div class="field">
                            <label class="label">Materia:</label>
                            <div class="control has-icons-left">
                                <div class="select">
                                    <select name="selectMatGrup">
                                        <option value="">Seleccionar</option>
                                        @foreach ($materias as $materia)
                                            <option value="{{ $materia->id }}">
                                                {{ $materia->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>                
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('selectMatGrup')
                                <p class="help is-danger">Ingresa la materia del grupo</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="label">Semestre:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="number" name = "txtSemGrupo" 
                                    value="{{ old('txtSemGrupo') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtSemGrupo')
                                <p class="help is-danger">Ingresa el semestre de grupo</p>
                            @enderror
                        </div> 
                        <div class="field">
                            <label class="label">Docente:</label>
                            <div class="control has-icons-left">
                                <div class="select">
                                    <select name="selectDocenGrup">
                                        <option value="">Seleccionar</option>
                                        @foreach ($docentes as $docente)
                                            <option value="{{ $docente->id }}">
                                                {{ $docente->ap_paterno }} {{ $docente->ap_materno }} {{ $docente->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>                
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('selectDocenGrup')
                                <p class="help is-danger">Ingresa el docente del grupo</p>
                            @enderror
                        </div> 
                        <div class="field">
                            <label class="label">Capacidad:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="number" name = "txtCapGrupo" 
                                    value="{{ old('txtCapGrupo') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtCapGrupo')
                                <p class="help is-danger">Ingresa la capacidad del grupo</p>
                            @enderror
                        </div> 
                        <div class="has-text-centered">
                            <button class="button is-primary" type="submit"><i
                                    class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</a>
                        </div>
                    </form>
                </div>
            </div>
            <button class="modal-close is-large" aria-label="close"></button>
        </div>

        <!--Modal para Editar un grupo-->
        @foreach ($planEstudio->grupos as $grupo)
        <div id="modal-update-{{ $grupo->id }}" class="modal">
            <div class="modal-background"></div>

            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Modificar Grupo</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form method="POST" action="{{ route('grupoUpdate', [$planEstudio->id, $grupo->id] ) }}">
                        @csrf
                        @method('PATCH')
                        <!--Letra Grupo-->
                        <div class="field">
                            <label class="label">Letra de grupo:</label>
                                <div class="control">
                                    <input class="input" type="text" name="txtLetraGrupoUp" value="{{ $grupo->letra_grupo }}">
                                </div>
                        </div>
                        <!--Periodo-->
                        <div class="field">
                            <label class="label">Periodo:</label>
                            <div class="control">
                                <div class="select">
                                    <select name="selectPeriGrupoUp">
                                        @foreach ($periodos as $periodo)
                                            @if ($periodo->estatus != 'cerrado')
                                                <option value="{{ $periodo->id }}">
                                                    {{ $periodo->nombre_periodo }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>                
                            </div>
                        </div>
                        <!--Materia-->
                        <div class="field">
                            <label class="label">Materia:</label>
                            <div class="control">
                                <div class="select">
                                    <select name="selectMatGrupUp">
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->id }}">
                                            {{ $materia->nombre }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>                
                            </div>
                        </div>
                        <!--Semestre-->
                        <div class="field">
                            <label class="label">Semestre:</label>
                            <div class="control">
                                <input class="input" type="number" name="txtSemGrupoUp" value="{{ $grupo->semestre }}">
                            </div>
                        </div>
                        <!--Docente-->
                        <div class="field">
                            <label class="label">Docente:</label>
                            <div class="control">
                                <div class="select">
                                    <select name="selectDocenGrupUp">
                                        @foreach ($docentes as $docente)
                                            <option value="{{ $docente->id }}">
                                                {{ $docente->ap_paterno }} {{ $docente->ap_materno }} {{ $docente->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>                
                            </div>
                        </div>
                        <!--Capacidad-->
                        <div class="field">
                            <label class="label">Capacidad:</label>
                            <div class="control">
                                <input class="input" type="number" name="txtCapGrupoUp" value="{{ $grupo->capacidad }}">
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

    @if ($errors->has('txtClave') || $errors->has('txtCarrera') )
        <script>
            document.getElementById('modal-nvo-plan').classList.add('is-active');
        </script>
    @endif

@endsection