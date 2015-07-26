<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\structure\StructureRecord */

$this->title = 'Редактирование ['.$model->label.'], ID='.$model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Панель администрирования сайта', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="structure-record-update">

    <h1><?//= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
