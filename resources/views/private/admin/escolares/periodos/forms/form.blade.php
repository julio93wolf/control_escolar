<div class="row">
	<div class="input-field col s12">
		<i class="material-icons prefix">account_circle</i>
		<input id="periodo" name="periodo" type="text" class="validate" required="" aria-required="true" value="@if(isset($periodo)){{ $periodo->periodo }}@else{{ old('periodo') }}@endif">
		<label for="periodo" >Periodo</label>
	</div>
</div>

<div class="row">
	<div class="input-field col s12">
		<i class="material-icons prefix">date_range</i>
		<input id="anio" name="anio" type="number" class="validate" required="" aria-required="true" value="@if(isset($periodo)){{ $periodo->anio }}@else{{ old('anio') }}@endif">
		<label for="anio">Año</label>
	</div>
</div>

<div class="row">
	<div class="input-field col s12">
		<i class="material-icons prefix">account_circle</i>
		<input id="reconocimiento_oficial" name="reconocimiento_oficial" type="text" class="validate 
			@if( $errors->has('reconocimiento_oficial')) 
				invalid  
			@endif" required="" aria-required="true" value="@if(isset($periodo)){{ $periodo->reconocimiento_oficial }}@else{{ old('reconocimiento_oficial') }}@endif">
		<label for="reconocimiento_oficial" 
			@if( $errors->has('reconocimiento_oficial')) 
				class="active"
				data-error=" {{ $errors->first('reconocimiento_oficial',':message') }} "  
			@endif>Reconocimiento Oficial</label>
	</div>
</div>

<div class="row">
	<div class="input-field col s12">
		<i class="material-icons prefix">vpn_key</i>
		<input id="dges" name="dges" type="text" class="validate 
			@if( $errors->has('dges')) 
				invalid  
			@endif" required="" aria-required="true" value="@if(isset($periodo)){{ $periodo->dges }}@else{{ old('dges') }}@endif">
		<label for="dges"
		@if( $errors->has('dges')) 
			class="active"
			data-error=" {{ $errors->first('dges',':message') }} "  
		@endif>DGES</label>
		
	</div>
</div>

<div class="row">
	<div class="input-field col s12">
		<i class="material-icons prefix">date_range</i>
		<input id="fecha_reconocimiento" name="fecha_reconocimiento" type="text" class="datepicker" required="" aria-required="true" value="@if(isset($periodo)){{ $periodo->fecha_reconocimiento }}@else{{ old('fecha_reconocimiento') }}@endif">
		<label for="fecha_reconocimiento">Fecha de reconocimiento</label>
	</div>
</div>