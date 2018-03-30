@extends('private.admin.layouts.scaffold')

@section('title')
	Nuevo Estudiante
@endsection

@section('content')
	<div class="row">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s11 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('admin.menu')}}#academicos" class="breadcrumb">Académicos</a>
		        <a href="{{route('estudiantes.index')}}" class="breadcrumb">Estudiantes</a>
		        <a href="{{route('estudiantes.create')}}" class="breadcrumb">Nuevo Estudiante</a>
		      </div>
		    </div>
		  </nav>
		</div>

		<div class="row blue white-text">
			<div class="hide-on-med-and-up">
				<br>
			</div>
			<div class="col s10 offset-s1">
					<h5>Nuevo estudiante</h5>				
			</div>
			<div class="col s10 offset-s1">
					<p>Datos escenciales del estudiantes.</p>
			</div>
		</div>
	</div>
	
	<div id="form_estudiante" class="row">
			@include('private.admin.estudiantes.forms.form')
	</div>
@endsection

@section('script')
	@include('private.admin.estudiantes.scripts.create')
@endsection