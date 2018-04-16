load_planes_especialidades();

var edit_plan_especialidad = false;
var plan_especialidad_id = null;

function load_planes_especialidades(){
	var table = $('#table_planes_especialidades').DataTable({
  	language: {
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
    ajax: '/admin/datatable/planes_especialidades/'+$('#especialidad_id').val(),
    columns: [
        { data: 'plan_especialidad',  name: 'plan_especialidad' },
        { data: 'periodos',	name: 'periodos' },
        { data: 'descripcion',  name: 'descripcion' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a class="btn-floating btn-meddium waves-effect waves-light edit-plan-especialidad"><i class="material-icons circle green">mode_edit</i></a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a class="btn-floating btn-meddium waves-effect waves-light delete-plan-especialidad"><i class="material-icons circle red">close</i></a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  action_plan_especialidad('#table_planes_especialidades tbody',table);
  $("select[name$='table_planes_especialidades_length']").val('10');
  $("select[name$='table_planes_especialidades_length']").material_select();
}


function action_plan_especialidad (tbody,table){
  $(tbody).on('click','a.edit-plan-especialidad',function(){
    var data = table.row( $(this).parents('tr') ).data();
    plan_especialidad_id = data.id;

    $("label[for='plan_especialidad']").attr('data-error','');
    $("label[for='periodos']").attr('data-error','');

    $('#plan_especialidad').removeClass('invalid');
    $('#periodos').removeClass('invalid');

    $('#plan_especialidad').val(data.plan_especialidad);
    $('#periodos').val(data.periodos);
    $('#descripcion').val(data.descripcion);

    Materialize.updateTextFields();
    edit_plan_especialidad = true;
    $('#cancel_plan_especialidad').removeClass('hide');
  });

  $(tbody).on('click','a.delete-plan-especialidad',function(){
    var data = table.row( $(this).parents('tr') ).data();
    plan_especialidad_id = data.id;
    delete_plan_especialidad();
  });
}

$('#cancel_plan_especialidad').on('click',function(){
    plan_especialidad_id = null;
    $('#plan_especialidad').val('');
    $('#periodos').val('1');
    $('#descripcion').val('');

    $("label[for='plan_especialidad']").attr('data-error','');
    $("label[for='periodos']").attr('data-error','');

    $('#plan_especialidad').removeClass('invalid');
    $('#periodos').removeClass('invalid');

    Materialize.updateTextFields();
    edit_plan_especialidad = false;
    $('#cancel_plan_especialidad').addClass('hide');
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

var validator = $("#form_plan_especialidad").validate({
  rules: {
    plan_especialidad: {
      required: true
    },
    periodos: {
      required: true,
      digits:true,
      min: 1
    },
    especialidad_id: {
      required: true,
      digits:true,
      min: 1
    }
  },
  messages: {
    plan_especialidad: {
      required: "El plan de estudio es requerido"
    },
    periodos: {
      required: "El número de periodos es requerido",
      digits:"El número de periodos tiene que ser un número entero",
      min: "El número de periodos tiene que ser mínimo 1"
    },
    especialidad_id: {
      required: "La especialidad es requerida",
      digits:"La especialidad tiene que ser un número entero",
      min: "La especialidad tiene que ser mínimo 1"
    }
  },
  submitHandler: function(form) {
    if (edit_plan_especialidad){
      json = {
        id: plan_especialidad_id,
        plan_especialidad: $('#plan_especialidad').val(),
        periodos: $('#periodos').val(),
        descripcion: $('#descripcion').val()
      }
      update_plan_especialidad(json);
    }else{
      json = {
        plan_especialidad: $('#plan_especialidad').val(),
        periodos: $('#periodos').val(),
        especialidad_id: $('#especialidad_id').val(),
        descripcion: $('#descripcion').val()
      }
      store_plan_especialidad(json);
    }
  }
});

function store_plan_especialidad(json){
  $.post('/admin/escolares/planes_especialidades',json,function(data){
    
    $('#plan_especialidad').val('');
    $('#periodos').val('1');
    $('#descripcion').val('');

    Materialize.updateTextFields();
    $('#table_planes_especialidades').DataTable().ajax.reload();
    swal({
      type: 'success',
      title: 'El plan de estudios ha sido guardado',
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

function update_plan_especialidad(json){
  $.ajax({
    url: '/admin/escolares/planes_especialidades/'+plan_especialidad_id,
    data: json,
    type: 'PUT',
    success: function(result) {
      plan_especialidad_id = null;
      
      $('#plan_especialidad').val('');
      $('#periodos').val('1');
      $('#descripcion').val('');

      Materialize.updateTextFields();
      edit_plan_especialidad = false;
      $('#cancel_plan_especialidad').addClass('hide');
      $('#table_planes_especialidades').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'El plan de estudios ha sido actualizado',
        showConfirmButton: false,
        timer: 1500
      });
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

function delete_plan_especialidad(){
  swal({
    title: 'Desea eliminar el plan de estudios?',
    text: "Esta acción no se puede revertir",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si',
    cancelButtonText: 'Cancelar',
  }).then((result) => {
    if (result.value) {
      destroy_plan_especialidad();    
    }
  });
}

function destroy_plan_especialidad(){
  $.ajax({
    url: '/admin/escolares/planes_especialidades/'+plan_especialidad_id,
    type: 'DELETE',
    success: function(result) {
      plan_especialidad_id = null;

      $("label[for='plan_especialidad']").attr('data-error','');
      $("label[for='periodos']").attr('data-error','');
      
      $('#plan_especialidad').removeClass('invalid');
      $('#periodos').removeClass('invalid');

      $('#plan_especialidad').val('');
      $('#periodos').val('1');
      $('#descripcion').val('');

      Materialize.updateTextFields();
      edit_plan_especialidad = false;
      $('#cancel_plan_especialidad').addClass('hide');
      $('#table_planes_especialidades').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'El plan de estudio ha sido eliminado',
        showConfirmButton: false,
        timer: 1500
      });
      plan_especialidad_id = null;
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar el plan de estudios',
        text: 'El plan de estudios tiene materias ya asignadas'
      });  
    }
  });
}