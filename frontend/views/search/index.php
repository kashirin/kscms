<?php

use frontend\widgets\BreadcrumbsWidget;

$this->title = 'myoption.ru - Поиск - '.$q;
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Поиск'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Поиск, '.$q
]);

if(count($models)<=0){
	\Yii::$app->getSession()->setFlash('success', 'По вашему запросу ничего не найдено!');

}else{?>

<style>
.index_news{
	padding-top:20px;
	padding-bottom:20px;
	width:100%;
	height:183px;
	
	border-bottom: 1px #e9ebec dashed;
	
}
.index_news_left{
	width:310px;
	height:183px;
	float:left;
	overflow: hidden;
}
.index_news_right{
	width:500px;
	float:right;
}
.index_news_caption{
	color:#1D1D1F;
	font-size:18px;
	text-transform: uppercase;
	text-decoration: underline;
}
.index_news_caption a{
	color:#1D1D1F;
}

.index_news_text{
	color:#636363;
	font-size:15px;
	margin-top:0px;
	line-height: 1.5;
}
.index_news_more{
	background-color: #2C98F0;
    width: 113px;
    color: #fff;
    border: 0px;
    border-radius: 5px;
    height: 41px;
    cursor: pointer;
    font-size: 16px;
    padding: 10px 18px;
    text-decoration: none;
}	

</style>

<h1 class="caption blue"><span>Результат поиска <strong>&laquo;<?=$q?>&raquo;</strong></span></h1>
            <div class="padding37">
                
                <?= BreadcrumbsWidget::widget(['items' => [
                	['label' => 'Главная',
                	'url'=>'/'],
                	['label'=>'Поиск']
                ]]) ?>
			
			<div class="clear" style="height:18px;"></div>

            <div class="search-results">

            <?foreach($models as $k=>$model){?>
			
			<div class="clear" style="height:50px;"></div>



			<div>

            <div class="index_news_caption"><a href="/<?=$model->seourl?>"><?=$model->name?></a></div> 
                
			<div class="index_news">
			<div class="index_news_left">
				<img width="310" height="183" alt="<?=$model->name?>" src="<?=$model->image?>">
			</div>
			<div class="index_news_right">
				<div class="index_news_text">
					<?=$model->preview_text?>
				</div>
				<div class="clear" style="height:15px;"></div>
				<a href="/<?=$model->seourl?>" class="index_news_more">читать подробнее</a>
			</div>
			
			</div>

			
			<?if($k!=count($models)-1){?>
				<div class="clear" style="height:50px; border-bottom: 2px solid #d8d8d8;"></div>
			<?}?>

			<?}?>

		</div>



	</div>

			

			<!-- end padding37 -->
            </div>


<?}?>