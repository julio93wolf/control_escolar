load_periodos();

function load_periodos(){
	var table = $('#table_periodos').DataTable({
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
    ajax: '/admin/datatable/periodos',
    columns: [
        { data: 'periodo',			name: 'periodo' },
        { data: 'anio',	name: 'anio' },
        { data: 'reconocimiento_oficial',		name: 'reconocimiento_oficial' },
        { data: 'dges',   name: 'dges' },
        { data: 'fecha_reconocimiento',   name: 'fecha_reconocimiento' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a href="/admin/escolares/periodos/`+data+`/edit" class="btn-floating btn-meddium waves-effect waves-light"><i class="material-icons circle blue">school</i></a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a href="/admin/escolares/periodos/`+data+`/edit" class="btn-floating btn-meddium waves-effect waves-light"><i class="material-icons circle green">mode_edit</i></a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a data-method="delete" href="/admin/escolares/periodos/`+data+`" class="btn-floating btn-meddium waves-effect waves-light"><i class="material-icons circle red">close</i></a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_periodos_length']").val('10');
  $("select[name$='table_periodos_length']").material_select();
}