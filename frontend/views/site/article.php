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
            </div>