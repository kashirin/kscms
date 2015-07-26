$(function(){
	$("#left-menu").metisMenu();
    
    
    $('.item-settings').on('click',function(event){
    
    	event.preventDefault();
        var node_id = $(this).closest('li').attr('node-id');
        
		location.href = '/structure/update/'+node_id;
        
        return false;
        
    	
    });
    
    	
     
     $('#left-menu li a').on('click',function(event){
     	
    		$(this).find('.multilevel').toggleClass('fa-folder-o');
    		$(this).find('.multilevel').toggleClass('fa-folder-open-o');
            
        
        
    });
    
    $('#left-menu li a').on('dblclick',function(event){
     	
    		$(this).find('.multilevel').toggleClass('fa-folder-o');
    		$(this).find('.multilevel').toggleClass('fa-folder-open-o');
            
        
        
    });
    
    $(".sortable").sortable();
	
	// by default no specified url
	$('.field-structurerecord-url').hide();
	
	function is_page_or_articles(){
		var vl = $('#item-type').val();
		if(vl == 'page' || vl == 'articles'){
			return true;
		}else{
			return false;
		}
	}
	
	

   // item type change
   
   $('#structurerecord-is_dir label').on('click', function(){
   
		if( $(this).find('input').val() == 1 ){
		
			//hide all url settings for folder
			
			$('.field-structurerecord-url input').val('');
			
			$('.field-item-type').hide();
			
			$('.field-structurerecord-url').hide();
			
		}else{
		
			$('.field-item-type').show();
			
			if(is_page_or_articles()){
				$('.field-structurerecord-url').hide();
			}else{
				$('.field-structurerecord-url').show();
			}
		}
   
   });
   
   $('#item-type').on('change',function(){
   
		if(is_page_or_articles()){
			$('.field-structurerecord-url').hide();
		}else{
			$('.field-structurerecord-url').show();
		}
   
   });
   
   // delete link
   
   $('#predelete_button, #canceldelete_button').on('click',function(){
		$('#delete_link').toggleClass('hide');
		$('#predelete_button').toggleClass('hide');
		$('#canceldelete_button').toggleClass('hide');
   });

   //translit name or title to seourl
	function urlLit(w) {
		var v = 0;
		var tr='a b v g d e ["zh","j"] z i y k l m n o p r s t u f h c ch sh ["shh","shch"] ~ y ~ e yu ya ~ ["jo","e"]'.split(' ');
 		var ww=''; w=w.toLowerCase().replace(/ /g,'-');
		for(i=0; i<w.length; ++i) { 
			cc=w.charCodeAt(i); ch=(cc>=1072?tr[cc-1072]:w[i]); 
			if(ch.length<3) ww+=ch; else ww+=eval(ch)[v]; 
		}
 		return(ww.replace(/~/g,''));
	}



                $('.dashboard-tile').on('click',function(){
                    var link = $(this).find('a').attr('href');
                    location.href = link;
                })
                    
    
});