
<div id="banner" class="carousel">
    <div id="carousel" class="carousel_inner">
    	<?foreach($items as $item){?>
    		<div class="carousel_box"><a href="<?=$item->url?>"><img src="<?=$item->image?>"></a></div>
    	<?}?>
    </div>
</div>