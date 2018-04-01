load_especialidades();
load_reticulas();
load_asignaturas();

var new_asignatura = false;

function load_especialidades (){
	var nivel_academico_id = $('#nivel_academico_id').val();
	$.get('/admin/select/especialidades/' + nivel_academico_id,function(data) {
		$('#especialidad_id').empty();
		for(i = 0; i < data.length; i++){
			$('#especialidad_id').append('<option value="' + data[i].id + '">' + data[i].especialidad + ' (' + data[i].clave +')</option>');
		}
		$('#especialidad_id').material_select();
		load_reticulas();
	})
	.fail(function() {
		swal("Error", "Ocurrio un error al cargar las especialidades.", "error");
	});
}

function load_reticulas (){
	var especialidad_id = $('#especialidad_id').val();
	$.get('/admin/select/reticulas/' + especialidad_id,function(data) {
		$('#reticula_id').empty();
		for(i = 0; i < data.length; i++){
			$('#reticula_id').append('<option value="' + data[i].id + '">' + data[i].reticula + '</option>');
		}
		$('#reticula_id').material_select();
		load_asignaturas();
	})
	.fail(function() {
		swal("Error", "Ocurrio un error al cargar las reticulas.", "error");
	});
}

function load_asignaturas(){
	var reticula_id = $('#reticula_id').val();
	$('#table_id').DataTable({
  	"language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },
    destroy: true,
    processing: true,
    serverSide: true,
    ajax: '/admin/datatable/asignaturas/'+reticula_id,
    columns: [
        { data: 'codigo',			name: 'codigo' },
        { data: 'asignatura',	name: 'asignatura' },
        { data: 'creditos',		name: 'creditos' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a href="/admin/escolares/asignaturas/`+data+`/edit" class="btn-floating btn-meddium waves-effect waves-light"><i class="material-icons circle green">mode_edit</i></a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_id_length']").val('10');
  $("select[name$='table_id_length']").material_select();
}

$('#nivel_academico_id').change(function(){
	load_especialidades();
});

$('#especialidad_id').change(function(){
	load_reticulas();
});

$('#reticula_id').change(function(){
	load_asignaturas();
});

$('#btn_nueva_asignatura').on('click',function(){
	$('#nombre_especialidad').text($('#nivel_academico_id :selected').text() +' en ' + $('#especialidad_id :selected').text() + ' - ' + $('#reticula_id :selected').text() );
	$('#asignatura').val('');
	$('#codigo').val('');
	$('#creditos').val('');
	Materialize.updateTextFields();
	new_asignatura = true;
  validator.resetForm();
	$('#nueva_asignatura').modal('open');
});

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

var validator = $("#form_asignatura").validate({
	rules: {
    asignatura: {
        required: true
    },
    codigo: {
    	required: true
    },
    creditos: {
    	required: true,
    	digits: true,
    	min: 1
    }
	},
	messages: {
		asignatura:{
			required: "Ingresa el nombre de la asignatura"
    },
    codigo: {
     	required:  "Ingresa un código unico"
    },
    creditos:{
    	required:  "Ingresa el numero de creditos",
    	digits: "El credito debe tener un valor mayor a 1",
    	min: "El credito debe tener un valor mayor a 1"
    }
  },
  submitHandler: function(form) {
    if (new_asignatura) {
      json = {
        asignatura: $('#asignatura').val(),
        codigo: $('#codigo').val(),
        creditos: $('#creditos').val(),
        reticula_id: $('#reticula_id').val()
      }
      store_asignatura(json);
    }
  }
});

/*
$('#form_asignatura').submit(function(event) {
    event.preventDefault();
});*/

function store_asignatura(json){
	$.post('/admin/escolares/asignaturas',json,function(data){
		load_asignaturas();
		swal({
		  type: 'success',
		  title: 'La asignatura ha sido guardada',
		  showConfirmButton: false,
		  timer: 1500
		});
    $('#nueva_asignatura').modal('close');
	}).fail(function(data) {
    var errors = data.responseJSON.errors;
    var str_errors = '';
    for(var error in errors) {
      str_errors += ''+errors[error]+'<br>';
    }
		swal({
			type: 'error',
			title: 'Error al guardar la asignatura',
      html: str_errors
		});
	});
}