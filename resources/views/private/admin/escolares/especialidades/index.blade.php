@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Especialidades
@endsection

@section('content')
	<div class="row" style="margin-bottom: 0px;">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s10 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('admin.menu')}}#escolares" class="breadcrumb">Escolares</a>
		        <a href="{{route('especialidades.index')}}" class="breadcrumb">Especialidades</a>
		      </div>
		    </div>
		  </nav>
		</div>
		<div class="row blue white-text">
			<div class="nav-content blue col s10 offset-s1">
				<ul id="tabs_especialidades_reticulas" class="tabs tabs-transparent">
					<li class="tab"><a href="#tab_especialidades" class="active">Lista de especialidades</a></li>
					<li class="tab"><a href="#tab_reticulas" >Retículas</a></li>
				</ul>
			</div>	
		</div>
	</div>
	
	<div id="tab_especialidades" class="row">
		<div class="row blue white-text">
			<div class="hide-on-med-and-up"><br></div>
			<div class="col s10 offset-s1">
				<h5>Especialidades</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
				<p>Gestor de especialidades.</p>
			</div>
			<div class="col m5 right-align hide-on-small-only">
				<a id="create_especialidad" class="waves-effect waves-light btn center-align blue darken-2"><i class="material-icons left">add</i>Nueva especialidad</a>
			</div>	
		</div>
		<div class="col s10 offset-s1">
			<table id="table_especialidades" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Especialidad</th>
                <th>Detalles</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Codigo</th>
                <th>Especialidad</th>
                <th>Detalles</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>
		</div>
	</div>

	<div id="tab_reticulas" class="row">
		<div class="row blue white-text">
			<div class="hide-on-med-and-up"><br></div>
			<div class="col s10 offset-s1">
				<h5>Reticulas</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
				<p>Gestor de reticulas.</p>
			</div>
		</div>
		<div class="col s10 offset-s1">
			
		</div>
	</div>

	<form id="form_especialidad" novalidate="novalidate">
	<!-- Nueva especialidad -->
	<div id="modal_especialidad" class="modal modal-fixed-footer add">
		<div class="modal-content">
			
			<h4>Nueva especialidad</h4>
			<div class="row">
			<br>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">list</i>
					<select id="nivel_academico_id" name="nivel_academico_id" class="validate" required="" aria-required="true"> 
						@foreach($niveles_academicos as $nivele_academico)
						<option value="{{ $nivele_academico -> id }}">{{ $nivele_academico -> nivel_academico }}</option>
						@endforeach
					</select>
					<label for="nivel_academico_id">Nivel Académico</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">account_circle</i>
					<input id="especialidad" name="especialidad" type="text" class="validate" required="" aria-required="true">
					<label for="especialidad">Especialidad</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">account_circle</i>
					<input id="clave" name="clave" type="text" class="validate" required="" aria-required="true">
					<label for="clave">Código</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">account_circle</i>
					<input id="periodos" name="periodos" type="number" class="validate" required="" aria-required="true">
					<label for="periodos">Perdiodos a cursar</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">account_circle</i>
					<input type="text" class="validate" id="descripcion">
					<label>Descripción</label>
				</div>
			</div>
			
			<br>
			<div class="divider"></div>
			<br>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">list</i>
					<select id="modalidad_id" name="modalidad_id" class="validate" required="" aria-required="true">
						@foreach($modalidades_especialidades as $modalidad_especialidad)
							<option value="{{ $modalidad_especialidad -> id }}">{{ $modalidad_especialidad -> modalidad_especialidad }}</option>
						@endforeach
					</select>
					<label for="modalidad_id" >Modalidad</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">list</i>
					<select id="tipo_plan_especialidad_id" name="tipo_plan_especialidad_id" class="validate" required="" aria-required="true">
						@foreach($tipos_planes_especialidades as $tipo_plan_especialidad)
							<option value="{{ $tipo_plan_especialidad -> id }}">{{ $tipo_plan_especialidad -> tipo_plan_especialidad }}</option>
						@endforeach
					</select>
					<label for="tipo_plan_especialidad_id">Tipo de plan</label>
				</div>
			</div>

			<br>
			<div class="divider"></div>
			<br>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">account_circle</i>
					<input id="reconocimiento_oficial" name="reconocimiento_oficial" type="text" class="validate" required="" aria-required="true">
					<label for="reconocimiento_oficial">Reconocimiento oficial</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">account_circle</i>
					<input id="fecha_reconocimiento" name="fecha_reconocimiento" type="text" class="datepicker" class="validate" required="" aria-required="true">
					<label for="fecha_reconocimiento">Fecha de reconocimiento oficial</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">account_circle</i>
					<input id="dges" name="dges" type="text" class="validate">
					<label for="dges">DGES</label>
				</div>
			</div>

		</div>

		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close btn-flat waves-effect waves-red"><i class="material-icons left">close</i>Cancelar</a>
			<button id="store_especialidad" class="btn-flat waves-effect waves-green"><i class="material-icons left">save</i>Guardar</button>

		</div>
	</div>
</form>

	<div class="fixed-action-btn hide-on-med-and-up">
    <a href="#!" class="btn-floating btn-large blue darken-2">
      <i class="large material-icons">add</i>
    </a>
  </div>

@endsection

@section('script')
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script type="text/javascript" src="{{ asset('/js/especialidades.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/reticulas.js') }}"></script>
@endsection