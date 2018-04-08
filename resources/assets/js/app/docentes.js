load_docentes();

function load_docentes(){
	var table = $('#table_docentes').DataTable({
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
    ajax: '/admin/datatable/docentes',
    columns: [
        { data: 'codigo',			    name: 'codigo' },
        { data: 'nombre',	        name: 'nombre' },
        { data: 'apaterno',       name: 'apaterno' },
        { data: 'amaterno',       name: 'amaterno' },
        { data: 'edad',           name: 'edad' },
        { data: 'telefono_casa',  name: 'telefono_casa' },
        { data: 'rfc',            name: 'rfc' },
        { data: 'titulo',		       name: 'titulo' },
        {
          data: 'docente_id',
          render: function ( data, type, row, meta ) {
            return `<a href="/admin/academicos/docentes/`+data+`/edit" class="btn-floating btn-meddium waves-effect waves-light"><i class="material-icons circle green">mode_edit</i></a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'docente_id',
          render: function ( data, type, row, meta ) {
            return `<a class="btn-floating btn-meddium waves-effect waves-light delete-docente"><i class="material-icons circle red">close</i></a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_docentes_length']").val('10');
  $("select[name$='table_docentes_length']").material_select();
  //edit_asignatura('#table_docentes tbody',table);
}