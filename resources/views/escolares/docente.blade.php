@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <h1 class="title is-2 has-text-centered">Docentes</h1>
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
        <!-- Tabla de elemenos a mostrar -->
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th class="is-hidden-mobile has-text-centered">RFC</th>
                    <th class="has-text-centered">NOMBRE</th>
                    <th class="has-text-centered">APELLIDO PATERNO</th>
                    <th class="has-text-centered">APELLIDO MATERNO</th>
                    <th class="is-hidden-mobile has-text-centered">CURP</th>
                    <th class="is-hidden-mobile has-text-centered">EMAIL</th>
                    <th class="has-text-centered">BOTONES</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($docentes as $item)
                    <tr>
                        <td class="is-hidden-mobile">{{$item->rfc}}</td>
                        <td>{{$item->nombre}}</td>
                        <td>{{$item->ap_paterno}}</td>
                        <td>{{$item->ap_materno}}</td>
                        <td class="is-hidden-mobile">{{$item->curp}}</td>
                        <td class="is-hidden-mobile">{{$item->email}}</td>
                        <td>
                            <div class="has-text-centered">
                                <button class="button is-info js-modal-trigger" data-target="modal-{{$item->id}}">
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                    <span>Editar</span>
                                </button>
                                <button class="button is-danger js-delete-button" data-action="{{ route('DocenteEliminar', $item->id) }}">
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

        <!--Modal para agregar el nuevo docente-->
        <div id="modal-nvo-plan" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Agregar Docente</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form method="POST" action="{{ route('DocenteCrear') }}">
                        @csrf
                        @method('POST')
                        <!--INPUT RFC-->
                        <div class="field">
                            <label class="label">RFC Docente:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtRfc" value="{{ old('txtRfc') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtRfc')
                            <p class="help is-danger">Ingresa el Rfc</p>
                            @enderror
                        </div>
                        <!--INPUT NOMBRE-->
                        <div class="field">
                            <label class="label">Nombre docente:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtName" value="{{ old('txtName') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtName')
                            <p class="help is-danger">Ingresa el nombre del docente</p>
                            @enderror
                        </div>
                        <!--INPUT APELLIDO PATERNO-->
                        <div class="field">
                            <label class="label">Apellido Paterno:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtAP" value="{{ old('txtAP') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('txtAP')
                            <p class="help is-danger">Ingresa el Apellido Paterno</p>
                            @enderror
                        </div>
                        <!--INPUT APELLIDO MATERNO-->
                        <div class="field">
                            <label class="label">Apellido Materno:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtAM" value="{{ old('txtAM') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('txtAM')
                            <p class="help is-danger">Ingresa el Apellido Materno</p>
                            @enderror
                        </div>
                        <!--INPUT CURP-->
                        <div class="field">
                            <label class="label">CURP del docente:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtCURP" value="{{ old('txtCURP') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('txtCURP')
                            <p class="help is-danger">Ingresa el CURP</p>
                            @enderror
                        </div>
                        <!--INPUT EMAIL-->
                        <div class="field">
                            <label class="label">Email del docente</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtEmail" value="{{ old('txtEmail') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('txtEmail')
                            <p class="help is-danger">Ingresa el email del docente</p>
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

        <!--Modal para Editar un DOCENTE-->
        @foreach ($docentes as $item)
        <div id="modal-{{$item->id}}" class="modal">
            <div class="modal-background"></div>

            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Modificar el Docente</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form method="POST" action="{{route('DocenteEditar', $item->id)}}">
                        @csrf
                        @method('PATCH')
                        <!--INPUT RFC-->
                        <div class="field">
                            <label class="label">RFC Docente: </label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" value='{{$item->rfc}}' name="txtRfc">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-key"></i>
                                </span>
                            </div>
                        </div>
                        <!--INPUT NOMBRE-->
                        <div class="field">
                            <label class="label">Nombre docente:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtName" value="{{$item->nombre}}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                        </div>
                        <!--INPUT APELLIDO PATERNO-->
                        <div class="field">
                            <label class="label">Apellido Paterno:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtAP" value="{{$item->ap_paterno}}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                        </div>
                        <!--INPUT APELLIDO MATERNO-->
                        <div class="field">
                            <label class="label">Apellido Materno:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtAM" value="{{$item->ap_materno}}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                        </div>
                        <!--INPUT CURP-->
                        <div class="field">
                            <label class="label">CURP del docente:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtCURP" value="{{$item->curp}}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                        </div>
                        <!--INPUT EMAIL-->
                        <div class="field">
                            <label class="label">Email del docente</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtEmail" value="{{$item->email}}">
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

        <div class="buttons">
            <a  class="button is-danger" href="{{route('home')}}">Regresar</a>
            <a  class="button is-info js-modal-trigger" data-target="modal-nvo-plan">Nuevo Docente</a>
        </div>
    </div>
@endsection