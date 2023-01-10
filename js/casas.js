$(document).ready(function(){
	load(1);
});

function load(page){
	var casa= $("#casa").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/casas.php?action=ajax&page='+page+'&casa='+casa,
		beforeSend: function(objeto){
			$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})
}
