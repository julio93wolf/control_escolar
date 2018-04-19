@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Examenes
@endsection

@section('content')

	<div class="row">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Grupo {{ $clase->clase }} de {{ $clase->asignatura->asignatura }}</h4>
		  	<div class="divider"></div>
			</div>
			<h5><a class="valign-wrapper" href="{{route('clases.index')}}"><i class="material-icons">arrow_back</i> Regresar</a></h5>
			<br>
	
			<h5>Datos de la clase</h5>
            <div class="divider"></div>

            <div class="row">
                <div class="col s10 offset-s1 ">
                    <p>Clase: {{ $clase->clase }}</p>
                    <p>Periodo: {{ $clase->periodo->periodo }} ({{ $clase->periodo->anio }})</p>
                    <p>Docente: {{ $clase->docente->dato_general->nombre }} {{ $clase->docente->dato_general->apaterno }} {{ $clase->docente->dato_general->amaterno }}</p>

                    <table>
                        <thead>
                            <tr>
                                @foreach ($dias as $dia)
                                    <th>{{ $dia->dia }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                @foreach ($dias as $dia)
                                    <td>
                                    @foreach ($clase->horarios as $horario)
                                        @if ($horario->dia_id == $dia->id)
                                            {{ date("H:i", strtotime($horario->hora_entrada)).' : '.date("H:i", strtotime($horario->hora_salida)) }}
                                        @endif
                                    @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <h5>Agregar Alumno</h5>
            <div class="divider"></div>

            <form id="form_grupo" novalidate="novalidate">
                <div class="row">

                    <input type="hidden" id="clase_id" name="clase_id" value="{{$clase->id}}">
                    <input type="hidden" id="estudiante_id" name="estudiante_id">
                    <input type="hidden" id="oportunidad_id" name="oportunidad_id">
                    <input type="hidden" id="especialidad_id" name="especialidad_id" value="{{$clase->especialidad_id}}">

                                       
                    <div class="input-field col s12">
                        <i class="material-icons prefix">date_range</i>
                        <input id="matricula" name="matricula" type="text">
                        <label for="matricula">Matricula</label>
                    </div>

                    <div class="input-field col s12">
                        <i class="material-icons prefix">date_range</i>
                        <input id="nombre" name="nombre" type="text" disabled>
                        <label for="nombre">Nombre</label>
                    </div>

                    <div class="input-field col s12">
                        <i class="material-icons prefix">date_range</i>
                        <input id="semestre" name="semestre" type="text" disabled>
                        <label for="semestre">Semestre</label>
                    </div>

                    <div class="input-field col s12">
                        <i class="material-icons prefix">date_range</i>
                        <input id="oportunidad" name="oportunidad" type="text" disabled>
                        <label for="oportunidad">Oportunidad</label>
                    </div>
                    
                </div><br>
                <div class="section">
                    <div class="input-field col s12">
                            <div class="right-align">
                                <a id="cancel_plan_especialidad" class="waves-effect waves-light btn red darken-2 hide">Cancelar<i class="material-icons left">clear</i></a>
                                <button id="save_fecha_examen" class="waves-effect waves-light btn center-align blue darken-2" type="submit">Guardar<i class="material-icons left">send</i></button>
                            </div>
                        </div>
                </div>
            </form>
    
            			

			<table id="table_grupo" class="display highlight" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Semestre</th>
                        <th>Oportunidad</th>
                        <th>Quitar</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Semestre</th>
                        <th>Oportunidad</th>
                        <th>Quitar</th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
		</div>
	</div>
@endsection

@section('script')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script type="text/javascript" src="{{ asset('/js/admin/academicos/grupos.js') }}"></script>
@endsection