
<script>
	$(function(){
		var pname = window.location.pathname;
		if(pname != '/' && pname != '/strategii' && pname != '/torgovlja'){
			$( "#coming_events" ).click();
		}

	});
</script>

<a href="#" id="coming_events" class="open left_caption"><span ><img src="images/ico_calendar.png"></span><span>Ближайшие События</span></a>
            <div id="coming_events_list">
            	<div class="coming_event coming_event2">
                    <span class="coming_event_title event_header">Актив</span>
                    <span class="coming_event_date event_header">Дата (Мскв.)</span>
                </div>

            	<?foreach($items as $item){?>
				<div class="coming_event">
                    <span class="coming_event_title"><?=$item->eventactive?></span>
                    <span class="coming_event_date"><?=$item->eventtime?> <?=date('d.m.Y',$item->eventdate)?></span>
                </div>
            	<?}?>

            </div>