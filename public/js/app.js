$.ajaxSetup({
	headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$(document).ready(function(){
	
	$('.dropdown-button').dropdown({
    inDuration: 300,
    outDuration: 225,
    constrainWidth: false, // Does not change width of dropdown to that of the activator
    gutter: 0, // Spacing from edge
    belowOrigin: true, // Displays dropdown below the button
    alignment: 'right', // Displays dropdown with edge aligned to the left of button
    stopPropagation: false // Stops event propagation
  });

  $('.tooltipped').tooltip({delay: 50});
  $(".button-collapse").sideNav();
  $('.collapsible').collapsible();
  $('.parallax').parallax();
  $('select').material_select();


  $('.fixed-action-btn').openFAB();
	$('.fixed-action-btn').closeFAB();

	$('.datepicker').pickadate({
		formatSubmit: 'yyyy-mm-dd',
		selectMonths: true,
		selectYears: 30,
		today: 'Hoy',
    clear: 'Limpiar',
    close: 'Ok',
	});

	$('.modal').modal();

  $('ul.tabs').tabs('select_tab', 'tab_id', {swipeable: true});

  $('.js-example-basic-single').select2();
});