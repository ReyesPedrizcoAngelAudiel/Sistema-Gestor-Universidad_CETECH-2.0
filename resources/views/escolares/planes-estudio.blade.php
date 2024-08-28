@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <h1 class="title is-2 has-text-centered">Gestion de planes de estudio y especialidades</h1>
        <hr>
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
        <div class="columns">
                <!-- Columna izquierda | PLANES-->
                <div class="column is-6">
                    <!-- Tabla de elementos a mostrar | PLANES-->
                    <div class="box">
                        <h1 class="title is-2 has-text-centered">Plan de estudios</h1>
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                            <thead>
                                <tr>
                                    <th class="is-hidden-mobile has-text-centered">Plan de Estudio</th>
                                    <th class="has-text-centered">Carrera</th>
                                    <th class="has-text-centered">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($planes as $item)
                                <tr>
                                    <td>{{$item->CLAVE}}</td>
                                    <td>{{$item->carrera}}</td>
                                    <td>
                                        <div class="buttons is-centered">
                                            <!--BOTON EDITAR-->
                                            <button title="Editar" class="button is-info js-modal-trigger" data-target="modal-{{$item->id}}">
                                                <span class="icon is-small">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </button>
                                            <!--BOTON ELIMINAR-->
                                            <button title="Eliminar" class="button is-danger js-delete-button" data-action="{{ route('PlanesEstudioEliminar', $item->id) }}" {{ $item->especialidades->count() > 0 ? 'disabled' : '' }}>
                                                <span class="icon is-small">
                                                    <i class="fas fa-trash-alt"></i>
                                                </span>
                                            </button>
                                            <!--BOTON VER MATERIAS-->
                                            <form action="{{route('MateriasPlanMostrar', $item->id)}}" method="GET">
                                                <button type="submit" class="button is-primary is-outlined" title="Ver materias">
                                                    <span class="icon is-small">
                                                        <i class="fas fa-book"></i>
                                                    </span>
                                                </button>
                                            </form>
                                            <!--BOTON DE AGREGAR GRUPOS-->
                                            <form action="{{ route('escolaresGrupo', $item->id) }}" method="GET">
                                                <button type="submit" class="button is-info is-outlined" title="Ver Grupos">
                                                    <span class="icon is-small">
                                                        <i class="fa-solid fa-people-roof"></i>
                                                    </span>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Columna derecha | ESPECIALIDADES-->
                <div class="column is-6">
                    <!-- Tabla de elementos a mostrar | ESPECIALIDADES-->
                    <div class="box">
                        <h1 class="title is-2 has-text-centered">Especialidades</h1>
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                            <thead>
                                <tr>
                                    <th class="is-hidden-mobile has-text-centered">Especialidad</th>
                                    <th class="has-text-centered">Plan de Estudio</th>
                                    <th class="has-text-centered">Opciones</th>
                                </tr>
                            </thead>
                                @foreach ($especialidad as $item)
                                    <tr>
                                        <td>{{$item->nombre_especialidad}}</td>
                                        <td>{{$item->planEstudio->CLAVE}}</td>
                                        <td>
                                            <div class="has-text-centered">
                                                <button class="button is-info js-modal-trigger" data-target="modal-especialidad-{{$item->id}}">
                                                    <span class="icon">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </button>
                                                <button class="button is-danger js-delete-button" data-action="{{ route('EspecialidadEliminar', $item->id) }}">
                                                    <span class="icon">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!--Botones accionarios-->
            <div class="buttons">
                <a  class="button is-danger" href="{{route('home')}}">Regresar</a>
                <a  class="button is-info js-modal-trigger" data-target="modal-nvo-plan">Nuevo Plan</a>
                <a  class="button is-primary js-modal-trigger" data-target="modal-nvo-especialidad">Nueva Especialidad</a>
            </div>
        </div>

        <!--Nodelos PARA PLANES ESTUDIO-->
        <!--Modal para agregar el nuevo plan de estudio-->
        <div id="modal-nvo-plan" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Agregar Plan de Estudio</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form method="POST" action="{{ route('PlanesEstudioCrear') }}">
                        @csrf
                        @method('POST')
                        <!--INPUT CLAVE-->
                        <div class="field">
                            <label class="label">Clave del Plan de Estudios:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtClave" value="{{ old('txtClave') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtClave')
                            <p class="help is-danger">Ingresa la clave del plan de estudios</p>
                            @enderror
                        </div>
                        <!--INPUT CARRERA-->
                        <div class="field">
                            <label class="label">Nombre de la carrera:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtCarrera" value="{{ old('txtCarrera') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('txt_carrera')
                            <p class="help is-danger">Ingresa el nombre de la carrera</p>
                            @enderror
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

        <!--Modal para Editar un plan de estudio-->
        @foreach ($planes as $item)
        <div id="modal-{{$item->id}}" class="modal">
            <div class="modal-background"></div>

            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Modificar el plan de estudio</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form method="POST" action="{{route('PlanesEstudioEditar', $item->id)}}">
                        @csrf
                        @method('PATCH')
                        <!--Input clave-->
                        <div class="field">
                            <label class="label">CLAVE</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" value='{{$item->CLAVE}}' name="txt_clave">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-key"></i>
                                </span>
                            </div>
                        </div>
                        <!--Input carrera-->
                        <div class="field">
                            <label class="label">CARRERA</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" value='{{$item->carrera}}' name="txt_carrera">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-graduation-cap"></i>
                                </span>
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

        <!--Nodelos PARA ESPECIALIDADES-->
        <!--Modal para agregar una ESPECIALIDAD-->
        <div id="modal-nvo-especialidad" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Agregar Especialidad</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form method="POST" action="{{ route('EspecialidadCrear') }}">
                        @csrf
                        @method('POST')
                        <!--Lista de planes de estudio-->
                        <div class="field">
                            <div class="control">
                                <label class="label">Plan de Estudio:</label>
                                <div class="control">
                                    <div class="select" >
                                        <select name='txtPlanEstudio'>
                                            <option>Seleccionar Carrera</option>
                                            @foreach ($planes as $planEstudio)
                                                <option value="{{$planEstudio->id}}">{{ $planEstudio->CLAVE }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--INPUT NombreEspecialidad-->
                        <div class="field">
                            <label class="label">Nombre Especialidad:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtEspecialidad" value="{{ old('txtEspecialidad') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtEspecialidad')
                            <p class="help is-danger">Ingresa el nombre del edificio</p>
                            @enderror
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

        <!--Modal para Editar una ESPECIALIDAD-->
        @foreach ($especialidad as $item)
            <div id="modal-especialidad-{{$item->id}}" class="modal">
                <div class="modal-background"></div>

                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title has-text-centered">Modificar la especialidad</p>
                        <button class="delete" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <form method="POST" action="{{route('EspecialidadEditar', $item->id)}}">
                            @csrf
                            @method('PATCH')
                            <!--Lista de Planes de estudio-->
                            <div class="field">
                                <div class="control">
                                    <label class="label">Plan de estudio:</label>
                                    <div class="control">
                                        <div class="select" >
                                            <select name='txtPlanEstudio'>
                                                @foreach ($planes as $planEstudio)
                                                <option value="{{ $planEstudio->id }}" {{ $planEstudio->id == $item->plan_id ? 'selected' : '' }}>
                                                    {{ $planEstudio->CLAVE }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--INPUT Nombre Especialidad-->
                            <div class="field">
                                <label class="label">Especialidad:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="txtEspecialidad" value="{{$item->nombre_especialidad}}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
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
    </div>
@endsection