$(function() {
		
		$( "#coming_events" ).click(function() {
		  $("#coming_events_list").toggle();
		  if ($("#coming_events").hasClass("open")) {
			  $( "#coming_events" ).removeClass('open');
			  $( "#coming_events" ).addClass('close');
		  } else {
			  $( "#coming_events" ).removeClass('close');
			  $( "#coming_events" ).addClass('open');
		  }
		});
		$(".tabs a").click(function() {
			 var id = $(this).attr('data_id');
			 $('.tabs_body .tab_body').hide();
			 $('.tabs a').removeClass('active');
			 
			 $('.tabs .'+id).addClass('active');
			 $('.tabs_body .'+id+'_body').show();	
			 return false;
		});
});

$(window).load(function() {
 if($('#left').height()>$('#right').height()){
			$('#right').height($('#left').height());	
		} else{
			$('#left').height($('#right').height());	
		}
		
});