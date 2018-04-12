$('#asignatura_id').select2();
$('#docente_id').select2();
horario();
inputs_horarios();

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

function horario(){ 
	for (var i = 0; i < 6; i++) {
		$('#dia_'+i+'').on("click",function(event){
			if($(this).is(':checked')){
				var index = $(this).attr('index');
				$('#hora_inicio_'+index).prop("disabled", false);
				$('#hora_salida_'+index).prop("disabled", false);
			}else{
				var index = $(this).attr('index');
				$('#hora_inicio_'+index).val('');
				$('#hora_salida_'+index).val('');
				$('#hora_inicio_'+index).prop("disabled", true);
				$('#hora_salida_'+index).prop("disabled", true);
			}
		});
	}
}

function inputs_horarios(){ 
	for (var i = 0; i < 6; i++) {
		$('#hora_inicio_'+i+'').change(function(event){
			$(this).removeClass('invalid');
		});
		$('#hora_salida_'+i+'').change(function(event){
			$(this).removeClass('invalid');
		});
	}
}