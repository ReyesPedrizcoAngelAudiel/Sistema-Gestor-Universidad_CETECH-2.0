@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Lista de alumnos</p>
        <p class="subtitle is-5 has-text-centered">Grupos Asignados</p>
        
            <!--Botones accionarios-->
            <div class="buttons is-centered">
                <a class="button is-danger" href="{{ route('home') }}">
                    <span class="icon">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span>Regresar</span>
                </a>
            </div>

        <!--Tabla que muestra los valores de los grupos-->
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th class="has-text-centered">Periodo</th>
                    <th class="has-text-centered">Plan de estudios</th>
                    <th class="has-text-centered">Materia</th>
                    <th class="has-text-centered">Grupo</th>
                    <th class="has-text-centered">Alumnos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grupos as $grupo)
                    <tr>
                        <td class="has-text-centered">{{ $grupo->periodo->clave_periodo.' | '.$grupo->periodo->nombre_periodo }}</td>
                        <td class="has-text-centered">{{ $grupo->planEstudio->carrera }}</td>
                        <td class="has-text-centered">{{ $grupo->materia->nombre }}</td>
                        <td class="has-text-centered">{{ $grupo->semestre.' '.$grupo->letra_grupo }}</td>
                        <td>
                            <div class="buttons is-centered">
                                <!--BOTON visualizar-->
                                @if ($grupo->periodo->estatus == 'En Curso')
                                <a class="button is-info is-outlined is-small" href="{{ route('AlumnoDocenteMostrar', $grupo->id) }}">
                                    <span class="icon">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    <span>Visualizar</span>
                                </a>
                                @else
                                    <p class="notification is-danger is-outlined custom-notification">
                                        <span class="icon is-small">
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
    </div>
@endsection
