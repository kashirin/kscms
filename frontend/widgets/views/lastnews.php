<? if(count($items)){?>
<div class="<?=$captionClass?>"><span><?=$caption?></span></div>
            <? $cnt=0;?>
            <div class="items">
            <?foreach ($items as $item){?>
                <? $cnt++; ?>

                <a href="/<?=$item->seourl?>"><img width="286" src="<?=$item->image?>"><span><?=$item->name?></span></a>
                
                <? if($cnt % 3 == 0){?>
                </div>
                <? if($cnt < count($items)){?>
                    <div class="clear" style="height:12px;"></div>
                    <div class="clear line_gray"></div>
                <? } ?>
                <div class="items">
                <?}?>
                
            <?}?>
            </div> 
            <div class="clear" style="height:12px;"></div>
<? } ?>

            