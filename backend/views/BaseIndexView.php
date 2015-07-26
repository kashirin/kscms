<?php

use yii\helpers\Html;
use backend\models\structure\StructureRecord;



$this->title = StructureRecord::findOne(\yii::$app->getRequest()->getQueryParam('parent_id'))->label;

$this->params['breadcrumbs'][] = $this->title;
?>

<?= $searchModel->getList($searchModel, $dataProvider) ?>