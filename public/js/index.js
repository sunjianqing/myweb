/**
 * 
 */

function load_role_div(id){
	var current_role_div = id+"_div";
	$(".role_div").hide();
	//console.log(current_role_div);
	$("#"+current_role_div).show();
}

$(document).ready(function(){
	
	//toggle role box
	$("input[name='people']").change(function(){
		load_role_div(this.id);
	});
	
	$('#request_ride').click(function(){
		$.ajax({
			  url: 'ride/request',
			  data:{
				  passenger_from_addr:$('#passenger_from_addr').val(),
				  passenger_to_addr:$('#passenger_to_addr').val(),
				  passenger_start_date:$('#passenger_start_date').val(),
				  passenger_end_date:$('#passenger_end_date').val(),
				  passenger_price:$('#passenger_price').val(),
				  passenger_people_num:$('#passenger_people_num').val()
				  },
			  success: function(data) {
				  $("#main_edit_div").hide();
				  $("#submit_div").show();
			  }
			});
	});
	
	$('#post_ride').click(function(){
		$.ajax({
			  url: 'ride/post',
			  data:{
				  driver_from_addr:$('#driver_from_addr').val(),
				  driver_to_addr:$('#driver_to_addr').val(),
				  driver_start_date:$('#driver_start_date').val(),
				  driver_end_date:$('#driver_end_date').val(),
				  driver_price:$('#driver_price').val(),
				  driver_seat_num:$('#driver_seat_num').val()
				  },
				  success: function(data) {
					  $("#main_edit_div").hide();
					  $("#submit_div").show();
				  }
			});
	});
	
	 $('input[title]').inputHints();

});
