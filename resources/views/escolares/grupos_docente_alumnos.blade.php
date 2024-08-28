@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Lista de alumnos</p>
        <!-- Mostrar la información del grupo específico -->
        <p class="subtitle is-5 has-text-centered">
            {{ $grupo->materia->nombre . ' - Gpo:' . $grupo->letra_grupo }}
        </p>
            <!--Botones accionarios-->
            <div class="buttons is-centered">
                <a class="button is-danger" href="{{ route('DocenteGrupo') }}">
                    <span class="icon">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span>Regresar</span>
                </a>
            </div>

        <!--Tabla que puestra los valores de los grupos-->
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th class="has-text-centered">No. Control</th>
                    <th class="has-text-centered">Apellidos</th>
                    <th class="has-text-centered">Nombres</th>
                    <th class="has-text-centered">Semestre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grupo_docente as $alumno_grupo)
                    <tr>
                        <td class="has-text-centered">{{ $alumno_grupo->alumno->numero_control }}</td>
                        <td class="has-text-centered">{{ $alumno_grupo->alumno->ap_paterno.' '.$alumno_grupo->alumno->ap_materno }}</td>
                        <td class="has-text-centered">{{ $alumno_grupo->alumno->nombre_alumno }}</td>
                        <td class="has-text-centered">{{ $alumno_grupo->alumno->semestre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection