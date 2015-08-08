$(function(){
	
		var $carousel = $('#carousel').carousel({
			indicator: true,
			duration: 0.3
		});

		var car = setInterval(function() {
			$carousel.carousel('next');
		}, 4000);
		
		var setted = true;
		
		function oncl(){
			setted = false;
			clearInterval(car);
			$carousel.carousel('reset');
			$carousel.carousel('refresh');
			
			var cnt = $(this).attr('data-num');
			
			if(cnt>0){
				for(i=0;i<cnt;i++){
					$carousel.carousel('next');
				}
			}
			
		}
		
		$('.carousel_indicator span').on('click',oncl);
		
		
		setInterval(function() {
			if(!setted){
				setted = true;
				$('.carousel_indicator span').on('click',oncl);
			}
		}, 200);
		
	
	});