@extends('layouts.plantilla')
@section('content')
    <div class="box">
        
        <h1 class="title is-2 has-text-centered">Gestión de Edificios y Salones</h1>
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
                <!-- Columna izquierda | EDIFICIOS-->
                <div class="column is-6">
                    <!-- Tabla de elementos a mostrar | Edificios-->
                    <div class="box">
                        <h1 class="title is-2 has-text-centered">Edificios</h1>
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th class="is-hidden-mobile has-text-centered">Edificio</th>
                                <th class="has-text-centered">Descripcion</th>
                                <th class="has-text-centered">Opciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($edificios as $item)
                                <tr>
                                    <td class="is-hidden-mobile">{{$item->nombre_edificio}}</td>
                                    <td>{{$item->descripcion}}</td>
                                    <td>
                                        <div class="has-text-centered">
                                            <button class="button is-info js-modal-trigger" data-target="modal-{{$item->id}}">
                                                <span class="icon">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span>Editar</span>
                                            </button>
                                            <button class="button is-danger js-delete-button" data-action="{{ route('EdificioEliminar', $item->id)}}" {{ $item->salones->count() > 0 ? 'disabled' : '' }}>
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

                <!-- Columna derecha | SALONES-->
                <div class="column is-6">
                    <!-- Tabla de elementos a mostrar | Salones-->
                    <div class="box">
                        <h1 class="title is-2 has-text-centered">Salones</h1>
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                            <thead>
                                <tr>
                                    <th class="is-hidden-mobile has-text-centered">Salón</th>
                                    <th class="has-text-centered">Edificio</th>
                                    <th class="has-text-centered">Opciones</th>
                                </tr>
                            </thead>
                                @foreach ($salon as $item)
                                    <tr>
                                        <td class="is-hidden-mobile">{{$item->nombre_salon}}</td>
                                        <td>{{$item->edificio->nombre_edificio}}</td>
                                        <td>
                                            <div class="has-text-centered">
                                                <button class="button is-info js-modal-trigger" data-target="modal-salon-{{$item->id}}">
                                                    <span class="icon">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                    <span>Editar</span>
                                                </button>
                                                <button class="button is-danger js-delete-button" data-action="{{ route('SalonEliminar', $item->id) }}">
                                                    <span class="icon">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </span>
                                                    <span>Eliminar</span>
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

            <div class="buttons is-centered">
                <a  class="button is-danger" href="{{route('home')}}">Regresar</a>
                <a  class="button is-info js-modal-trigger" data-target="modal-nvo-plan">Nuevo Edificio</a>
                <a  class="button is-primary js-modal-trigger" data-target="modal-nvo-salon">Nuevo Salon</a>
            </div>
        </div>
        
        <!--Nodelos PARA EDIFICIOS-->

        <!--Modal para agregar un edifico-->
        <div id="modal-nvo-plan" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Agregar Edificio</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form method="POST" action="{{ route('EdificioCrear') }}">
                        @csrf
                        @method('POST')
                        <!--INPUT NombreEdificio-->
                        <div class="field">
                            <label class="label">Nombre Edificio:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtNombreE" value="{{ old('txtNombreE') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtNombreE')
                            <p class="help is-danger">Ingresa el Edificio</p>
                            @enderror
                        </div>
                        <!--INPUT DESCRIPCION-->
                        <div class="field">
                            <label class="label">Descripcion:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtDescripcion" value="{{ old('txtDescripcion') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtDescripcion')
                            <p class="help is-danger">Ingresa una descripcion</p>
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

        <!--Modal para Editar un edificio-->
        @foreach ($edificios as $item)
            <div id="modal-{{$item->id}}" class="modal">
                <div class="modal-background"></div>

                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title has-text-centered">Modificar el Edificio</p>
                        <button class="delete" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <form method="POST" action="{{route('EdificioEditar', $item->id)}}">
                            @csrf
                            @method('PATCH')
                            <!--INPUT nombre Edificio-->
                            <div class="field">
                                <label class="label">Nombre Edificio: </label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" value='{{$item->nombre_edificio}}' name="txtNombreE">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            <!--INPUT Descripcion-->
                            <div class="field">
                                <label class="label">Descripcion:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="txtDescripcion" value="{{$item->descripcion}}">
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

        <!--Nodelos PARA SALONES-->

        <!--Modal para agregar un salon-->
        <div id="modal-nvo-salon" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-centered">Agregar Salon</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form method="POST" action="{{ route('SalonCrear') }}">
                        @csrf
                        @method('POST')
                        <!--Lista de edificios-->
                        <div class="field">
                            <div class="control">
                                <label class="label">Edificio:</label>
                                <div class="control">
                                    <div class="select" >
                                        <select name='txtEdificio'>
                                            <option>Seleccionar edificio</option>
                                            @foreach ($edificios as $edificio)
                                                <option value="{{$edificio->id}}">{{ $edificio->nombre_edificio }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--INPUT NombreEdificio-->
                        <div class="field">
                            <label class="label">Nombre Edificio:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="txtNombreS" value="{{ old('txtNombreS') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtNombreS')
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

        <!--Modal para Editar un salon-->
        @foreach ($salon as $item)
            <div id="modal-salon-{{$item->id}}" class="modal">
                <div class="modal-background"></div>

                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title has-text-centered">Modificar el Salon</p>
                        <button class="delete" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <form method="POST" action="{{route('SalonEditar', $item->id)}}">
                            @csrf
                            @method('PATCH')
                            <!--Lista de edificios-->
                            <div class="field">
                                <div class="control">
                                    <label class="label">Edificio:</label>
                                    <div class="control">
                                        <div class="select" >
                                            <select name='txtEdificio'>
                                                <option>Seleccionar edificio</option>
                                                @foreach ($edificios as $edificio)
                                                    <option value="{{$edificio->id}}">{{ $edificio->nombre_edificio }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--INPUT Nombre edificio-->
                            <div class="field">
                                <label class="label">Salon:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="txtNombreS" value="{{$item->nombre_salon}}">
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