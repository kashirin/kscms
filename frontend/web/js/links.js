
$(function(){

	$( "span[data-url]" ).addClass('span_link');
	var url = '';
	var tx = '';
	
	$( "span[data-url]" ).each(function(indx, elem){
		
		url = $(elem).attr('data-url');
		
		tx = $(elem).html();
		
		$(elem).empty();
		
		$(elem).html('<a href="'+url+'" target="_blank">'+tx+'</a>');
		
	});
    
    
	///////////////////////////////////////////////////////


	var share_buttons = '<span id="ya_share1"></span>';

	
	
	new Ya.share({
        element: 'ya_share1',
            elementStyle: {
                'type': 'button',
                'border': false,
                'quickServices': ['vkontakte','odnoklassniki','moimir','twitter', 'facebook', 'gplus']
            },
        
		theme: 'counter',
		
		onshare: function(){
				console.log('shared');
				$( 'div.'+div_name ).fadeTo( 200 , 0.3, function() {
					//wait 5 sec and show link
					setTimeout(function(){
						
						show_link();
						
					},5000);
				});
	
	}
            
            
	});
	
	var div_name = 'emailform';


	function show_link(){

		// получим линк на скачивание

		var link = '/dl/'+$('div.'+div_name).attr('data-file');



		$('div.'+div_name).html(form_success);

		$('#link_to_download').attr('href',link);
		
		$( 'div.'+div_name ).fadeTo( 200 , 1, function() {
			//animation complete
		});
	}

	

	var form_html = '<div class="subscribe-pitch">';
        form_html +='<p class="medium">Для скачивания файла нажмите на одну из социальных кнопок!</p>';
    	
        form_html += '<p><div class="soc_button">'+share_buttons+'</div></p>';

        form_html +='<p class="big">или</p>';

        form_html +='<p class="medium">нажмите Скачать и подождите 90 секунд</p>';

        form_html +='<p class="medium" id="dl-wrapper"><a href="#" class="dl-button">Скачать</a></p>';

        //form_html += '<p class="small">РџРѕРґРїРёСЃРєР° РЅР° РїРѕР»СѓС‡РµРЅРёРµ РЅРѕРІС‹С… РјР°С‚РµСЂРёР°Р»РѕРІ СЃР°Р№С‚Р° ratingsforex.ru.<br>Р’С‹ РІ Р»СЋР±РѕР№ РјРѕРјРµРЅС‚ РјРѕР¶РµС‚Рµ РѕС‚РїРёСЃР°С‚СЊСЃСЏ РѕС‚ СЂР°СЃСЃС‹Р»РєРё.</p>';
        form_html +='</div>';
	
	var form_success = '<div class="subscribe-pitch">';
		form_success +='<p class="big">Спасибо за проявленный интерес!</p>';
		form_success +='<p class="medium">Ссылка для скачивания файла: <a gref="#" id="link_to_download">скачать</a></p>';
		//form_success +='<br><br><br><br><p class="small">РџРѕРґРїРёСЃРєР° РЅР° РїРѕР»СѓС‡РµРЅРёРµ РЅРѕРІС‹С… РјР°С‚РµСЂРёР°Р»РѕРІ СЃР°Р№С‚Р° ratingsforex.ru.<br>Р’С‹ РІ Р»СЋР±РѕР№ РјРѕРјРµРЅС‚ РјРѕР¶РµС‚Рµ РѕС‚РїРёСЃР°С‚СЊСЃСЏ РѕС‚ СЂР°СЃСЃС‹Р»РєРё.</p>';
		form_success += '</div>';
    
    $('div.'+div_name).html(form_html);


    $('a.dl-button').on('click',function(){
		
    	function minusSec(){
    		if(i>0){
    			setTimeout(function(){
    				i = i-1;
    				$('#dl-wrapper').html('<span>'+i+'с</span>');
    				minusSec();
    			},1000);
    		}else{
    			show_link();
    		}
    	}

    	var i = 90;

    	minusSec();


		return false;
	});
    
})
