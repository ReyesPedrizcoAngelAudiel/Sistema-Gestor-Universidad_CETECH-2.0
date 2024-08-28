@extends('layouts.plantilla')
@section('content')    
<div class="box">
        <h1 class="title is-2 has-text-centered">Gestión de Materias</h1>
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

        <!--Botones accionarios-->
        <div class="buttons is-centered">
            <a  class="button is-danger" href="{{route('home')}}">Regresar</a>
            <a  class="button is-info js-modal-trigger" data-target="modal-nvo-mat">Nueva Materia</a>
        </div>

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
                            @foreach ($materias as $materia)
                                <tr>
                                    <td class="is-hidden-mobile">{{$materia->clave_materia}}</td>
                                    <td>{{$materia->nombre}}</td>
                                    <td>{{$materia->creditos}}</td>
                                    <td>
                                        <div class="has-text-centered is-grouped">
                                            <button class="button is-info js-modal-trigger" data-target="modal-{{$materia->id}}">
                                                <span class="icon">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </button>
                                            <button class="button is-danger js-delete-button" data-action="{{ route('MateriaEliminar', $materia->id)}}">
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
                    <form method="POST" action="{{ route('MateriaCrear') }}">
                        @csrf
                        @method('POST')
                        <!--INPUT CLAVE-->
                        <div class="field">
                            <label class="label">Clave de la materia:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtClaveM">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtClaveM')
                                <p class="help is-danger">Ingresa una clave para la materia</p>
                            @enderror
                        </div>
                        <!--INPUT NOMBRE-->
                        <div class="field">
                            <label class="label">Nombre de la materia:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtNameM">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtNameM')
                                <p class="help is-danger">Ingresa el nombre de la materia</p>
                            @enderror
                        </div>
                        <!--INPUT CREDITOS-->
                        <div class="field">
                            <label class="label">Creditos de la materia:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="number" name="txtCreditos">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('txtCreditos')
                                <p class="help is-danger">Ingresa el total de creditos</p>
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

        <!--Modal para Editar una MATERIA-->
        @foreach ($materias as $materia)
            <div id="modal-{{$materia->id}}" class="modal">
                <div class="modal-background"></div>

                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title has-text-centered">Modificar una Materia</p>
                        <button class="delete" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <form method="POST" action="{{route('MateriaEditar', $materia->id)}}">
                            @csrf
                            @method('PATCH')
                            <!--INPUT CLAVE-->
                            <div class="field">
                                <label class="label">Clave de materia:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="txtClaveMUP" value='{{$materia->clave_materia}}'>
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            <!--INPUT NOMBRE-->
                            <div class="field">
                                <label class="label">Nombre materia:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="txtNameMUP" value='{{$materia->nombre}}'>
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            <!--INPUT CREDITOS-->
                            <div class="field">
                                <label class="label">Creditos:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="number" name="txtCreditosUP" value='{{$materia->creditos}}'>
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
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
    </div>
@endsection