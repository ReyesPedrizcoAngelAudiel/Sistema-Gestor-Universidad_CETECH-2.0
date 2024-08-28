@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Gestión de alumnos</p>
        <p class="subtitle is-5 has-text-centered">{{$grupo->materia->nombre.' - Gpo: '.$grupo->letra_grupo.' - '.$grupo->docente->nombre.' '.$grupo->docente->ap_paterno.' '.$grupo->docente->ap_materno}}</p>
            <!--Botones accionarios-->
            <div class="buttons is-centered">
                <a  class="button is-danger" href="{{route('escolaresPlanesEstudios')}}">Regresar</a>
                <a  class="button is-info js-modal-trigger" data-target="modal-nvo-alumgpo">Nuevo Alumno</a>
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
                    <th class="has-text-centered">No. Control</th>
                    <th class="has-text-centered">Apellidos</th>
                    <th class="has-text-centered">Nombres</th>
                    <th class="has-text-centered">Semestre</th>
                    <th class="has-text-centered">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grupo_docente as $alumno_grupo)
                    <tr>
                        <td class="has-text-centered">{{ $alumno_grupo->alumno->numero_control }}</td>
                        <td class="has-text-centered">{{ $alumno_grupo->alumno->ap_paterno.' '.$alumno_grupo->alumno->ap_materno }}</td>
                        <td class="has-text-centered">{{ $alumno_grupo->alumno->nombre_alumno }}</td>
                        <td class="has-text-centered">{{ $alumno_grupo->alumno->semestre }}</td>
                        <!--Boton de eliminación-->
                        <td class="has-text-centered">
                            <button title="Eliminar" class="button is-danger js-delete-button" 
                                    data-action="{{ route('gruposAlumnoEliminar', ['id' => $grupo->id, 'id_alumno' => $alumno_grupo->alumno_id]) }}">
                                <span class="icon is-small">
                                    <i class="fas fa-trash-alt"></i>
                                </span>
                                <span> Eliminar</span>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal para crear Alumnos en un grupo -->
        <div id="modal-nvo-alumgpo" class="modal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Alumno</p>
                    <!-- Formulario para agregar un alumno a un grupo -->
                    <form method="POST" action="{{ route('gruposAlumnoAgregar', ['id' => $grupo->id]) }}">
                        @csrf
                        @method('POST')

                        <div class="field">
                            <label class="label">Alumno:</label>
                            <div class="control">
                                <div class="select">
                                    <select name="numero_control">
                                        @foreach ($alumnos as $alumno)
                                            <option value="{{ $alumno->numero_control }}">{{ $alumno->nombre_alumno }} - {{ $alumno->numero_control }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="has-text-centered">
                            <button class="button is-primary" type="submit">
                                <i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <button class="modal-close is-large" aria-label="close"></button>
        </div>

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