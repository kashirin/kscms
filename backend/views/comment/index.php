<?php

use yii\helpers\Html;




$first_level_class = $searchModel->getParentModelClass( \yii::$app->getRequest()->getQueryParam('type') );
$first_level_object = $first_level_class::findOne(\yii::$app->getRequest()->getQueryParam('parent_id'));

$this->params['breadcrumbs'][] = [
    'label' => $first_level_object->{$searchModel->getParentNameField( \yii::$app->getRequest()->getQueryParam('type') )},
    'url' => [$searchModel->getParentControlerName( \yii::$app->getRequest()->getQueryParam('type') ).'/update', 'id'=>$first_level_object->id]
];

$this->params['breadcrumbs'][] = 'комментарии';

?>


<?= $searchModel->getList($searchModel, $dataProvider) ?>