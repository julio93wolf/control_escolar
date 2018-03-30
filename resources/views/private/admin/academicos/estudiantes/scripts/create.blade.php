<script type="text/javascript">
	$('select').material_select();

	new Vue({
		el: '#form_estudiante',
		mounted: function(){
			$('select').material_select();
		},
		data: {
			estado_id: '',
			estados: []
			municipios: [],
			errors: [],
		}
	});
</script>
