$('#municipio_id').select2();
$('#localidad_id').select2();
$('#instituto_id').select2();
$('#empresa_id').select2();
$('#instituto_municipio_id').select2();
documentos();

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

var dropify = $('.dropify').dropify({
  messages: {
      'default': 'Arrastra y suelta una imagen aquí o haz clic',
      'replace': 'Arrastra y suelta o haz clic para reemplazar',
      'remove':  'Quitar',
      'error':   'Oops, algo malo pasó.'
  },
  error: {
      'fileSize': 'El tamaño del archivo es demasiado grande ({{ value }} max).',
      'minWidth': 'El ancho de la imagen es demasiado pequeño ({{ value }}}px min).',
      'maxWidth': 'El ancho de la imagen es demasiado grande ({{ value }}}px max).',
      'minHeight': 'La altura de la imagen es demasiado pequeña ({{ value }}}px min).',
      'maxHeight': 'La altura de la imagen es muy grande ({{ value }}px max).',
      'imageFormat': 'El formato de imagen no está permitido ({{ value }} unicamente).'
  },
  tpl: {
      wrap:            '<div class="dropify-wrapper"></div>',
      loader:          '<div class="dropify-loader"></div>',
      message:         '<div class="dropify-message"><span class="file-icon" /> <p style="text-align: center;">{{ default }}</p></div>',
      preview:         '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
      filename:        '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
      clearButton:     '<button type="button" class="dropify-clear">{{ remove }}</button>',
      errorLine:       '<p class="dropify-error">{{ error }}</p>',
      errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
  }
});

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

function load_especialidades (especialidad_id,plan_especialidad_id){
	var nivel_academico_id = $('#nivel_academico_id').val();
	$.get('/admin/select/especialidades_nivel/' + nivel_academico_id,function(data) {
		$('#especialidad_id').empty();
		for(i = 0; i < data.length; i++){
      if (especialidad_id != undefined) {
        if (especialidad_id == data[i].id) {
          $('#especialidad_id').append('<option value="' + data[i].id + '" selected>' + data[i].especialidad + ' (' + data[i].clave +')</option>');
        }else{
          $('#especialidad_id').append('<option value="' + data[i].id + '">' + data[i].especialidad + ' (' + data[i].clave +')</option>');
        }
      }else{
        $('#especialidad_id').append('<option value="' + data[i].id + '">' + data[i].especialidad + ' (' + data[i].clave +')</option>');
      }
    }
		$('#especialidad_id').material_select();
		load_planes(plan_especialidad_id);
	})
	.fail(function() {
    $('#name_reticula').text('');
		$('#section_reticula').empty();
    swal("Error", "No existen especialidades", "error");

	});
}

function load_planes (plan_especialidad_id){
  var especialidad_id = $('#especialidad_id').val();
  $.get('/admin/select/planes_especialidades/' + especialidad_id,function(data) {
    $('#plan_especialidad_id').empty();
    for(i = 0; i < data.length; i++){
      if (plan_especialidad_id != undefined) {
        if (plan_especialidad_id == data[i].id) {
          $('#plan_especialidad_id').append('<option value="' + data[i].id + '" selected>' + data[i].plan_especialidad + '</option>');
        }else{
          $('#plan_especialidad_id').append('<option value="' + data[i].id + '">' + data[i].plan_especialidad + '</option>');
        }
      }else{
        if(i+1<data.length){
          $('#plan_especialidad_id').append('<option value="' + data[i].id + '">' + data[i].plan_especialidad + '</option>');
        }else{
          $('#plan_especialidad_id').append('<option value="' + data[i].id + '" selected>' + data[i].plan_especialidad + '</option>');
        }     
      }
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

function documentos(){ 
	var no_documentos = $('#documentos').attr('no_documentos');
	for (var i = 0; i < no_documentos; i++) {
		$('#tipo_documento_'+i+'').on("click",function(event){
			if($(this).is(':checked')){
				var index = $(this).attr('index');
				
				$('#documento_'+index).removeAttr("disabled");
				var wrapper = $('#documento_'+index).parents('.dropify-wrapper');
				wrapper.removeClass("disabled");
				
			}else{
				var index = $(this).attr('index');
				
				$('#documento_'+index).attr("disabled","disabled");
				var wrapper = $('#documento_'+index).parents('.dropify-wrapper');
				wrapper.addClass("disabled");
				
				var drEvent = $('#documento_'+index).dropify();
				drEvent = drEvent.data ('dropify'); 
				drEvent.resetPreview (); 
				drEvent.clearElement ();
				
			}
		});
	}
}



var validator = $("#form_estudiante").validate({
	rules: {
		//Datos Generales
    nombre: {
      required: true
    },
    apaterno: {
      required: true
    },
    amaterno: {
      required: true
    },
    curp: {
      required: true
    },
    fecha_nacimiento: {
      required: true
    },
    estado_civil_id: {
      required: true,
      digits: true,
      min: 1
    },
    sexo: {
      required: true,
      range: ['F','M','O']
    },
    nacionalidad_id: {
      required: true,
      digits: true,
      min: 1
    },
    calle_numero: {
      required: true
    },
    colonia: {
      required: true
    },
    codigo_postal: {
      required: true,
      digits: true
    },
    localidad_id: {
      required: true,
      digits: true,
      min: 1
    },
    //Especificos
    especialidad_id: {
      required: true,
      digits: true,
      min: 1
    },
    plan_especialidad_id: {
      required: true,
      digits: true,
      min: 1
    },
    matricula: {
      required: true
    },
    grupo: {
      required: true
    },
    estado_estudiante_id: {
      required: true,
      digits: true,
      min: 1
    },
    modalidad_id: {
      required: true,
      digits: true,
      min: 1
    },
    //Referencias
    medio_enterado_id: {
      required: true,
      digits: true,
      min: 1
    },
    instituto_id: {
      required: true,
      digits: true,
      min: 1
    },
    empresa_id: {
      required: true,
      digits: true,
      min: 1
    }
	},
	messages: {
		nombre: {
      required: "El nombre es requerido."
    },
    apaterno: {
      required: "El apellido paterno es requerido."
    },
    amaterno: {
      required: "El apellido materno es requerido."
    },
    curp: {
      required: "El CURP es requerido."
    },
    fecha_nacimiento: {
      required: "La fecha de nacimiento es requerido."
    },
    estado_civil_id: {
      required: "El estado civil es requerido.",
      digits: "El estado civil tiene que ser un número entero.",
      min: "El estado civil mínimo es 1."
    },
    sexo: {
      required: "El sexo es requerido.",
      range: "Los valores solo pueden ser ['F','M','O']."
    },
    nacionalidad_id: {
      required: "La nacionalidad es requerida.",
      digits: "La nacionalidad tiene que ser un número entero.",
      min: "La nacionalidad mínimo es 1."
    },
    calle_numero: {
      required: "La calle y número es requerida."
    },
    colonia: {
      required: "La colonia es requerida."
    },
    codigo_postal: {
      required: "El código postal es requerido.",
      digits: "El código postal tiene que ser un número."
    },
    localidad_id: {
      required: "La localidad es requerida.",
      digits: "La localidad tiene que ser un número entero.",
      min: "La localidad minima es 1."
    },
    //Especificos
    especialidad_id: {
      required: "La especialidad es requerida.",
      digits: "La especialidad tiene que ser un número entero.",
      min: "La especialidad minima es 1."
    },
    plan_especialidad_id: {
      required: "El plan de estudio es requerido.",
      digits: "El plan de estudio tiene que ser un número entero.",
      min: "El plan de estudio minimo es 1."
    },
    matricula: {
      required: "La matrícula es requerida."
    },
    grupo: {
      required: "El grupo es requerido."
    },
    estado_estudiante_id: {
      required: "El estado del estudiante es requerido.",
      digits: "El estado del estudiante tiene que ser un número entero.",
      min: "El estado del estudiante minimo es 1."
    },
    modalidad_id: {
      required: "La modalidad es requerida.",
      digits: "La modalidad tiene que ser un número entero.",
      min: "La modalidad minima es 1."
    },
    //Referencias
    medio_enterado_id: {
      required: "El medio de enterado es requerido.",
      digits: "El medio de enterado tiene que ser un número entero.",
      min: "El medio de enterado minimo es 1."
    },
    instituto_id: {
      required: "El instituto de procedencia es requerido.",
      digits: "El instituto de procedencia tiene que ser un número entero.",
      min: "El instituto de procedencia minimo es 1."
    },
    empresa_id: {
      required: "La empresa es requerida.",
      digits: "La empresa tiene que ser un número entero.",
      min: "La empresa minima es 1."
    }
  }
});


function load_instituto_municipios (municipio_id){
  var estado_id = $('#instituto_estado_id').val();
  $.get('/admin/select/municipios/'+estado_id,function(data) {
    $('#instituto_municipio_id').empty();
    for(i = 0; i < data.length; i++){
      if(municipio_id != undefined){
        if(municipio_id == data[i].id ){
          $('#instituto_municipio_id').append('<option value="' + data[i].id + '" selected>'+ data[i].municipio+'</option>');
        }else{
          $('#instituto_municipio_id').append('<option value="' + data[i].id + '">'+ data[i].municipio+'</option>');
        }
      }else{
        $('#instituto_municipio_id').append('<option value="' + data[i].id + '">'+ data[i].municipio+'</option>');
      }
    }
    $('#instituto_municipio_id').select2();
    $('#instituto_municipio_id').material_select();
  })
  .fail(function() {
    swal("Error", "Ocurrio un error al cargar los municipios.", "error");
  });
}

$('#instituto_estado_id').change(function(event){
  load_instituto_municipios();
})

$('#create_empresa').on('click',function(event){
  $('#empresa').val('');
  $("label[for='empresa']").attr('data-error','');
  $('#empresa').removeClass('invalid');
  Materialize.updateTextFields();
  $('#modal_empresa').modal('open');
});

$('#create_instituto').on('click',function(event){
  
  $('#instituto').val('');
  $('#instituto_estado_id').val(11).material_select();

  $("label[for='instituto']").attr('data-error','');
  $("label[for='instituto_municipio_id']").attr('data-error','');

  $('#instituto').removeClass('invalid');
  $('#instituto_municipio_id').removeClass('invalid');

  Materialize.updateTextFields();
  load_instituto_municipios(327);
  $('#modal_instituto').modal('open');
});

var validator_empresa = $("#form_empresa").validate({
  rules: {
    empresa: {
      required: true
    }
  },
  messages: {
    empresa: {
      required: "La empresa es requerida."
    }
  },
  submitHandler: function(form) {
    json = {
      empresa: $('#empresa').val()
    }
    store_empresa(json);
  }
});

var validator_instituto = $("#form_instituto").validate({
  rules: {
    instituto: {
      required: true
    },
    instituto_municipio_id: {
      required: true,
      digits: true,
      min: 1
    }
  },
  messages: {
    instituto: {
      required: "El instituto es requerido."
    },
    instituto_municipio_id: {
      required: "El municipio es requerido.",
      digits: "El municipio tiene que ser un número entero.",
      min: "El municipio minimo es 1."
    }
  },
  submitHandler: function(form) {
    json = {
      instituto: $('#instituto').val(),
      instituto_municipio_id: $('#instituto_municipio_id').val()
    }
    store_instituto(json);
  }
});

function store_empresa(json){
  $.post('/admin/academicos/empresas',json,function(data){    
    $('#empresa_id').empty();
    for(i = 0; i < data.length; i++){
      if(i+1==data.length){
        $('#empresa_id').append('<option value="' + data[i].id + '" selected>'+ data[i].empresa+'</option>');
      }else{
        $('#empresa_id').append('<option value="' + data[i].id + '">'+ data[i].empresa+'</option>');
      }
    }
    $('#empresa_id').select2();
    $('#empresa_id').material_select();
    swal({
      type: 'success',
      title: 'La especialidad ha sido guardada',
      showConfirmButton: false,
      timer: 1500
    });
    $('#modal_empresa').modal('close');
  }).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
  });
}

function store_instituto(json){
  $.post('/admin/academicos/institutos_procedencias',json,function(data){    
    $('#instituto_id').empty();
    for(i = 0; i < data.length; i++){
      if(i+1==data.length){
        $('#instituto_id').append('<option value="' + data[i].id + '" selected>'+ data[i].institucion+'</option>');
      }else{
        $('#instituto_id').append('<option value="' + data[i].id + '">'+ data[i].institucion+'</option>');
      }
    }
    $('#instituto_id').select2();
    $('#instituto_id').material_select();
    swal({
      type: 'success',
      title: 'La especialidad ha sido guardada',
      showConfirmButton: false,
      timer: 1500
    });
    $('#modal_instituto').modal('close');
  }).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
  });
}