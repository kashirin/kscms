<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\article\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'active_from') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php  echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'preview_text') ?>

    <?php // echo $form->field($model, 'detail_text') ?>

    <?php // echo $form->field($model, 'soc_text') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'seourl') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'file') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
