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
		  return false;
		});
		$(".tabs a").click(function() {
			 var id = $(this).attr('data_id');
			 $('.tabs_body .tab_body').hide();
			 $('.tabs a').removeClass('active');
			 
			 $('.tabs .'+id).addClass('active');
			 $('.tabs_body .'+id+'_body').show();	
			 return false;
		});


		$('#contacts').jqm({modal: true, overlay:55, trigger: 'a.contacts_btn'});

		// placeholder for textarea

		$('textarea').on('focus', function(){

			if($(this).text() == 'сообщение'){
				$(this).text('');
			}

		});

});

$(window).load(function() {

		setTimeout(function(){

			if($('#left').height()>$('#right').height()){
				$('#right').height($('#left').height());	
			} else{
				$('#left').height($('#right').height());	
			}

		},10);

 		
 		
		
});