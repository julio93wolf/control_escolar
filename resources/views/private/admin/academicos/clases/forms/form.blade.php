<div class="section">
	<h5>Clase</h5>
	<p>Datos de la clase</p>
	<div class="divider"></div>
</div>

<div class="row">
	
	<div class="input-field col s12">
		<i class="material-icons prefix">account_circle</i>
		<input id="clase" name="clase" type="text" class="validate
		@if( $errors->has('clase')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('clase')){{ old('clase') }}@elseif(isset($clase)){{ $clase->clase }}@endif" >
		<label for="clase"
		@if( $errors->has('clase')) 
			class="active"
			data-error=" {{ $errors->first('clase',':message') }} "  
		@endif>*Clase</label>
	</div>
	
	<div class="input-field col s12" style="margin-bottom: 20px;">
		<i class="material-icons prefix">favorite</i>
		<select id="asignatura_id" name="asignatura_id" class="validate
		@if( $errors->has('asignatura_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($asignaturas as $asignatura)
				@if(old('asignatura_id'))
					<option value="{{ $asignatura->id }}" 
						@if($asignatura->id == old('asignatura_id')) 
							selected 
						@endif >{{ $asignatura->asignatura }}</option>	
				@elseif(isset($clase))
					<option value="{{ $asignatura->id }}" 
						@if($asignatura->id == $clase->asignatura_id)
							selected 
						@endif >{{ $asignatura->asignatura }}</option>	
				@else
					<option value="{{ $asignatura->id }}" 
						@if($asignatura->id == 1) 
							selected 
						@endif >{{ $asignatura->asignatura }}</option>	
				@endif
			@endforeach
		</select>
		<label for="asignatura_id" class="active"
		@if( $errors->has('asignatura_id')) 
			data-error=" {{ $errors->first('asignatura_id',':message') }} "  
		@endif>*Asignatura</label>
	</div>
	
	<div class="input-field col s12">
		<i class="material-icons prefix">favorite</i>
		<select id="docente_id" name="docente_id" class="validate
		@if( $errors->has('docente_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($docentes as $docente)
				@if(old('docente_id'))
					<option value="{{ $docente->id }}" 
						@if($docente->id == old('docente_id')) 
							selected 
						@endif >{{ 
							$docente->dato_general->nombre.' '.
							$docente->dato_general->apaterno.' '.
							$docente->dato_general->amaterno
						 }}</option>	
				@elseif(isset($clase))
					<option value="{{ $docente->id }}" 
						@if($docente->id == $clase->docente_id)
							selected 
						@endif >{{
							$docente->dato_general->nombre.' '.
							$docente->dato_general->apaterno.' '.
							$docente->dato_general->amaterno
						}}</option>	
				@else
					<option value="{{ $docente->id }}" 
						@if($docente->id == 1) 
							selected 
						@endif >{{
							$docente->dato_general->nombre.' '.
							$docente->dato_general->apaterno.' '.
							$docente->dato_general->amaterno
						}}</option>	
				@endif
			@endforeach
		</select>
		<label for="docente_id" class="active"
		@if( $errors->has('docente_id')) 
			data-error=" {{ $errors->first('docente_id',':message') }} "  
		@endif>*Docente</label>
	</div>
</div>

<div class="section">
	<h5>Horario</h5>
	<p>Horario de la clase</p>
	<div class="divider"></div>
</div>

@foreach($dias as $dia)
	<div class="row valign-wrapper">
		<div class="col s12 m2 l2">
	    <input type="checkbox" class="filled-in" id="dia_{{ $loop->index }}" name="dia[]" value="{{ $loop->index }}" index="{{ $loop->index }}"/>
	    <label for="dia_{{ $loop->index }}"/>{{ $dia->dia }}</label>
		</div>
		<div class="col s12 m5">
			<input id="hora_inicio_{{ $loop->index }}" name="hora_inicio[{{ $loop->index }}]" type="text" class="timepicker" disabled="true" />
			<label for="hora_inicio[{{ $loop->index }}]"></label>
		</div>

		<div class="col s12 m5">
			<input id="hora_salida_{{ $loop->index }}" name="hora_salida[{{ $loop->index }}]" type="text" class="timepicker
			@if( $errors->has('hora_salida.'.$loop->index) ) 
				invalid
			@endif"
			@if( $errors->has('hora_salida.'.$loop->index) )
				value="{{ old('hora_salida.'.$loop->index) }}" 
			@else
				disabled="true"
			@endif required="" aria-required="true" />
			<label for="hora_salida[{{ $loop->index }}]"
			@if( $errors->has('hora_salida.'.$loop->index)) 
				class="active"  
			@endif></label>
		</div>

	</div>	
@endforeach


@if( $errors->has('hora_salida.0') ) 
	{{ $errors->first('hora_salida.0',':message') }}
@else
	
@endif
