load_especialidades();

var new_especialidad = false;
var especialidad_id = null;

function load_especialidades(){
	var table = $('#table_especialidades').DataTable({
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
    ajax: '/admin/datatable/especialidades',
    columns: [
        { 
          data: 'clave',
          name: 'clave',
          render: function ( data, type, row, meta ) {
            var data =
              row.clave+`<br>`+
              `(`+row.fecha_reconocimiento+`)`;
            return data;
          }
        },
        { 
          data: 'especialidad',	
          name: 'especialidad',
          render: function ( data, type, row, meta ) {
            var data =
              row.especialidad+`<br>`+
              `(`+row.tipo_plan_especialidad+`,`+row.modalidad_especialidad+`)`;
            return data;
          }
        },
        { data: 'reconocimiento_oficial',
          name: 'reconocimiento_oficial',
          render: function ( data, type, row, meta ) {
            var data =
              `<strong>Reconocimiento Oficial: </strong>`+row.reconocimiento_oficial+`<br>`+
              `<strong>DGES: </strong>`+row.dges+``;
            return data;
          }
        },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a class="btn-floating btn-meddium waves-effect waves-light edit-especialidad"><i class="material-icons circle green">mode_edit</i></a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_especialidades_length']").val('10');
  $("select[name$='table_especialidades_length']").material_select();
  edit_especialidad('#table_especialidades tbody',table);
}

$('#create_especialidad').on('click',function(){
  $('#nivel_academico_id').val(1).material_select();
  $('#especialidad').val('');
  $('#clave').val('');
  $('#periodos').val('1');
  $('#descripcion').val('');
  $('#modalidad_id').val(1).material_select();
  $('#tipo_plan_especialidad_id').val(1).material_select();
  $('#reconocimiento_oficial').val('');
  $('#fecha_reconocimiento').val('');
  $('#dges').val('');

  $("label[for='nivel_academico_id']").attr('data-error','');
  $("label[for='especialidad']").attr('data-error','');
  $("label[for='clave']").attr('data-error','');
  $("label[for='periodos']").attr('data-error','');
  $("label[for='descripcion']").attr('data-error','');
  $("label[for='modalidad_id']").attr('data-error','');
  $("label[for='tipo_plan_especialidad_id']").attr('data-error','');
  $("label[for='reconocimiento_oficial']").attr('data-error','');
  $("label[for='fecha_reconocimiento']").attr('data-error','');
  $("label[for='dges']").attr('data-error','');
  
  $('#nivel_academico_id').removeClass('invalid');
  $('#especialidad').removeClass('invalid');
  $('#clave').removeClass('invalid');
  $('#periodos').removeClass('invalid');
  $('#descripcion').removeClass('invalid');
  $('#modalidad_id').removeClass('invalid');
  $('#tipo_plan_especialidad_id').removeClass('invalid');
  $('#reconocimiento_oficial').removeClass('invalid');
  $('#fecha_reconocimiento').removeClass('invalid');
  $('#dges').removeClass('invalid');

  Materialize.updateTextFields();

  new_especialidad = true;
  especialidad_id = null;
  $('#modal_especialidad').modal('open');
});

function edit_especialidad (tbody,table){
  $(tbody).on('click','a.edit-especialidad',function(){
    var data = table.row( $(this).parents('tr') ).data();
    especialidad_id = data.id;
    
    $("label[for='nivel_academico_id']").attr('data-error','');
    $("label[for='especialidad']").attr('data-error','');
    $("label[for='clave']").attr('data-error','');
    $("label[for='periodos']").attr('data-error','');
    $("label[for='descripcion']").attr('data-error','');
    $("label[for='modalidad_id']").attr('data-error','');
    $("label[for='tipo_plan_especialidad_id']").attr('data-error','');
    $("label[for='reconocimiento_oficial']").attr('data-error','');
    $("label[for='fecha_reconocimiento']").attr('data-error','');
    $("label[for='dges']").attr('data-error','');
    
    $('#nivel_academico_id').removeClass('invalid');
    $('#especialidad').removeClass('invalid');
    $('#clave').removeClass('invalid');
    $('#periodos').removeClass('invalid');
    $('#descripcion').removeClass('invalid');
    $('#modalidad_id').removeClass('invalid');
    $('#tipo_plan_especialidad_id').removeClass('invalid');
    $('#reconocimiento_oficial').removeClass('invalid');
    $('#fecha_reconocimiento').removeClass('invalid');
    $('#dges').removeClass('invalid');
    
    $('#nivel_academico_id').val(data.nivel_academico_id).material_select();
    $('#especialidad').val(data.especialidad);
    $('#clave').val(data.clave);
    $('#periodos').val(data.periodos);
    $('#descripcion').val(data.descripcion);
    $('#modalidad_id').val(data.modalidad_id).material_select();
    $('#tipo_plan_especialidad_id').val(data.tipo_plan_especialidad_id).material_select();
    $('#reconocimiento_oficial').val(data.reconocimiento_oficial);

    var input_fecha_reconocimiento = $('#fecha_reconocimiento').pickadate({
      formatSubmit: 'yyyy-mm-dd',
      selectMonths: true,
      selectYears: 30,
      today: 'Hoy',
      clear: 'Limpiar',
      close: 'Ok',
    });
    var picker_fecha_reconocimiento = input_fecha_reconocimiento.pickadate('picker');
    picker_fecha_reconocimiento.set('select',data.fecha_reconocimiento, { format: 'yyyy-mm-dd' });
    $('#dges').val(data.dges);
    Materialize.updateTextFields();
    new_especialidad = false;
    $('#modal_especialidad').modal('open');

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

var validator = $("#form_especialidad").validate({
  rules: {
    nivel_academico_id: {
      required: true,
      digits: true,
      min: 1
    },
    especialidad: {
      required: true
    },
    clave: {
      required: true
    },
    periodos: {
      required: true,
      digits: true,
      min: 1
    },
    modalidad_id: {
      required: true,
      digits: true,
      min: 1
    },
    tipo_plan_especialidad_id: {
      required: true,
      digits: true,
      min: 1
    },
    reconocimiento_oficial: {
      required: true
    },
    fecha_reconocimiento: {
      required: true
    },
    dges: {
      required: true
    }
  },
  messages: {
   nivel_academico_id: {
      required: "El nivel académico es requerido",
      digits: "El nivel académico tiene que ser un número entero",
      min: "El nivel académico tiene que ser mínimo 1"
    },
    especialidad: {
      required: "El nombre de la especialidad es requerido"
    },
    clave: {
      required: "La clave es requerida"
    },
    periodos: {
      required: "El número de periodos es requerido",
      digits: "El número de periodos tiene que ser un numero entero",
      min: "El número de periodos tiene que ser mínimo 1"
    },
    modalidad_id: {
      required: "La modalidad es requerida",
      digits: "La modalidad tiene que ser un número entero",
      min: "La modalidad tiene que ser mínimo 1"
    },
    tipo_plan_especialidad_id: {
      required: "El tipo de plan es requerido",
      digits: "Solo se aceptan números positivos",
      min: "El tipo de plan tiene que ser mínimo 1"
    },
    reconocimiento_oficial: {
      required: "El reconocimiento oficial es requerido"
    },
    fecha_reconocimiento: {
      required: "La fecha de reconocimiento es requerida"
    },
    dges: {
      required: "El DGES es requerido"
    }
  },
  submitHandler: function(form) {
    if (new_especialidad) {
      json = {
        nivel_academico_id: $('#nivel_academico_id').val(),
        especialidad: $('#especialidad').val(),
        clave: $('#clave').val(),
        periodos: $('#periodos').val(),
        descripcion: $('#descripcion').val(),
        modalidad_id: $('#modalidad_id').val(),
        tipo_plan_especialidad_id: $('#tipo_plan_especialidad_id').val(),
        reconocimiento_oficial: $('#reconocimiento_oficial').val(),
        fecha_reconocimiento: $('#fecha_reconocimiento').pickadate().pickadate('picker').get('select', 'yyyy-mm-dd'),
        dges: $('#dges').val()
      }
      store_especialidad(json);
    }else{
      json = {
        id: especialidad_id,
        nivel_academico_id: $('#nivel_academico_id').val(),
        especialidad: $('#especialidad').val(),
        clave: $('#clave').val(),
        periodos: $('#periodos').val(),
        descripcion: $('#descripcion').val(),
        modalidad_id: $('#modalidad_id').val(),
        tipo_plan_especialidad_id: $('#tipo_plan_especialidad_id').val(),
        reconocimiento_oficial: $('#reconocimiento_oficial').val(),
        fecha_reconocimiento: $('#fecha_reconocimiento').pickadate().pickadate('picker').get('select', 'yyyy-mm-dd'),
        dges: $('#dges').val()
      }
      update_especialidad(json);
    }
  }
});

function store_especialidad(json){
  $.post('/admin/escolares/especialidades',json,function(data){
    $('#table_especialidades').DataTable().ajax.reload();
    swal({
      type: 'success',
      title: 'La especialidad ha sido guardada',
      showConfirmButton: false,
      timer: 1500
    });
    $('#modal_especialidad').modal('close');
  }).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
  });
}

function update_especialidad(json){
  $.ajax({
    url: '/admin/escolares/especialidades/'+especialidad_id,
    data: json,
    type: 'PUT',
    success: function(result) {
      $('#table_especialidades').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'La especialidad ha sido actualizada',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal_especialidad').modal('close');    
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