<div class="left_caption red"><span ><img src="images/ico_file.png"></span><span>Новое на Сайте</span></div>
            <div class="new_items">
                <?foreach($items as $item){?>
                    <a href="/<?=$item->seourl?>"><div class="darken"><img width="208" src="<?=$item->image?>"></div><span class="arrow_rigth"></span>
                    <div class="clear" style="height:5px;"></div>
                    <span><?=$item->name?></span>
                    </a>
                <?}?>
            </div>