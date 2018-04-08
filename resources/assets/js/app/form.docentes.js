$('#municipio_id').select2();
$('#localidad_id').select2();


function load_municipios (){
	var estado_id = $('#estado_id').val();
	$.get('/admin/select/municipios/'+estado_id,function(data) {
		$('#municipio_id').empty();
		for(i = 0; i < data.length; i++){
			$('#municipio_id').append('<option value="' + data[i].id + '">'+ data[i].municipio+'</option>');
		}
		$('#municipio_id').select2();
		$('#municipio_id').material_select();
		load_localidades ();
	})
	.fail(function() {
		swal("Error", "Ocurrio un error al cargar las especialidades.", "error");
	});
}

function load_localidades (){
	var municipio_id = $('#municipio_id').val();
	$.get('/admin/select/localidades/'+municipio_id,function(data) {
		$('#localidad_id').empty();
		for(i = 0; i < data.length; i++){
			$('#localidad_id').append('<option value="' + data[i].id + '">'+ data[i].localidad+'</option>');
		}
		$('#localidad_id').select2();
		$('#localidad_id').material_select();
	})
	.fail(function() {
		swal("Error", "Ocurrio un error al cargar las especialidades.", "error");
	});
}

$('#estado_id').change(function(){
	load_municipios();
});

$('#municipio_id').change(function(){
	load_localidades();
});