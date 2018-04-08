<div class="section">
	<h5>Datos generales</h5>
	<p>Datos escenciales del docente.</p>
	<div class="divider"></div>
</div>

<div class="row">
	<div class="input-field col s12 l4">
		<i class="material-icons prefix">account_circle</i>
		<input id="nombre" name="nombre" type="text" class="validate" required="" aria-required="true">
		<label for="nombre">*Nombre</label>
	</div>
	<div class="input-field col s12 l4">
		<i class="hide-on-large-only material-icons prefix">account_circle</i>
		<input id="apaterno" name="apaterno" type="text" class="validate" required="" aria-required="true">
		<label for="apaterno">*Apellido paterno</label>
	</div>
	<div class="input-field col s12 l4">
		<i class="hide-on-large-only material-icons prefix">account_circle</i>
		<input id="amaterno" name="amaterno" type="text" class="validate" required="" aria-required="true">
		<label for="amaterno">*Apellido Materno</label>
	</div>
	<div class="input-field col s12 l6">
		<i class="material-icons prefix">sort_by_alpha</i>
		<input id="curp" name="curp" type="text" data-length="18" class="validate" required="" aria-required="true">
		<label for="curp">*CURP</label>
	</div>
	<div class="input-field col s12 l6">
		<i class="material-icons prefix">date_range</i>
		<input id="fecha_nacimiento" name="fecha_nacimiento" type="text" class="datepicker" class="validate" required="" aria-required="true">
		<label for="fecha_nacimiento">*Fecha de nacimiento</label>
	</div>
</div>

<div class="row">
	<div class="input-field col s12 m6 l4">
		<i class="material-icons prefix">favorite</i>
		<select id="estado_civil_id" name="estado_civil_id" class="validate" required="" aria-required="true">
			@foreach($estados_civiles as $estado_civil)
				@if(isset ($docente))
					<option value="{{ $estado_civil->id }}" 
						@if($estado_civil->id == $docente->dato_general->estado_civil_id)
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
		<label for="estado_civil_id">*Estado Civil</label>
	</div>
	<div class="input-field col s12 m6 l4">
		<i class="material-icons prefix">wc</i>
		<select id="sexo" name="sexo" class="validate" required="" aria-required="true">
			<option value="M">Hombre</option>
			<option value="F">Mujer</option>
			<option value="O">Otro</option>
		</select>
		<label for="sexo">*Sexo</label>
	</div>
	<div class="input-field col s12 m12 l4">
		<i class="material-icons prefix">flag</i>
		<select id="nacionalidad_id" name="nacionalidad_id" class="validate" required="" aria-required="true">
			@foreach($nacionalidades as $nacionalidad)
				@if(isset ($docente))
					<option value="{{ $nacionalidad->id }}" 
						@if($nacionalidad->id == $docente->nacionalidad_id)
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
		<label for="nacionalidad_id">*Nacionalidad</label>
	</div>
</div>

<div class="row">
	<div class="file-field input-field col s10">
    <div class="btn blue darken-4">
      <span>Foto</span>
      <input type="file">
    </div>
    <div class="file-path-wrapper">
      <input class="file-path validate" type="text">
    </div>
  </div>
  <div class="col s2">
  	<div class="card">
      <div class="card-image">
        <img class="hide" src="images/sample-1.jpg">
      </div>
      <div class="card-content">
      </div>
    </div>
  </div>
</div>

<div class="row">
	<p>Dirección</p>
	<div class="divider"></div>
	<div class="input-field col s12 l4">
		<i class="material-icons prefix">theaters</i>
		<input id="calle_numero" name="calle_numero" type="text" data-length="60" class="validate" required="" aria-required="true">
		<label for="calle_numero">*Calle y número</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">tab_unselected</i>
		<input id="colonia" name="colonia" type="text" data-length="60" class="validate" required="" aria-required="true">
		<label for="colonia">*Colonia</label>
	</div>	

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">filter_5</i>
		<input id="codigo_postal" name="codigo_postal" type="number" data-length="5" min=1 class="validate" required="" aria-required="true">
		<label for="codigo_postal">*Código postal</label>
	</div>
	<div class="input-field col s12 l4">
		<i class="material-icons prefix">broken_image</i>
		<select id="estado_id" name="estado_id">
			@foreach($estados as $estado)
				@if(isset ($docente))
					<option value="{{ $estado->id }}" 
						@if($estado->id == $docente->estado_id)
						 selected 
					@endif >{{ $estado->estado }}</option>	
				@else
					<option value="{{ $estado->id }}" 
						@if($estado->id == 11) 
							selected 
						@endif >{{ $estado->estado }}</option>	
				@endif
			@endforeach
		</select>
		<label for="estado_id">Estado</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">location_city</i>
		<select id="municipio_id" name="municipio_id">			
			@foreach($municipios as $municipio)
				@if(isset ($docente))
					<option value="{{ $municipio->id }}" 
						@if($municipio->id == $docente->municipio_id)
						 selected 
					@endif >{{ $municipio->municipio }}</option>	
				@else
					<option value="{{ $municipio->id }}" 
						@if($municipio->id == 327) 
							selected 
						@endif >{{ $municipio->municipio }}</option>	
				@endif
			@endforeach
		</select>
		<label class="active" for="municipio_id">Municipio</label>
	</div>	

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">domain</i>
		<select id="localidad_id" name="localidad_id" class="validate" required="" aria-required="true">
			@foreach($localidades as $localidad)
				@if(isset ($docente))
					<option value="{{ $localidad->id }}" 
						@if($localidad->id == $docente->municipio_id)
						 selected 
					@endif >{{ $localidad->localidad }}</option>	
				@else
					<option value="{{ $localidad->id }}" 
						@if($localidad->id == 94493) 
							selected 
						@endif >{{ $localidad->localidad }}</option>	
				@endif
			@endforeach
		</select>
		<label class="active" for="localidad_id">*Localidad</label>
	</div>	
</div>

<div class="row">
	<p>Contacto</p>
	<div class="divider"></div>
	<div class="input-field col s12 l4">
		<i class="material-icons prefix">phone_android</i>
		<input id="telefono_personal" name="telefono_personal" type="tel" data-length="20" class="validate" required="" aria-required="true">
		<label for="telefono_personal">Teléfono personal</label>
	</div>
	<div class="input-field col s12 l4">
		<i class="material-icons prefix">local_phone</i>
		<input id="telefono_casa" name="telefono_casa" type="tel" data-length="20" class="validate" required="" aria-required="true">
		<label for="telefono_casa">Teléfono de casa</label>
	</div>
	<div class="input-field col s12 l4">
		<i class="material-icons prefix">email</i>
		<input id="email" name="email" type="email" data-length="60" class="validate" required="" aria-required="true">
		<label for="email">E-mail</label>
	</div>	
</div>

<div class="row">
	<h5>Especifícos</h5>
	<p>Datos únicos del docente.</p>
	<div class="divider"></div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">account_circle</i>
		<input id="codigo" name="codigo" type="text" data-length="20" class="validate" required="" aria-required="true">
		<label for="codigo">Código</label>
	</div>
	<div class="input-field col s12 l4">
		<i class="material-icons prefix">account_circle</i>
		<input id="rfc" type="text" data-length="20" class="validate" required="" aria-required="true">
		<label name="rfc">RFC</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">list</i>
		<select id="titulo_id" name="titulo_id" class="validate" required="" aria-required="true">
			@foreach($titulos as $titulo)
				@if(isset ($docente))
					<option value="{{ $titulo->id }}" 
						@if($titulo->id == $docente->titulo_id)
						 selected 
					@endif >{{ $titulo->titulo }}</option>	
				@else
					<option value="{{ $titulo->id }}" 
						@if($titulo->id == 1) 
							selected 
						@endif >{{ $titulo->titulo }}</option>	
				@endif
			@endforeach
		</select>
		<label for="titulo_id">*Localidad</label>
	</div>	
</div>