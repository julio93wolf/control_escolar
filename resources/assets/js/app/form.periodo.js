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
      required: "Ingresa un año",
      digits: "Solo se pueden ingresar números",
      min: "El año minimo es 1950"
    },
    periodo: {
      required: "Ingresa un periodo"
    },
    reconocimiento_oficial: {
      required: "Ingresa su reconocimiento oficial"
    },
    dges: {
      required: "Ingresa su DGES"
    },
    fecha_reconocimiento: {
      required: "Ingresa una fecha de reconocimiento"
    }
  }
});