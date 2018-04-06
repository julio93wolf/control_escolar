load_especialidades();

var periodo_especialidad = null;
var especialidad_id = null;
var asignatura_id = null;
var reticula_id = null;
var requisito_id = null;

$('#btn_tab_reticulas').on('click',function(event){
  load_especialidades();
});

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
  especialidad_id = $('#especialidad_id').val();
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
						<div id="periodo_`+i+`" class="col s12">
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
	$('#periodo_'+periodo+'').empty();
	var asignaturas_periodo = ``;
	$.get('/admin/escolares/reticulas/asignaturas',json,function(data){
		var asignaturas = data;
		for (var i = 0; i < asignaturas.length; i++) {
			var asignatura = asignaturas[i];
			asignaturas_periodo += print_card_reticula(asignatura,periodo);
		}
		asignaturas_periodo += new_card_reticula(periodo);
		$('#periodo_'+periodo+'').append(asignaturas_periodo);
		btn_add_reticula(periodo);
		for (var i = 0; i < asignaturas.length; i++) {
			var asignatura = asignaturas[i];
			btn_delete_reticula(asignatura.reticula);
      btn_requisito_asignatura(asignatura.reticula);
		}
	}).fail(function() {
		swal("Error", "Ocurrio un error al cargar las asignaturas.", "error");
	});
}

function print_card_reticula(asignatura,periodo){
	var card = 
	`<div class="col s12 m6 l4 xl3">
		<div class="card xsmall">
			<div class="card-content">
        <strong>`+asignatura.asignatura+`</strong>
        <div class="divider"></div>
        Código: `+asignatura.codigo+`<br>
        Créditos: `+asignatura.creditos+`<br>
        <a 
        	id="delete_reticula_`+asignatura.reticula+`"
        	class="btn-floating halfway-fab waves-effect waves-light red delete-asignatura"  
        	style="position: absolute; left:94%; top:-10%;"
        	reticula="`+asignatura.reticula+`"
          periodo_especialidad="`+periodo+`"
          asignatura="`+asignatura.asignatura+`"
        ><i class="material-icons">close</i></a>
        <a
          id="requisito_reticula_`+asignatura.reticula+`"
        	class="btn-floating halfway-fab waves-effect waves-light blue delete-asignatura" 
        	style="position: absolute; left:78%; top:-10%;"
          reticula="`+asignatura.reticula+`"
          asignatura="`+asignatura.asignatura+`"
        ><i class="material-icons">timeline</i></a>
      </div>
     </div>
  </div>`;
  return card;
}

function new_card_reticula(periodo){
	var card = 
	`<div class="col s12 m6 l4 xl3">
		<div class="card xsmall valign-wrapper">
			<div class="card-content" style="width: 100%;">
        <div class="valign-wrapper">
				  <h5 class="center-align" style="width: 100%;">Nueva Asignatura</h5>
				</div>
				<a 
					id="add_reticula_`+periodo+`"
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

function btn_add_reticula(periodo){
	$('#add_reticula_'+periodo).on('click', function(event) {
		periodo_especialidad = $(this).attr('periodo_especialidad');
		create_reticula();
	});
}

function btn_delete_reticula(reticula){
  $(`#delete_reticula_`+reticula+``).on('click', function() {
    periodo_especialidad = $(this).attr('periodo_especialidad');
    reticula_id = $(this).attr('reticula');
    asignatura = $(this).attr('asignatura');
    delete_reticula(asignatura);
  });
}

function btn_requisito_asignatura(reticula){
  $(`#requisito_reticula_`+reticula+``).on('click', function() {
    reticula_id = $(this).attr('reticula');
    asignatura = $(this).attr('asignatura');
    create_requisito(asignatura);
  });
}

function create_reticula(){
  load_asignaturas_especialidad();
  $('#title_modal_reticula').text('Agregar asignatura al período '+periodo_especialidad);
  $('#modal_reticula').modal('open');
}

function load_asignaturas_especialidad(){
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
    select_asignaturas:{
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
    periodo_especialidad = null;
    asignatura_id = null;
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

function delete_reticula(asignatura){
  swal({
    title: 'Desea eliminar '+asignatura+'',
    text: "Esta acción no se puede revertir",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si',
    cancelButtonText: 'Cancelar',
  }).then((result) => {
    if (result.value) {
      destroy_reticula();
    }
  });
}

function destroy_reticula(){
  $.ajax({
    url: '/admin/escolares/reticulas/'+reticula_id,
    type: 'DELETE',
    success: function(result) {      
      asignaturas_periodo(periodo_especialidad);
      swal({
        type: 'success',
        title: 'La asignatura ha sido eliminada',
        showConfirmButton: false,
        timer: 1500
      });
      periodo_especialidad = null;
      reticula_id = null;
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

//Requisitos

function create_requisito(asignatura){
  load_asignaturas_requisito();
  $('#title_modal_requisito').text('Requisitos para '+asignatura);
  $('#modal_requisito').modal('open');
}

function load_asignaturas_requisito(){
  $.get('/admin/select/asignaturas_requisito/'+reticula_id,function(data) {
    $('#select_requisitos').empty();
    for(i = 0; i < data.length; i++){
      $('#select_requisitos').append('<option value="' + data[i].reticula + '">' + data[i].asignatura + ' (' + data[i].codigo +')</option>');
    }
    $('#select_requisitos').select2();
    $("#select_requisitos").material_select();
  })
  .fail(function() {
    swal("Error", "Ocurrio un error al cargar las asignaturas.", "error");
  });
  asignaturas_requisito();
}

function asignaturas_requisito (){
  $('#requisitos_reticula').empty();
  var asignaturas_requisito = ``;
  $.get('/admin/escolares/reticulas/asignaturas_requisito/'+reticula_id,function(data){
    var asignaturas = data;
    for (var i = 0; i < asignaturas.length; i++) {
      var asignatura = asignaturas[i];
      asignaturas_requisito += print_card_requisito(asignatura);
    }
    $('#requisitos_reticula').append(asignaturas_requisito);
    for (var i = 0; i < asignaturas.length; i++) {
      var asignatura = asignaturas[i];
      btn_delete_requisito(asignatura.requisito);
    }
  }).fail(function() {
    swal("Error", "Ocurrio un error al cargar las asignaturas.", "error");
  });

}

function print_card_requisito(asignatura){
  var card = 
  `<div class="col s12 l6">
    <div class="card xsmall">
      <div class="card-content">
        <strong>`+asignatura.asignatura+`</strong>
        <div class="divider"></div>
        Código: `+asignatura.codigo+`<br>
        Créditos: `+asignatura.creditos+`<br>
        Periodo: `+asignatura.periodo_especialidad+`<br>
        <a 
          id="delete_requisito_`+asignatura.requisito+`"
          class="btn-floating halfway-fab waves-effect waves-light red delete-asignatura"  
          style="position: absolute; left:94%; top:-10%;"
          requisito="`+asignatura.requisito+`"
          asignatura="`+asignatura.asignatura+`"
        ><i class="material-icons">close</i></a>
      </div>
     </div>
  </div>`;
  return card;
}

function btn_delete_requisito(requisito){
  $(`#delete_requisito_`+requisito+``).on('click', function() {
    requisito_id = $(this).attr('requisito');
    asignatura = $(this).attr('asignatura');
    delete_requisito(asignatura);
  });
}

var validator = $("#form_requisito").validate({
  rules: {
    select_requisitos: {
      required: true,
      digits: true,
      min: 1
    }
  },
  messages: {
    select_requisitos:{
      required:  "La asginatura es requerida",
      digits: "La asignatura tiene que ser un número entero",
      min: "La asignatura tiene que ser mínimo 1"
    }
  },
  submitHandler: function(form) {
    json = {
      reticula_id: reticula_id,
      reticula_requisito_id: $('#select_requisitos').val()
    }
    store_requisito(json);
  }
});

function store_requisito(json){
  $.post('/admin/escolares/requisitos_reticulas',json,function(data){
    load_asignaturas_requisito();
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

function delete_requisito(asignatura){
  swal({
    title: 'Desea eliminar '+asignatura+'',
    text: "Esta acción no se puede revertir",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si',
    cancelButtonText: 'Cancelar',
  }).then((result) => {
    if (result.value) {
      destroy_requisito();
    }
  });
}

function destroy_requisito(){
  $.ajax({
    url: '/admin/escolares/requisitos_reticulas/'+requisito_id,
    type: 'DELETE',
    success: function(result) {      
      load_asignaturas_requisito();
      swal({
        type: 'success',
        title: 'La asignatura ha sido eliminada',
        showConfirmButton: false,
        timer: 1500
      });
      requisito_id = null;
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