<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Structure Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="structure-record-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Structure Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'label',
            'url:url',
            'params',
            'info:ntext',
            // 'sort',
            // 'level',
            // 'collapsed',
            // 'parent_id',
            // 'created_at',
            // 'updated_at',
            // 'is_dir',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
