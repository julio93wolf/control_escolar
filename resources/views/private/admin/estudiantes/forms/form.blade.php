<form class="col s10 offset-s1">

	<h5>Datos Generales</h5>
	<div class="section">
    <div class="input-field col s12 l4">
			<i class="material-icons prefix">account_circle</i>
			<input type="text" class="validate" id="nombre" required data-length="30">
			<label>*Nombre</label>
		</div>

		<div class="input-field col s12 l4">
			<i class="hide-on-large-only material-icons prefix">account_circle</i>
			<input type="text" class="validate" id="apaterno" required data-length="30">
			<label>*Apellido Paterno</label>
		</div>

		<div class="input-field col s12 l4">
			<i class=" hide-on-large-only material-icons prefix">account_circle</i>
			<input type="text" class="validate" id="amaterno" required data-length="30">
			<label>*Apellido Materno</label>
		</div>

		<div class="input-field col s12">
			<i class="material-icons prefix">sort_by_alpha</i>
			<input type="text" class="validate" id="curp" required data-length="18">
			<label>*CURP</label>
		</div>
  </div>
	<div class="section">
    <div class="input-field col s12 m6 l3">
				<i class="material-icons prefix">date_range</i>
				<input type="text" class="datepicker" id="fecha_nacimiento" required>
				<label>*Fecha de nacimiento</label>
		</div>
		<div class="input-field col s12 m6 l3">
			<i class="material-icons prefix">favorite</i>
			<select id="estado_civil_id" required>
				@foreach($estados_civiles as $estado_civil)
					@if(isset ($estudiante))
						<option value="{{ $estado_civil->id }}" 
							@if($estado_civil->id == $estudiante->dato_general->estado_civil_id)
							 selected 
						@endif >{{ $estado_civil->estado_civil }}</option>	
					@else
						<option value="{{ $estado_civil->id }}" 
							@if($estado_civil->id == 1) 
								selected 
							@endif >{{ $estado_civil->estado_civil }}</option>	
					@endif
				@endforeach
			</select>
			<label>*Estado Civil</label>
		</div>
		<div class="input-field col s12 m6 l3">
			<i class="material-icons prefix">flag</i>
			<select id="nacionalidad_id" required>
				@foreach($nacionalidades as $nacionalidad)
					@if(isset ($estudiante))
						<option value="{{ $nacionalidad->id }}" 
							@if($nacionalidad->id == $estudiante->nacionalidad_id)
							 selected 
						@endif >{{ $nacionalidad->nacionalidad }}</option>	
					@else
						<option value="{{ $nacionalidad->id }}" 
							@if($nacionalidad->id == 104) 
								selected 
							@endif >{{ $nacionalidad->nacionalidad }}</option>	
					@endif
				@endforeach
			</select>
			<label>*Nacionalidad</label>
		</div>
		<div class="input-field col s12 m6 l3">
			<i class="material-icons prefix">wc</i>
			<select id="sexo" required>
				<option value="1">Hombre</option>
				<option value="2">Mujer</option>
				<option value="3">Otro</option>
			</select>
			<label>*Sexo</label>
		</div>
  </div>

  <div class="section">
  	<p>Dirección</p>
  	<div class="divider"></div>
  	<div class="input-field col s12 l4">
			<i class="material-icons prefix">theaters</i>
			<input type="text" class="validate" id="calle_numero" required data-length="60">
			<label>*Calle y número</label>
		</div>

		<div class="input-field col s12 l4">
			<i class="material-icons prefix">tab_unselected</i>
			<input type="text" class="validate" id="colonia" required data-length="60">
			<label>Colonia</label>
		</div>	

		<div class="input-field col s12 l4">
			<i class="material-icons prefix">filter_5</i>
			<input type="text" class="validate" id="codigo_postal" required data-length="5">
			<label>Código postal</label>
		</div>
  </div>
  <div class="section">
  	<div class="input-field col s12 l4">
			<i class="material-icons prefix">broken_image</i>
			<select id="estado_id" required>
				<option>A</option>
  			<option>B</option>
  			<option>C</option>
			</select>
			<label>Estado</label>
		</div>

		<div class="input-field col s12 l4">
			<i class="material-icons prefix">location_city</i>
			<select id="municipio_id" required>
				
			</select>
			<label>Municipio</label>
		</div>

		<div class="input-field col s12 l4">
			<i class="material-icons prefix">domain</i>
			<select id="localidad_id" required>
				
			</select>
			<label>*Localidad</label>
		</div>	
  </div>

  <div class="section">
  	<p>Contacto</p>
  	<div class="divider"></div>
  	<div class="input-field col s12 l4">
			<i class="material-icons prefix">phone_android</i>
			<input type="text" class="validate" id="telefono_personal" data-length="20">
			<label>Teléfono personal</label>
		</div>
		<div class="input-field col s12 l4">
			<i class="material-icons prefix">local_phone</i>
			<input type="text" class="validate" id="telefono_casa" data-length="20">
			<label>Teléfono de casa</label>
		</div>
		<div class="input-field col s12 l4">
			<i class="material-icons prefix">email</i>
			<input type="email" class="validate" id="email" data-length="60">
			<label>E-mail</label>
		</div>	
  </div>

	<h5>Específicos</h5>
	<p>Datos únicos del estudiante.</p>

	<div class="section">
		<div class="input-field col s12 m6">
			<i class="material-icons prefix">vpn_key</i>
			<input type="text" class="validate" id="matricula" disabled data-length="10">
			<label>Matrícula</label>
		</div>
		<div class="input-field col s12 m6">
			<i class="material-icons prefix">school</i>
			<select id="especialidad_id">
				
			</select>
			<label>Especialidad</label>
		</div>
	</div>
	<div class="section">
		<div class="input-field col s12 m6">
			<i class="material-icons prefix">sort</i>
			<select id="modalidad_id">
				
			</select>
			<label>Modalidad</label>
		</div>
		<div class="input-field col s12 m6">
			<i class="material-icons prefix">traffic</i>
			<select id="estado_estudiante_id">
				
			</select>
			<label>Estado</label>
		</div>
	</div>
	<div class="section">
		<div class="input-field col s12">
			<i class="material-icons prefix">mode_edit</i>
			<textarea class="materialize-textarea" id="otros"></textarea>
			<label for="icon_prefix2">Detalles</label>
		</div>
	</div>

	<div class="input-field col s12">
		<div class="right-align">
			<button class="waves-effect waves-light btn center-align blue darken-2" id="guardarPersona"><i class="material-icons right">send</i>Guardar</button>
		</div>
	</div>
	
</form>

	

				
{{--
		<div class="section">
		  <h5>Específicos</h5>
		  <p>Datos únicos del estudiante.</p>
		</div>
		<div class="divider"></div>

		<div class="row">
			<div class="col s10 offset-s1" id="">

				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">vpn_key</i>
						<input type="text" class="validate" id="matricula" disabled data-length="10" @if(isset($estudiante_id)) value="{{ $estudiante -> matricula }}" @else  value="{{ $matricula + 1 }}" @endif>
						<label>Matrícula</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">school</i>
						<select id="especialidad_id">
							@foreach($especialidades as $especialidad)
							<option value="{{ $especialidad -> id }}">{{ $especialidad -> especialidad }}</option>
							@endforeach
						</select>
						<label>Especialidad</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">traffic</i>
						<select id="estado_estudiante_id">
							@foreach($estados_estudiante as $estado)
							<option value="{{ $estado -> id }}">{{ $estado -> estado }}</option>
							@endforeach
						</select>
						<label>Estado</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">sort</i>
						<select id="modalidad_id">
							@foreach($modalidades as $modalidad)
							<option value="{{ $modalidad -> id }}">{{ $modalidad -> modalidad }}</option>
							@endforeach
						</select>
						<label>Modalidad</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">mode_edit</i>
						<textarea class="materialize-textarea" id="otros">@if(isset($estudiante_id)){{ $estudiante -> otros }}@endif</textarea>
						<label for="icon_prefix2">Detalles</label>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
						<div class="right-align">
							<button class="waves-effect waves-light btn center-align blue darken-2" id="guardarEspecificos"><i class="material-icons right">send</i>Guardar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col s10 offset-s1 @if(!isset($estudiante_id)) disabled @endif" id="datosReferencia">
		<br><label class="btn-regresar blue-text back"><i class="material-icons">replay</i>Regresar</label>
		<div class="section">
		  <h5>Referéncias</h5>
		  <p>Datos de referencia del estudiante.</p>
		</div>
		<div class="divider"></div>

		<div class="row">
			<div class="col s10 offset-s1" id="">

				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">compare_arrows</i>
						<select id="enterado_por_id">
							@foreach($medios as $medio)
							<option value="{{ $medio -> id }}">{{ $medio -> medio }}</option>
							@endforeach
						</select>
						<label>Enterado por</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s9">
						<i class="material-icons prefix">school</i>
						<select id="instituto_id">
							@foreach($institutos as $instituto)
							<option value="{{ $instituto -> id }}">{{ $instituto -> instituto }}</option>
							@endforeach
						</select>
						<label>Instituto de procedencia</label>
					</div>
					<div class="input-field col s3">
						<div class="right-align">
							<a class="waves-effect waves-light btn center-align blue darken-2" id="nuevoInstituto">Nuevo instituto</a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s9">
						<i class="material-icons prefix">work</i>
						<select id="empresa_id">
							@foreach($empresas as $empresa)
							<option value="{{ $empresa -> id }}">{{ $empresa -> empresa }}</option>
							@endforeach
						</select>
						<label>Trabajo</label>
					</div>
					<div class="input-field col s3">
						<div class="right-align">
							<a class="waves-effect waves-light btn center-align blue darken-2" id="nuevoTrabajo">Nuevo trabajo</a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">filter_list</i>
						<input type="text" class="validate" id="puesto" data-length="40" @if(isset($estudiante_id)) value="{{ $referenciasEstudiantes -> puesto }}" @endif>
						<label>Puesto</label>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
						<div class="right-align">
							<a class="waves-effect waves-light btn center-align blue darken-2" id="guardarReferencias"><i class="material-icons right">send</i>Guardar</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col s10 offset-s1 @if(!isset($estudiante_id)) disabled @endif" id="datosDocumentos">
		<br><label class="btn-regresar blue-text back"><i class="material-icons">replay</i>Regresar</label>
		<div class="section">
		  <h5>Docuemntos</h5>
		  <p>Documentación entreganda por el estudiante.</p>
		</div>
		<div class="divider"></div>

		<div class="row">
			<div class="col s10 offset-s1" id="">
				@foreach($documentos as $key => $documento)
				<div class="row">
					<div class="input-field col s12">
						<input type="checkbox"  id="documento_{{ $documento -> id }}" />
						<label for="documento_{{ $documento -> id }}">{{ $documento -> documento }}</label>
					</div>
				</div>
				@endforeach
				<div class="row">
					<div class="input-field col s12">
						<div class="right-align">
							<a class="waves-effect waves-light btn center-align blue darken-2" id='guardarDocumentos'><i class="material-icons right">send</i>Guardar</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
--}}