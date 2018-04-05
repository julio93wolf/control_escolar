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

var validator = $("#form_periodo").validate({
	rules: {
    anio: {
      required: true,
      digits: true,
      min: 1950
    },
    periodo: {
    	required: true
    },
    reconocimiento_oficial: {
    	required: true
    },
    dges: {
      required: true
    },
    fecha_reconocimiento: {
      required: true
    }
	},
	messages: {
		anio: {
      required: "El año es requerido",
      digits: "El año tiene que ser un número entero",
      min: "El año tiene que ser mínimo 1950"
    },
    periodo: {
      required: "El período es requerido"
    },
    reconocimiento_oficial: {
      required: "El reconocimiento oficial es requerido"
    },
    dges: {
      required: "El DGES es requerido"
    },
    fecha_reconocimiento: {
      required: "La fecha de reconocimiento es requerida"
    }
  }
});