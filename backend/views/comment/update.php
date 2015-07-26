<?php


$this->title = $model->getCaption('update_element');
$parentModel = $model->getParent( $model->getParentModelClass($model->type) );

$this->params['breadcrumbs'][] = [
	'label' => $parentModel->{$model->getParentNameField( $model->type )} . ' // комментарии',
	'url' => ['/comment/index', 'type'=>$model->type, 'parent_id'=>$model->parent_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-record-update">

    <?= $model->getDetail() ?>

</div>

