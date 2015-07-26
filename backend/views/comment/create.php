<?php


$this->title = $model->getCaption('add_element');
$this->params['breadcrumbs'][] = ['label' => $model->getParent( $model->getParentModelClass($model->type) )->{$model->getParentNameField( $model->type )}, 'url' => ['/comment/index', 'type'=>$model->type, 'parent_id'=>$model->parent_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-record-create">

	<?= $model->getDetail() ?>

</div>
