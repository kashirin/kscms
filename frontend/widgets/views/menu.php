<ul id="header_menu">
<? foreach ($items as $level_one_item) {?>
   <? if(!$level_one_item['children']){ ?>
    <li><a href="<?=$level_one_item['url']?>"><span><?=$level_one_item['label']?></span></a></li>
   <? }else{ ?>
    <li>
    <a href="<?=$level_one_item['url']?>"><span><?=$level_one_item['label']?></span></a>
    <ul>
        <? foreach ($level_one_item['children'] as $level_two_item) {?>
        <li><a href="<?=$level_two_item['url']?>"><span><?=$level_two_item['label']?></span></a>
        <? } ?>
    </ul>
   </li>
   <? }?>
<? } ?>
</ul>