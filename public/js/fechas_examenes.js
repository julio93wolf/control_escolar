load_fechas_examenes();

var edit_fecha_examen = false;
var fecha_examen_id = null;

function load_fechas_examenes(){
	var table = $('#table_fechas_examenes').DataTable({
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
    ajax: '/admin/datatable/fechas_examenes/'+$('#periodo_id').val(),
    columns: [
        { data: 'tipo_examen',  name: 'tipo_examen' },
        { data: 'fecha_inicio',	name: 'fecha_inicio' },
        { data: 'fecha_final',	name: 'fecha_final' },
        { data: 'descripcion',  name: 'descripcion' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a class="btn-floating btn-meddium waves-effect waves-light edit-fecha-examen"><i class="material-icons circle green">mode_edit</i></a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a class="btn-floating btn-meddium waves-effect waves-light delete-fecha-examen"><i class="material-icons circle red">close</i></a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  action_fecha_examen('#table_fechas_examenes tbody',table);
  $("select[name$='table_fechas_examenes_length']").val('10');
  $("select[name$='table_fechas_examenes_length']").material_select();
}

function action_fecha_examen (tbody,table){
  $(tbody).on('click','a.edit-fecha-examen',function(){
    var data = table.row( $(this).parents('tr') ).data();
    fecha_examen_id = data.id;
    $('#tipo_examen_id').val(data.tipo_examen_id).material_select();
    var $input_fecha_inicio = $('#fecha_inicio').pickadate({
      formatSubmit: 'yyyy-mm-dd',
      selectMonths: true,
      selectYears: 30,
      today: 'Hoy',
      clear: 'Limpiar',
      close: 'Ok',
    });
    var picker_fecha_inicio = $input_fecha_inicio.pickadate('picker');
    picker_fecha_inicio.set('select',data.fecha_inicio, { format: 'yyyy-mm-dd' });
    var $input_fecha_final = $('#fecha_final').pickadate({
      formatSubmit: 'yyyy-mm-dd',
      selectMonths: true,
      selectYears: 30,
      today: 'Hoy',
      clear: 'Limpiar',
      close: 'Ok',
    });
    var picker_fecha_final = $input_fecha_final.pickadate('picker');
    picker_fecha_final.set('select',data.fecha_final, { format: 'yyyy-mm-dd' });
    $('#descripcion').val(data.descripcion);
    Materialize.updateTextFields();
    edit_fecha_examen = true;
    $('#cancel_fecha_examen').removeClass('hide');
  });

  $(tbody).on('click','a.delete-fecha-examen',function(){
    var data = table.row( $(this).parents('tr') ).data();
    fecha_examen_id = data.id;
    delete_fecha_examen();
  });
}

$('#cancel_fecha_examen').on('click',function(){
    fecha_examen_id = null;
    $('#tipo_examen_id').val(1).material_select();
    $('#fecha_inicio').val('');
    $('#fecha_final').val('');
    $('#descripcion').val('');
    Materialize.updateTextFields();
    edit_fecha_examen = false;
    $('#cancel_fecha_examen').addClass('hide');
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

var validator = $("#form_fecha_examen").validate({
  rules: {
    tipo_examen_id: {
      required: true
    },
    fecha_inicio: {
      required: true
    },
    fecha_final: {
      required: true
    },
    periodo_id: {
      required: true
    }
  },
  messages: {
    tipo_examen_id: {
      required: "El tipo de examen es requerido"
    },
    fecha_inicio: {
      required: "La fecha de inicio es requerido"
    },
    fecha_final: {
      required: "La fecha de termino es requerido"
    },
    periodo_id: {
      required: "El periodo es requerido"
    }
  },
  submitHandler: function(form) {
    if (edit_fecha_examen){
      json = {
        id: fecha_examen_id,
        tipo_examen_id: $('#tipo_examen_id').val(),
        fecha_inicio: $('#fecha_inicio').pickadate().pickadate('picker').get('select', 'yyyy-mm-dd'),
        fecha_final: $('#fecha_final').pickadate().pickadate('picker').get('select', 'yyyy-mm-dd'),
        descripcion: $('#descripcion').val()
      }
      update_fecha_examen(json);
    }else{
      json = {
        tipo_examen_id: $('#tipo_examen_id').val(),
        fecha_inicio: $('#fecha_inicio').pickadate().pickadate('picker').get('select', 'yyyy-mm-dd'),
        fecha_final: $('#fecha_final').pickadate().pickadate('picker').get('select', 'yyyy-mm-dd'),
        periodo_id: $('#periodo_id').val(),
        descripcion: $('#descripcion').val()
      }
      store_fecha_examen(json);
    }
  }
});

function store_fecha_examen(json){
  $.post('/admin/escolares/periodos/fechas_examenes',json,function(data){
    $('#tipo_examen_id').val(1).material_select();
    $('#fecha_inicio').val('');
    $('#fecha_final').val('');
    $('#descripcion').val('');
    Materialize.updateTextFields();
    $('#table_fechas_examenes').DataTable().ajax.reload();
    swal({
      type: 'success',
      title: 'El examen ha sido guardado',
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

function update_fecha_examen(json){
  $.ajax({
    url: '/admin/escolares/periodos/fechas_examenes/'+fecha_examen_id,
    data: json,
    type: 'PUT',
    success: function(result) {
      fecha_examen_id = null;
      $('#tipo_examen_id').val(1).material_select();
      $('#fecha_inicio').val('');
      $('#fecha_final').val('');
      $('#descripcion').val('');
      Materialize.updateTextFields();
      edit_fecha_examen = false;
      $('#cancel_fecha_examen').addClass('hide');
      $('#table_fechas_examenes').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'La asignatura ha sido actualizada',
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

function delete_fecha_examen(){
  swal({
    title: 'Desea eliminar el examen?',
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
        id: fecha_examen_id
      };
      destroy_fecha_examen(json);    
    }
  });
}

function destroy_fecha_examen(json){
  $.ajax({
    url: '/admin/escolares/periodos/fechas_examenes/'+fecha_examen_id,
    data: json,
    type: 'DELETE',
    success: function(result) {
      fecha_examen_id = null;
      $('#tipo_examen_id').val(1).material_select();
      $('#fecha_inicio').val('');
      $('#fecha_final').val('');
      $('#descripcion').val('');
      Materialize.updateTextFields();
      edit_fecha_examen = false;
      $('#cancel_fecha_examen').addClass('hide');
      $('#table_fechas_examenes').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'El examen ha sido eliminado',
        showConfirmButton: false,
        timer: 1500
      });
      fecha_examen_id = null;
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar el examen',
        text: 'El examen esta relacionado con uno o más datos'
      });  
    }
  });
}