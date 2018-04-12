@extends('private.admin.layouts.scaffold')

@section('title')
	Nuevo Estudiante
@endsection

@section('content')
	<div class="row">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Nuevo estudiante</h4>
		  	<div class="divider"></div>
			</div>
			<h5><a class="valign-wrapper" href="{{route('estudiantes.index')}}"><i class="material-icons">arrow_back</i> Regresar</a></h5>
			
			
			<form id="form_docente" class="col s12" action="{{ route('estudiantes.store') }}" method="post" enctype="multipart/form-data" novalidate="novalidate">

				@include('private.admin.academicos.estudiantes.forms.form')

				<div class="row">
					<div class="input-field col s12">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="right-align">
							<button class="waves-effect waves-light btn center-align blue darken-2" type="submit">Guardar
						    <i class="material-icons left">send</i>
						  </button>
						</div>
					</div>
				</div>
			</form>		
			
		</div>
	</div>

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('js/form.estudiantes.js') }}"></script>
@endsection