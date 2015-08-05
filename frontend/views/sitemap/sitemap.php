<?php
/* @var $this yii\web\View */



$this->title = 'Карта сайта';
/*$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->description
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model->keywords
]);*/
?>

<h1 class="caption blue"><span>Статьи по разделам</span></h1>
            <div class="sitemap">
                
               

                <ul>
                <? foreach ($articles as $key => $first_level) {?>
                	<li><strong><?=$first_level['label']?></strong><br>
                		<ul>
                		<? if($first_level['children']){?>
							<? foreach ($first_level['children'] as $k => $second_level) {?>
								<? if($second_level['articles']){?>
								<li>
									<strong><?=$second_level['label']?></strong><br>
									<ul>
									<? foreach ($second_level['articles'] as $item) {?>
										<li><a href="/<?=$item['url']?>"><?=$item['name']?></a></li>
									<? } ?>
									</ul>
								</li>
								<? } ?>
							<? } ?>
                		<? } ?>
                		</ul>
                	</li>
                <? }?>
				</ul>

				<ul>
					<li>
                		<strong>Остальное</strong><br>
                		<ul>
                			<? foreach ($pages as $key => $page) {?>
                				<li><a href="/<?=$page['url']?>"><?=$page['name']?></a></li>
                			<? } ?>
                		</ul>
                	</li>
				</ul>

				

			<!-- end padding37 -->
            </div>