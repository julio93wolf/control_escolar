load_asignaturas();

var new_asignatura = false;
var asignatura_id = null;

function load_asignaturas(){
	var table = $('#table_asignaturas').DataTable({
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
    ajax: '/admin/datatable/asignaturas',
    columns: [
        { data: 'codigo',			name: 'codigo' },
        { data: 'asignatura',	name: 'asignatura' },
        { data: 'creditos',		name: 'creditos' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a class="btn-floating btn-meddium waves-effect waves-light edit-asignatura"><i class="material-icons circle green">mode_edit</i></a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_asignaturas_length']").val('10');
  $("select[name$='table_asignaturas_length']").material_select();
  edit_asignatura('#table_asignaturas tbody',table);
}

$('#btn_nueva_asignatura').on('click',function(){
	$('#asignatura').val('');
	$('#codigo').val('');
	$('#creditos').val('');
	Materialize.updateTextFields();
	new_asignatura = true;
  asignatura_id = null;
	$('#nueva_asignatura').modal('open');
});

function edit_asignatura (tbody,table){
  $(tbody).on('click','a.edit-asignatura',function(){
    var data = table.row( $(this).parents('tr') ).data();
    console.log(data);
    asignatura_id = data.id;
    $('#asignatura').val(data.asignatura);
    $('#codigo').val(data.codigo);
    $('#creditos').val(data.creditos);
    Materialize.updateTextFields();
    new_asignatura = false;
    $('#nueva_asignatura').modal('open');
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
        creditos: $('#creditos').val()
      }
      store_asignatura(json);
    }else{
      json = {
        id: asignatura_id,
        asignatura: $('#asignatura').val(),
        codigo: $('#codigo').val(),
        creditos: $('#creditos').val()
      }
      update_asignatura(json);
    }
  }
});

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
    //var str_errors = '';
    for(var error in errors) {
      //str_errors += ''+errors[error]+'<br>';
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
		/*swal({
			type: 'error',
			title: 'Error al guardar la asignatura',
      html: str_errors
		});*/
	});
}

function update_asignatura(json){
  $.ajax({
    url: '/admin/escolares/asignaturas/'+asignatura_id,
    data: json,
    type: 'PUT',
    success: function(result) {
      load_asignaturas();
      swal({
        type: 'success',
        title: 'La asignatura ha sido actualizada',
        showConfirmButton: false,
        timer: 1500
      });
      $('#nueva_asignatura').modal('close');    
    },
    error: function (data) {
      var errors = data.responseJSON.errors;
      //var str_errors = '';
      for(var error in errors) {
        //str_errors += ''+errors[error]+'<br>';
        $("label[for='"+error+"']").attr('data-error',errors[error]);
        $("#"+error+"").addClass('invalid');
      }
      /*swal({
        type: 'error',
        title: 'Error al guardar la asignatura',
        html: str_errors
      });  */
    }
  });
}