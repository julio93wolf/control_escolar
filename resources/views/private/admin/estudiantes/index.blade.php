@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Estudiantes
@endsection

@section('content')
	<div class="row">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s11 offset-s1">
		        <a href="{{route('menuAdmin')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('menuAdmin')}}#academicos" class="breadcrumb">Académicos</a>
		        <a href="{{route('estudiantes.index')}}" class="breadcrumb">Estudiantes</a>
		      </div>
		    </div>
		  </nav>
		</div>
		<div class="row blue white-text">
			<div class="col s10 offset-s1">
				<div class="section">
					<h5>Estudiantes</h5>
					  <p>Lista de estudiantes registrados en la Institución.</p>
				</div>
			</div>
		</div>
	</div>
@endsection