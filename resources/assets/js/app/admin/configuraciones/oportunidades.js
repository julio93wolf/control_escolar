load_oportunidades();

var new_oportunidad = false;
var oportunidad_id = null;

function load_oportunidades(){
	var table = $('#table_oportunidades').DataTable({
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
    scrollX: true,
    ajax: '/admin/datatable/oportunidades',
    columns: [
        { data: 'oportunidad',  name: 'oportunidad' },
        { data: 'descripcion',	name: 'descripcion' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a class="btn-floating btn-meddium waves-effect waves-light edit-oportunidad"><i class="material-icons circle green">mode_edit</i></a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a class="btn-floating btn-meddium waves-effect waves-light delete-oportunidad"><i class="material-icons circle red">close</i></a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_oportunidades_length']").val('10');
  $("select[name$='table_oportunidades_length']").material_select();
  edit_oportunidad('#table_oportunidades tbody',table);
  delete_oportunidad('#table_oportunidades tbody',table);
}

$('#create_oportunidad').on('click',function(){
	$('#oportunidad').val('');
	$('#descripcion').val('');
  $("label[for='oportunidad']").attr('data-error','');
  $('#oportunidad').removeClass('invalid');
  Materialize.updateTextFields();
	new_oportunidad = true;
  oportunidad_id = null;
	$('#modal_oportunidad').modal('open');
});

function edit_oportunidad (tbody,table){
  $(tbody).on('click','a.edit-oportunidad',function(){
    var data = table.row( $(this).parents('tr') ).data();
    oportunidad_id = data.id;
    $("label[for='oportunidad']").attr('data-error','');
    $('#oportunidad').removeClass('invalid');
    $('#oportunidad').val(data.oportunidad);
    $('#descripcion').val(data.descripcion);
    $('#descripcion').trigger('autoresize');
    Materialize.updateTextFields();
    new_oportunidad = false;
    $('#modal_oportunidad').modal('open');
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

var validator = $("#form_oportunidad").validate({
	rules: {
    oportunidad: {
      required: true
    }
	},
	messages: {
		oportunidad:{
			required: "La oportunidad es requerida."
    }
  },
  submitHandler: function(form) {
    if (new_oportunidad) {
      json = {
        oportunidad: $('#oportunidad').val(),
        descripcion: $('#descripcion').val()
      }
      store_oportunidad(json);
    }else{
      json = {
        id: oportunidad_id,
        oportunidad: $('#oportunidad').val(),
        descripcion: $('#descripcion').val()
      }
      update_oportunidad(json);
    }
  }
});

function store_oportunidad(json){
	$.post('/admin/configuraciones/oportunidades',json,function(data){
		$('#table_oportunidades').DataTable().ajax.reload();
		swal({
		  type: 'success',
		  title: 'La oportunidad ha sido guardada',
		  showConfirmButton: false,
		  timer: 1500
		});
    $('#modal_oportunidad').modal('close');
	}).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
	});
}

function update_oportunidad(json){
  $.ajax({
    url: '/admin/configuraciones/oportunidades/'+oportunidad_id,
    data: json,
    type: 'PUT',
    success: function(result) {
      $('#table_oportunidades').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'La oportunidad ha sido actualizada',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal_oportunidad').modal('close');    
    },
    error: function (data) {
      var errors = data.responseJSON.errors;
      for(var error in errors) {
        $("label[for='"+error+"']").attr('data-error',errors[error]);
        $("#"+error+"").addClass('invalid');
      }
    }
  });
}

function delete_oportunidad (tbody,table){
  $(tbody).on('click','a.delete-oportunidad',function(){
    var data = table.row( $(this).parents('tr') ).data();
    swal({
      title: 'Desea eliminar la oportunidad?',
      text: "Esta acción no se puede revertir",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.value) {
        oportunidad_id= data.id;
        destroy_oportunidad(oportunidad_id);    
      }
    })
  });
}

function destroy_oportunidad(oportunidad_id){
  $.ajax({
    url: '/admin/configuraciones/oportunidades/'+oportunidad_id,
    type: 'DELETE',
    success: function(result) {
      $('#table_oportunidades').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'La oportunidad ha sido eliminada',
        showConfirmButton: false,
        timer: 1500
      });
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar',
        text: 'La oportunidad esta relacionada con uno o más datos.'
      });  
    }
  });
}