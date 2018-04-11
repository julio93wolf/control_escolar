@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Asignaturas
@endsection

@section('content')
	<div class="row">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s10 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('admin.menu')}}#escolares" class="breadcrumb">Escolares</a>
		        <a href="{{route('asignaturas.index')}}" class="breadcrumb">Asignaturas</a>
		      </div>
		    </div>
		  </nav>
		</div>

		<div class="row blue white-text">
			<div class="hide-on-med-and-up">
				<br>
			</div>
			<div class="col s10 offset-s1">
					<h5>Asignaturas</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
					<p>Lista de asignaturas por nivel académico y carrera.</p>
			</div>
			<div class="col m5 right-align hide-on-small-only">
					<a id="create_asignatura" class="waves-effect waves-light btn center-align blue darken-2"><i class="material-icons left">add</i>Nueva asignatura</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s10 offset-s1">

			<table id="table_asignaturas" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código</th>
                <th>Asignatura</th>
                <th>Créditos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Código</th>
                <th>Asignatura</th>
                <th>Créditos</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>
		</div>
	</div>

	<div class="fixed-action-btn hide-on-med-and-up">
    <a href="#!" class="btn-floating btn-large blue darken-2">
      <i class="large material-icons">add</i>
    </a>
  </div>

	<form id="form_asignatura" novalidate="novalidate">
  <!-- Modal Structure -->
	<div id="modal_asignatura" class="modal">
		<div class="modal-content">
			
			<h5>Nueva asignatura</h5>
			<div class="divider"></div>
			<br>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">subject</i>
					<input type="text" id="asignatura" name="asignatura" required="" aria-required="true">
					<label for="asignatura">Asignatura</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">vpn_key</i>
					<input type="text" id="codigo" name="codigo" required="" aria-required="true">
					<label for="codigo">Código</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">exposure_plus_1</i>
					<input type="number" id="creditos" min="1" step="1" name="creditos" required="" aria-required="true" value="1">
					<label for="creditos">Créditos</label>
				</div>
			</div>	
		</div>
		<div class="modal-footer">
			<a class="waves-effect waves-red btn-flat modal-action modal-close" id="cancelar_asignatura"><i class="material-icons left">close</i>cancelar</a>
			<button id="store_asignatura" class="waves-effect waves-green btn-flat" type="submit" name="action">Guardar
		    <i class="material-icons left">save</i>
		  </button>

		</div>
	</div>
	</form>
@endsection

@section('script')
	{{-- @include('private.admin.escolares.asignaturas.scripts.index') --}}
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script type="text/javascript" src="{{ asset('/js/asignaturas.js') }}"></script>
	
@endsection