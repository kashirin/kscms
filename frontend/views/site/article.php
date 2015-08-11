<?php
/* @var $this yii\web\View */

use frontend\widgets\BreadcrumbsWidget;

use frontend\modules\comment\widgets\CommentsWidget;



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

    
				<div class="soc">
                    <?= $this->render('_soc_buttons') ?>
                    <!--<img src="images/soc.jpg">-->
                </div>
				<!-- comments -->
				<?= CommentsWidget::widget([
					'parent_id' => $model->id,
					'type' => CommentsWidget::TYPE_ARTICLE
				]) ?>

			<!-- end padding37 -->
            </div>