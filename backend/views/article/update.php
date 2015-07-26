<?php

use yii\helpers\Html;


$this->title = $model->getCaption('update_element') . ' // ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->getParent()->label, 'url' => ['/'.$model->getControllerName().'/index', 'parent_id'=>$model->parent_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-record-update">

    <?= $model->getDetail() ?>

</div>
