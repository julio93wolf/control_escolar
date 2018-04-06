load_especialidades();
$('#asignaturas').select2();

var periodo_especialidad = null;
var especialidad_id = null;
var asignatura_id = null;

function load_especialidades (){
	var nivel_academico_id = $('#nivel_academico').val();
	$.get('/admin/select/especialidades_nivel/' + nivel_academico_id,function(data) {
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
	especialidad_id = $('#especialidad_id').val();
	$.get('/admin/escolares/especialidades/' + especialidad_id,function(data){
		var especialidad = data;		
		$('#section_reticula').empty();
		for (var i = 1; i <= especialidad.periodos; i++) {
			$('#section_reticula').append(`
				<div class="row">
					<h5>Período `+i+`:</h5>
					<div class="divider"></div><br>
					<div class="row">
						<div id="periodo_`+i+`_asignaturas" class="col s12">
						</div>
					</div>
				</div>
			`);
			asignaturas_periodo(i);
		}
		$('#name_reticula').text('Retícula de '+ $('#nivel_academico :selected').text() + ' en ' + $('#especialidad_id :selected').text());
	}).fail(function() {
		swal("Error", "Ocurrio un error al cargar la reticula.", "error");
	});
}

function asignaturas_periodo (periodo){
	json = {
		especialidad_id: especialidad_id,
		periodo_especialidad: periodo
	};
	$('#periodo_'+periodo+'_asignaturas').empty();
	var asignaturas_periodo = ``;
	$.get('/admin/escolares/reticulas/asignaturas',json,function(data){
		var asignaturas = data;
		for (var i = 0; i < asignaturas.length; i++) {
			var asignatura = asignaturas[i];
			asignaturas_periodo += print_card(asignatura,periodo);
		}
		asignaturas_periodo += new_card(periodo);
		$('#periodo_'+periodo+'_asignaturas').append(asignaturas_periodo);
		add_periodo(periodo);
		for (var i = 0; i < asignaturas.length; i++) {
			var asignatura = asignaturas[i];
			delete_asignatura(periodo,asignatura.id);
		}
	}).fail(function() {
		swal("Error", "Ocurrio un error al cargar las asignaturas.", "error");
	});
}

function print_card(asignatura,periodo){
	var card = 
	`<div class="col s12 m6 l4 xl3">
		<div class="card xsmall">
			<div class="card-content">
        <strong>`+asignatura.asignatura+`</strong>
        <div class="divider"></div>
        Código: `+asignatura.codigo+`<br>
        Créditos: `+asignatura.creditos+`<br>
        <a 
        	id="delete_asignatura_`+periodo+`_`+asignatura.id+`"
        	class="btn-floating halfway-fab waves-effect waves-light red delete-asignatura"  
        	style="position: absolute; left:94%; top:-10%;"
        	periodo_especialidad="`+periodo+`"
        	asignatura_id="`+asignatura.id+`"
        ><i class="material-icons">close</i></a>
        <a 
        	class="btn-floating halfway-fab waves-effect waves-light blue delete-asignatura" 
        	style="position: absolute; left:78%; top:-10%;"
        ><i class="material-icons">timeline</i></a>
      </div>
     </div>
  </div>`;
  return card;
}

function new_card(periodo){
	var card = 
	`<div class="col s12 m6 l4 xl3">
		<div class="card xsmall valign-wrapper">
			<div class="card-content" style="width: 100%;">
        <div class="valign-wrapper">
				  <h5 class="center-align" style="width: 100%;">Nueva Asignatura</h5>
				</div>
				<a 
					id="add_periodo_`+periodo+`"
					class="btn-floating halfway-fab waves-effect waves-light green" 
					style="position: absolute; left:78%; top:-10%;"
					periodo_especialidad="`+periodo+`" >
					<i class="material-icons">add</i>
				</a>
      </div>
     </div>
  </div>`;
  return card;
}

function add_periodo(periodo){
	$('#add_periodo_'+periodo).on('click', function(event) {
		periodo_especialidad = $(this).attr('periodo_especialidad');
		create_reticula(periodo);
	});
}

function delete_asignatura(periodo,asignatura){
	$(`#delete_asignatura_`+periodo+`_`+asignatura+``).on('click', function() {
		periodo_especialidad = $(this).attr('periodo_especialidad');
		asignatura_id = $(this).attr('asignatura_id');
		delete_reticula();
	});
}

$('a.delete-asignatura').on('click',function(){
	console.log('click');
});


function create_reticula(periodo){
	load_asignaturas();
	$('#title_modal_reticula').text('Agregar asignatura al período '+periodo);
	$('#modal_reticula').modal('open');
}

function load_asignaturas(){
	especialidad_id = $('#especialidad_id').val();
	$.get('/admin/select/asignaturas_especialidad/' + especialidad_id,function(data) {
		$('#select_asignaturas').empty();
		for(i = 0; i < data.length; i++){
			$('#select_asignaturas').append('<option value="' + data[i].id + '">' + data[i].asignatura + ' (' + data[i].codigo +')</option>');
		}
		$('#select_asignaturas').select2();
		$("#select_asignaturas").material_select();
	})
	.fail(function() {
		swal("Error", "Ocurrio un error al cargar las asignaturas.", "error");
	});
}

$.validator.setDefaults({
  errorClass: 'invalid',
  validClass: "valid",
  errorPlacement: function(error, element) {
    $(element)
      .closest("form")
      .find("label[for='" + element.attr("id") + "']")
      .attr('data-error', error.text());
  }
});

var validator = $("#form_reticula").validate({
	rules: {
    select_asignaturas: {
      required: true,
      digits: true,
    	min: 1
    }
	},
	messages: {
    creditos:{
    	required:  "La asginatura es requerida",
    	digits: "La asignatura tiene que ser un número entero",
    	min: "La asignatura tiene que ser mínimo 1"
    }
  },
  submitHandler: function(form) {
    json = {
      asignatura_id: $('#select_asignaturas').val(),
      especialidad_id: especialidad_id,
      periodo_especialidad: periodo_especialidad
    }
    store_reticula(json);
  }
});


function store_reticula(json){
  $.post('/admin/escolares/reticulas',json,function(data){
  	asignaturas_periodo(periodo_especialidad);
  	$('#modal_reticula').modal('close');
    swal({
      type: 'success',
      title: 'La asignatura ha sido agregada',
      showConfirmButton: false,
      timer: 1500
    });
  }).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
  });
}

function delete_reticula(){
  swal({
    title: 'Desea eliminar la asignatura?',
    text: "Esta acción no se puede revertir",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si',
    cancelButtonText: 'Cancelar',
  }).then((result) => {
    if (result.value) {
      json= {
        especialidad_id: especialidad_id,
        asignatura_id: asignatura_id,
        periodo_especialidad: periodo_especialidad
      };
      destroy_reticula(json);
    }
  });
}

function destroy_reticula(json){
  $.ajax({
    url: '/admin/escolares/reticulas/'+especialidad_id+'_'+asignatura_id,
    data: json,
    type: 'DELETE',
    success: function(result) {      
      asignaturas_periodo(periodo_especialidad);
      swal({
        type: 'success',
        title: 'El examen ha sido eliminado',
        showConfirmButton: false,
        timer: 1500
      });
      periodo_especialidad = null;
      asignatura_id = null;
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar la asignatura',
        text: 'La asignatura debe tener dependencias o clases asignadas'
      });  
    }
  });
}