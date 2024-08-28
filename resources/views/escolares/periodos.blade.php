@extends('layouts.plantilla')
@section('content')    
<div class="box">
        <style>
            .modal-card-body .field {
                margin: 0 10px; /* Ajusta el margen horizontal según lo desees */
            }
        </style>
        <h1 class="title is-2 has-text-centered">Gestión de Periodos</h1>
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

        <!-- Botones accionarios con iconos -->
        <div class="buttons is-centered">
            <a href="{{ route('home') }}" class="button is-danger">
                <span class="icon">
                    <i class="fas fa-arrow-left"></i> <!-- Icono de flecha izquierda -->
                </span>
                <span>Regresar</span>
            </a>
            <a href="#" class="button is-info js-modal-trigger" data-target="modal-nvo-per">
                <span class="icon">
                    <i class="fas fa-plus-circle"></i> <!-- Icono de círculo con signo más -->
                </span>
                <span>Nuevo Periodo</span>
            </a>
        </div>

        <!--TABLAS DE Elementos a mostrar-->
        <div class="columns">
                <!-- Columna izquierda | PERIODOS-->
                <div class="column is-12">
                    <!-- Tabla de elementos a mostrar | PERIODOS-->
                    <div class="box">
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th class="has-text-centered">Clave</th>
                                <th class="has-text-centered">Periodo</th>
                                <th class="has-text-centered">Estatus</th>
                                <th class="has-text-centered">Opciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($periodos as $periodo)
                                <tr>
                                    <td class="has-text-centered">{{$periodo->clave_periodo}}</td>
                                    <td class="has-text-centered">{{$periodo->nombre_periodo}}</td>
                                    <td class="has-text-centered">{{$periodo->estatus}}</td>
                                    <td>
                                        <div class="has-text-centered">
                                            <button class="button is-info js-modal-trigger" data-target="modal-{{$periodo->id}}">
                                                <span class="icon">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span>Editar</span>
                                            </button>
                                            <button class="button is-danger js-delete-button" data-action="{{ route('PeriodoEliminar', $periodo->id)}}">
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

        <!--Modal para agregar un NUEVO PERIODO-->
        <div id="modal-nvo-per" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Agregar Periodo</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form method="POST" action="{{ route('PeriodoCrear') }}">
                        @csrf
                        @method('POST')
                        <div class="field is-grouped is-grouped-centered has-text-centered">
                            <!--Lista de AÑOS-->
                            <div class="field">
                                <label class="label">Año:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name='txtAño'>
                                            <option value="20">2020</option>
                                            <option value="21">2021</option>
                                            <option value="22">2022</option>
                                            <option value="23">2023</option>
                                            <option value="24">2024</option>
                                        </select>
                                    </div>
                                    <div class="icon is-small is-left">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <!--Lista de PERIODOS-->
                            <div class="field">
                                <label class="label">Periodos:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name='txtPeriodo'>
                                            <option value="1">Enero - Junio</option>
                                            <option value="2">Agosto - Diciembre</option>
                                            <option value="3">Verano</option>
                                        </select>
                                    </div>
                                    <div class="icon is-small is-left">
                                        <i class="fas fa-calendar-alt"></i> <!-- Icono de calendario -->
                                    </div>
                                </div>
                            </div>
                            <!--Lista de ESTATUS-->
                            <div class="field">
                                <label class="label">Estatus:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name='txtEstatus'>
                                            <option>Cerrado</option>
                                            <option>En Curso</option>
                                            <option>Preparación</option>
                                        </select>
                                    </div>
                                    <div class="icon is-small is-left">
                                        <i class="fas fa-check-circle"></i> <!-- Icono de círculo de verificación -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
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

        <!--Modal para Editar un Periodo-->
        @foreach ($periodos as $periodo)
            <div id="modal-{{$periodo->id}}" class="modal">
                <div class="modal-background"></div>

                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title has-text-centered">Modificar un Periodo</p>
                        <button class="delete" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <form method="POST" action="{{route('PeriodoEditar', $periodo->id)}}">
                            @csrf
                            @method('PATCH')
                            <div class="field is-grouped is-grouped-centered has-text-centered">
                                <!--Lista de AÑOS-->
                                <div class="field">
                                    <label class="label">Año:</label>
                                    <div class="control has-icons-left">
                                        <div class="select">
                                            <select name='txtAñoUP'>
                                                <option value="20">2020</option>
                                                <option value="21">2021</option>
                                                <option value="22">2022</option>
                                                <option value="23">2023</option>
                                                <option value="24">2024</option>
                                            </select>
                                        </div>
                                        <div class="icon is-small is-left">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                                <!--Lista de PERIODOS-->
                                <div class="field">
                                    <label class="label">Periodos:</label>
                                    <div class="control has-icons-left">
                                        <div class="select">
                                            <select name='txtPeriodoUP'>
                                                <option value="1">Enero - Junio</option>
                                                <option value="2">Agosto - Diciembre</option>
                                                <option value="3">Verano</option>
                                            </select>
                                        </div>
                                        <div class="icon is-small is-left">
                                            <i class="fas fa-calendar-alt"></i> <!-- Icono de calendario -->
                                        </div>
                                    </div>
                                </div>
                                <!--Lista de ESTATUS-->
                                <div class="field">
                                    <label class="label">Estatus:</label>
                                    <div class="control has-icons-left">
                                        <div class="select">
                                            <select name='txtEstatusUP'>
                                                <option>Cerrado</option>
                                                <option>En Curso</option>
                                                <option>Preparación</option>
                                            </select>
                                        </div>
                                        <div class="icon is-small is-left">
                                            <i class="fas fa-check-circle"></i> <!-- Icono de círculo de verificación -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
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