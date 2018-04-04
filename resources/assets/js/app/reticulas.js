load_especialidades();

function load_especialidades (){
	var nivel_academico_id = $('#nivel_academico').val();
	$.get('/admin/select/especialidades/' + nivel_academico_id,function(data) {
		$('#especialidad_id').empty();
		for(i = 0; i < data.length; i++){
			$('#especialidad_id').append('<option value="' + data[i].id + '">' + data[i].especialidad + ' (' + data[i].clave +')</option>');
		}
		$('#especialidad_id').material_select();
		load_reticula ();
	})
	.fail(function() {
		swal("Error", "Ocurrio un error al cargar las especialidades.", "error");
	});
}

$('#nivel_academico').change(function(){
	load_especialidades();
});

$('#especialidad_id').change(function(){
	load_reticula();
});

function load_reticula (){
	var especialidad_id = $('#especialidad_id').val();
	$.get('/admin/escolares/especialidades/' + especialidad_id,function(data){
		
		$('#section_reticula').empty();
		var especialidad = data.especialidad;
		var asignaturas = data.asignaturas;

		console.log(asignaturas);

		for (var i = 1; i <= especialidad.periodos; i++) {

			var asignaturas_periodo = ``;

			for (var j = 0; j < asignaturas.length; j++) {
				var asignatura = asignaturas[j];
				if(asignatura.pivot.periodo_especialidad == i){
					asignaturas_periodo += print_card(asignatura);
				}
			}

			$('#section_reticula').append(`
				<div class="row">
					<h5>Periodo `+i+`:</h5>
					<div class="divider"></div><br>
					<div class="row">
						<div="col s12">
							`+asignaturas_periodo+new_card()+`
						</div>
					</div>
				</div>
			`);
		}
	}).fail(function() {
		swal("Error", "Ocurrio un error al cargar la reticula.", "error");
	});
}

function print_card(asignatura){
	var card = 
	`<div class="col s12 m6 l4 xl3">
		<div class="card xsmall">
			<div class="card-content">
        <strong>`+asignatura.asignatura+`</strong>
        <div class="divider"></div>
        Código: `+asignatura.codigo+`<br>
        Créditos: `+asignatura.creditos+`<br>
        <a class="btn-floating halfway-fab waves-effect waves-light red" style="position: absolute; left:94%; top:-10%;"><i class="material-icons">close</i></a>
        <a class="btn-floating halfway-fab waves-effect waves-light blue" style="position: absolute; left:78%; top:-10%;"><i class="material-icons">timeline</i></a>
      </div>
     </div>
  </div>`;
  return card;
}

function new_card(){
	var card = 
	`<div class="col s12 m6 l4 xl3">
		<div class="card xsmall valign-wrapper">
			<div class="card-content" style="width: 100%;">
        <div class="valign-wrapper">
				  <h5 class="center-align" style="width: 100%;">Nueva Asignatura</h5>
				</div>
				<a class="btn-floating halfway-fab waves-effect waves-light green" style="position: absolute; left:78%; top:-10%;"><i class="material-icons">add</i></a>
      </div>
     </div>
  </div>`;
  return card;
}