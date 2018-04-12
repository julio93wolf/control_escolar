$('#municipio_id').select2();
$('#localidad_id').select2();
load_especialidades();


function load_municipios (municipio_id,localidad_id){
	var estado_id = $('#estado_id').val();
	$.get('/admin/select/municipios/'+estado_id,function(data) {
		$('#municipio_id').empty();
		for(i = 0; i < data.length; i++){
      if(municipio_id != undefined){
        if(municipio_id == data[i].id ){
          $('#municipio_id').append('<option value="' + data[i].id + '" selected>'+ data[i].municipio+'</option>');
        }else{
          $('#municipio_id').append('<option value="' + data[i].id + '">'+ data[i].municipio+'</option>');
        }
      }else{
        $('#municipio_id').append('<option value="' + data[i].id + '">'+ data[i].municipio+'</option>');
      }
		}
		$('#municipio_id').select2();
		$('#municipio_id').material_select();
    load_localidades(localidad_id);
	})
	.fail(function() {
		swal("Error", "Ocurrio un error al cargar las especialidades.", "error");
	});
}

function load_localidades (localidad_id){
	var municipio_id = $('#municipio_id').val();
	$.get('/admin/select/localidades/'+municipio_id,function(data) {
		$('#localidad_id').empty();
		for(i = 0; i < data.length; i++){
      if (localidad_id != undefined) {
        if(localidad_id == data[i].id){
          $('#localidad_id').append('<option value="' + data[i].id + '" selected>'+ data[i].localidad+'</option>');
        }else{
          $('#localidad_id').append('<option value="' + data[i].id + '">'+ data[i].localidad+'</option>');
        }
      }else{
        $('#localidad_id').append('<option value="' + data[i].id + '">'+ data[i].localidad+'</option>');
      }
			
		}
		$('#localidad_id').select2();
		$('#localidad_id').material_select();
	})
	.fail(function() {
		swal("Error", "Ocurrio un error al cargar las especialidades.", "error");
	});
}

function load_especialidades (){
	var nivel_academico_id = $('#nivel_academico_id').val();
	$.get('/admin/select/especialidades_nivel/' + nivel_academico_id,function(data) {
		$('#especialidad_id').empty();
		for(i = 0; i < data.length; i++){
			$('#especialidad_id').append('<option value="' + data[i].id + '">' + data[i].especialidad + ' (' + data[i].clave +')</option>');
		}
		$('#especialidad_id').material_select();
		load_planes();
	})
	.fail(function() {
    $('#name_reticula').text('');
		$('#section_reticula').empty();
    swal("Error", "No existen especialidades", "error");

	});
}

function load_planes (){
  var especialidad_id = $('#especialidad_id').val();
  $.get('/admin/select/planes_especialidades/' + especialidad_id,function(data) {
    $('#plan_especialidad_id').empty();
    for(i = 0; i < data.length; i++){
      $('#plan_especialidad_id').append('<option value="' + data[i].id + '">' + data[i].plan_especialidad + '</option>');
    }
    $('#plan_especialidad_id').material_select();
  })
  .fail(function() {
    $('#name_reticula').text('');
    $('#section_reticula').empty();
    swal("Error", "No existen planes de estudio", "error");
  });
}

$('#nivel_academico_id').change(function(){
	load_especialidades();
});

$('#especialidad_id').change(function(){
	load_planes();
});

$('#estado_id').change(function(event){
	load_municipios();
});

$('#municipio_id').change(function(event){
	load_localidades();
});