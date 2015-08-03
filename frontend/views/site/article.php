<?php
/* @var $this yii\web\View */

use frontend\widgets\BreadcrumbsWidget;

$this->title = $model->title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->description
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model->keywords
]);
?>

<h1 class="caption blue"><span><?= $model->name ?></span></h1>
            <div class="padding37">
                
                <?= BreadcrumbsWidget::widget(['items' => $breadcrumbs]) ?>

                
                <?= $model->detail_text ?>


				<div class="soc"><img src="images/soc.jpg"></div>
				<div id="caption_comment"><span>Комментарии</span></div>
				<div id="comments" class="padding37">
					<div class="comment">
						<div class="left"><img src="images/no_face.jpg"></div>
						<div class="right">
							<div class="comment_name">Наталья</div><div class="clear"></div>							
							Надеюсь, Вам понравятся результаты от торговли по моей стратегии бинарных опционов 60 секунд.
							Потребуется некоторое время, что бы приноровиться ловить моменты отскока рыночной цены
						</div>
					</div>
					<div class="clear" style="height:28px"></div>
					<div class="comment">
						<div class="left"><img src="images/no_face.jpg"></div>
						<div class="right">
							<div class="comment_name">Наталья</div><div class="clear"></div>							
							Надеюсь, Вам понравятся результаты от торговли по моей стратегии бинарных опционов 60 секунд.
							Потребуется некоторое время, что бы приноровиться ловить моменты отскока рыночной цены
						</div>
					</div>
					<div class="clear"></div>
				</div>		
					<div class="clear" style="height:28px"></div>
					<form method="post" id="add_comment">
						<div id="add_comment_title">Оставить сообщение</div>
						<div class="clear" style="height:28px"></div>
						<input type="text" name="name" placeholder="имя">
						<div class="clear" style="height:18px"></div>
						<textarea>сообщение</textarea>
						<div class="clear" style="height:22px"></div>
						<input type="submit" value="Отправить">
					</form>


            </div>