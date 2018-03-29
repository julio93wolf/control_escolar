<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<link rel="icon" href="{{ asset('/') }}images/buo.png">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	 <!-- Compiled and minified CSS -->
  <link type="text/css" rel="stylesheet" href="{{ asset('/css/vendor.css') }}"  media="screen,projection"/>
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<header>
		@include('private.admin.layouts.menu')
	</header>

	<main>
		@yield('content')
	</main>
	<br>

	<!-- Parallax -->
	<div class="parallax-container valign-wrapper hide-on-small-only">
		<div class="section no-pad-bot">
			<div class="container">
			<div class="row center valign-wrapper" style="margin: auto;">
				<h5 class="header col s12 light shadow-text"><i>Yo soy UNICEBA</i></h5>
			</div>
			</div>
		</div>
		<div class="parallax"><img src="{{ asset('/') }}images/footer.jpg"></div>
	</div>

	<footer class="page-footer blue darken-2">
		@include('private.admin.layouts.footer')
	</footer>
	

	<!-- Compiled and minified JavaScript -->
	<script src="{{ asset('/js/vendor.js') }}"></script>
	<script type="text/javascript">
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


	    $('.fixed-action-btn').openFAB();
  		$('.fixed-action-btn').closeFAB();

  		$('.datepicker').pickadate({
				formatSubmit: 'yyyy/mm/dd',
				selectMonths: true,
				selectYears: 30,
				today: 'Today',
		    clear: 'Clear',
		    close: 'Ok',
			});
	  });
		
		/*
		$(".button-collapse").sideNav();
		$('.parallax').parallax();
		$('#dt').DataTable();
		$('select').material_select();
		$('.datepicker').pickadate({
			formatSubmit: 'yyyy/mm/dd',
			selectMonths: true, // Creates a dropdown to control month
			selectYears: 30// Creates a dropdown of 15 years to control year
		});
		var fakedata = ['test1','test2','test3','test4','ietsanders'];
		$("#autocomplete-input").autocomplete({source:fakedata});
		$(".dropdown-button").dropdown();
		$(".dropdown-button2").dropdown();
		$('.timepicker').pickatime({
			default: 'now', // Set default time
			fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
			twelvehour: false, // Use AM/PM or 24-hour format
			donetext: 'OK', // text for done-button
			cleartext: 'Clear', // text for clear-button
			canceltext: 'Cancel', // Text for cancel-button
			autoclose: false, // automatic close timepicker
			ampmclickable: true, // make AM PM clickable
			aftershow: function(){} //Function for after opening timepicker  
		});*/
	</script>
	@yield('script')
</body>
</html>