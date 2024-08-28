@extends('layouts.plantilla')
@section('content')    
<div class="box">
        <h1 class="title is-2 has-text-centered">Materias de: {{$planes->carrera}}</h1>
        <hr>
        <div class="buttons is-centered">
            <a  class="button is-danger" href="{{route('escolaresPlanesEstudios')}}">Regresar</a>
            <a  class="button is-info js-modal-trigger" data-target="modal-nvo-mat">Nueva Materia</a>
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

        <!--TABLAS DE Elementos a mostrar-->
        <div class="columns">
                <!-- Columna izquierda | MATERIAS-->
                <div class="column is-12">
                    <!-- Tabla de elementos a mostrar | Materias-->
                    <div class="box">
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th class="is-hidden-mobile has-text-centered">Clave</th>
                                <th class="has-text-centered">Nombre</th>
                                <th class="has-text-centered">Creditos</th>
                                <th class="has-text-centered">Opciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($planes->materias as $materia)
                                <tr>
                                    <td class="is-hidden-mobile has-text-centered">{{$materia->clave_materia}}</td>
                                    <td class="has-text-centered">{{$materia->nombre}}</td>
                                    <td class="has-text-centered">{{$materia->creditos}}</td>
                                    <td>
                                        <div class="has-text-centered is-grouped">
                                            <button class="button is-danger js-delete-button" data-action="{{ route('MateriasPlanEliminar',[$planes->id, $materia->id])}}">
                                                <span class="icon">
                                                    <i class="fas fa-trash-alt"></i>
                                                </span>
                                                <span>Eliminar</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--Modal para agregar la nueva materia-->
        <div id="modal-nvo-mat" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Agregar Materia</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form method="POST" action="{{ route('MateriasPlanCrear', $planes->id) }}">
                        @csrf
                        @method('POST')
                        <!--Lista de materias-->
                        <div class="field">
                            <div class="control">
                                <label class="label">Materias:</label>
                                <div class="control">
                                    <div class="select" >
                                        <select name='txtIdMateria'>
                                            <option>Seleccionar Materias</option>
                                            @foreach ($materias as $materia)
                                                <option value="{{ $materia->id }}">
                                                    {{ $materia->clave_materia }} - {{ $materia->nombre }}
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