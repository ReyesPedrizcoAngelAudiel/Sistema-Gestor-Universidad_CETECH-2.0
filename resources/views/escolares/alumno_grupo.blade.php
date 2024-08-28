@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Materias Inscritas</p>        
            <!--Botones accionarios-->
            <div class="buttons is-centered">
                <a class="button is-danger" href="{{ route('home') }}">
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
                    <th class="has-text-centered">Periodo</th>
                    <th class="has-text-centered">Plan de estudios</th>
                    <th class="has-text-centered">Materia</th>
                    <th class="has-text-centered">Grupo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grupos as $alumnoGrupo)
                    @php
                        $grupo = $alumnoGrupo->grupo;
                    @endphp
                    <tr>
                        <td class="has-text-centered">{{ $grupo->periodo->clave_periodo.' | '.$grupo->periodo->nombre_periodo }}</td>
                        <td class="has-text-centered">{{ $grupo->planEstudio->carrera }}</td>
                        <td class="has-text-centered">{{ $grupo->materia->nombre }}</td>
                        <td class="has-text-centered">{{ $grupo->semestre.' '.$grupo->letra_grupo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection