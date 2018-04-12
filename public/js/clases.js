load_especialidades();

function load_especialidades (){
	var nivel_academico_id = $('#nivel_academico_id').val();
	$.get('/admin/select/especialidades_nivel/' + nivel_academico_id,function(data) {
		$('#especialidad_id').empty();
		for(i = 0; i < data.length; i++){
      if(i==0){
        $('#especialidad_id').append('<option value="' + data[i].id + '" selected>' + data[i].especialidad + ' (' + data[i].clave +')</option>');
      }else{
        $('#especialidad_id').append('<option value="' + data[i].id + '">' + data[i].especialidad + ' (' + data[i].clave +')</option>');  
      }
			
		}
		$('#especialidad_id').material_select();
		load_clases();
    create_clase();
	})
	.fail(function() {
    swal("Error", "No existen especialidades", "error");

	});
}

$('#nivel_academico_id').change(function(){
  load_especialidades();
  create_clase();
});

$('#especialidad_id').change(function(){
  load_clases();
  create_clase();
});

$('#periodo_id').change(function(){
  load_clases();
  create_clase();
});

function load_clases(){
  var table = $('#table_clases').DataTable({
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
    ajax: '/admin/datatable/clases?periodo_id='+$('#periodo_id').val()+'&especialidad_id='+$('#especialidad_id').val(),
    columns: [
        { data: 'codigo',      name: 'codigo' },
        { data: 'clase', name: 'clase' },
        { data: 'asignatura',   name: 'asignatura' },
        { data: 'docente',   name: 'docente' },
        {
          data: 'clase_id',
          render: function ( data, type, row, meta ) {
            return `<a href="/admin/academicos/grupos?plan_especialidad_id=`+data+`" class="btn-floating btn-meddium waves-effect waves-light"><i class="material-icons circle teal">group</i></a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'clase_id',
          render: function ( data, type, row, meta ) {
            return `<a href="/admin/academicos/clases/`+data+`/edit" class="btn-floating btn-meddium waves-effect waves-light"><i class="material-icons circle green">mode_edit</i></a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'clase_id',
          render: function ( data, type, row, meta ) {
            return `<a class="btn-floating btn-meddium waves-effect waves-light delete-clase"><i class="material-icons circle red">close</i></a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  delete_clase('#table_clases tbody',table);
  $("select[name$='table_clases_length']").val('10');
  $("select[name$='table_clases_length']").material_select();
}

function delete_clase (tbody,table){
  $(tbody).on('click','a.delete-clase',function(){
    var data = table.row( $(this).parents('tr') ).data();
    swal({
      title: 'Desea eliminar la clase?',
      text: "Esta acción no se puede revertir",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.value) {
        clase_id= data.clase_id;
        destroy_clase(clase_id);    
      }
    })
  });
}

function destroy_clase(clase_id){
  $.ajax({
    url: '/admin/academicos/clases/'+clase_id,
    type: 'DELETE',
    success: function(result) {
      load_clases();
      swal({
        type: 'success',
        title: 'La clase ha sido eliminada',
        showConfirmButton: false,
        timer: 1500
      });
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar la clase',
        text: 'La clase esta relacionado con uno o más datos.'
      });  
    }
  });
}

function create_clase(){
  $('#create_clase').attr('href','/admin/academicos/clases/create?periodo_id='+$('#periodo_id').val()+'&especialidad_id='+$('#especialidad_id').val());
}