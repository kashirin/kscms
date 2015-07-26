$(function(){

	var sheader = '';
	var sfooter = '';


	$( "div.snippet" ).each(function(indx, elem){
		
			name = $(elem).attr('data-name');
			
			if(typeof snippets[name] != "undefined"){
				
				$(elem).empty();
				
				$(elem).html(sheader +  snippets[name]  + sfooter);
			}
		
	});

});