@extends('layouts.plantilla')

@section('content')
<div class="box">
        <div class="columns is-multiline is-mobile">
            @hasrole('escolares')
            <!--ALUMNOS-->
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-users"></i> Alumnos</h1>
                    <p>Gestiona los diferentes alumnos</p><br>
                    <a  class="button is-info" href="{{route('alumno')}}">Acceder</a>
                </div>
            </div>
            <!--DOCENTES-->
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-address-card"></i> Docentes</h1>
                    <p>Controla y gestiona a los docentes</p><br>
                    <a  class="button is-info" href="{{route('docentes')}}">Acceder</a>
                </div>
            </div>
            <!--EDIFICIOS Y SALONES-->
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-building"></i> Edificios y Salones</h1>
                    <p>Gestiona los edificios y salones</p><br>
                    <a  class="button is-info" href="{{route('edificio')}}">Acceder</a>
                </div>
            </div>
            <!--PERIODOS-->
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-book-open"></i> Periodos</h1>
                    <p>Gestiona los periodos existentes</p><br>
                    <a  class="button is-info" href="{{route('Periodo')}}">Acceder</a>
                </div>
            </div>
            @endhasrole

            @hasrole('docente')
            <!--LISTAS-->
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-users"></i> Listas</h1>
                    <p>Ver listas de grupos</p><br>
                    <a  class="button is-info" href="">Acceder</a>
                </div>
            </div>
            <!--CALIFICACIONES-->
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-address-card"></i> Calificaciones</h1>
                    <p>Subir calificaciones</p><br>
                    <a  class="button is-info" href="{{ route('DocenteGrupo') }}">Acceder</a>
                </div>
            </div>
            @endhasrole

            @hasrole('div_estudios')
            <!--MATERIAS-->
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-book-open"></i> Materias</h1>
                    <p>Crea, Edita y elimina materias</p><br>
                    <a  class="button is-info" href="{{route('materia')}}">Acceder</a>
                </div>
            </div>
            <!--PLANES DE ESTUDIO-->
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-address-card"></i> Planes de estudio</h1>
                    <p>Gestiona los planes de estudio, las materias y los grupos</p><br>
                    <a  class="button is-info" href="{{route('escolaresPlanesEstudios')}}">Acceder</a>
                </div>
            </div>
            @endhasrole

            @hasrole('alumno')
            <!--PLANES DE ESTUDIO-->
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-address-card"></i> Materias Inscritas</h1>
                    <p>Visualiza las materias a las que perteneces</p><br>
                    <a class="button is-info" href="{{ route('AlumnoGruposMostrar') }}">Acceder</a>
                </div>
            </div>
            @endhasrole
        </div>
    </div>
@endsection
