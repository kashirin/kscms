<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\TinyMceWidget;
use backend\models\structure\StructureRecord;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\structure\StructureRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="structure-record-form">


	<?if($arContextMenu = $model->getMenu()){ ?>
	<div class="btn-group">
	    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	        <i class="fa fa-bars fa-fw"></i> Меню <span class="caret"></span>
	    </button>
	    <ul class="dropdown-menu" role="menu">
		<? foreach($arContextMenu  as $item){?>
			<li><?=Html::a($item['label'], $item['link']);?></li>
		<?}?>
		</ul>
	</div>
	<? } ?>

    <?php $form = ActiveForm::begin([
		'options' => ['enctype'=>'multipart/form-data']
	]); ?>
	
	<div class="panel panel-default <?php if($model->id>0){echo 'hide';}?>">
		<div class="panel-heading"><h4>Сценарий работы</h4></div>
		<div class="panel-body">
		
		<?php
	
		echo $form->field($model, 'is_dir')->radioList([
			StructureRecord::STATUS_IS_NOT_DIR => 'Страница',
			StructureRecord::STATUS_IS_DIR => 'Раздел',
		], [
			//'id' => 'projects_status',
			'class' => 'btn-group',
			'data-toggle' => 'buttons',
			'unselect' => null, // remove hidden field
			'item' => function ($index, $label, $name, $checked, $value) {
				return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
					Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
			},
		]);
		
		?>
		
		<div class="form-group field-item-type">
			<label class="control-label" for="item-type">Контент типа...</label>
			
			<select id="item-type" name="item-type" class="form-control">
				<option value="page">Страница</option>
				<option value="articles">Статьи</option>
				<option value="url">URL</option>
			</select>

			<div class="help-block"></div>
		</div>
		
		<?= $form->field($model, 'url')->textInput() ?>
		 

		
		</div>
	</div>
	
	<?= $form->field($model, 'parent_id')->hiddenInput()->label(false) ?>
	
	<div class="panel panel-default">
		<div class="panel-heading"><h4>Основное</h4></div>
		<div class="panel-body">
		<?= $form->field($model, 'label')->textInput() ?>
	
		<?= $form->field($model, 'info')->textArea(['rows' => '4']) ?>

		<?= $form->field($model, 'color')->dropDownList(
			['' => 'Стандартный','green'=>'Зеленый', 'red'=>'Красный', 'orange'=>'Оранжевый', 'black'=>'Черный']
		) ?>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading"><h4>SEO</h4></div>
		<div class="panel-body">
		<?= $form->field($model, 'title')->textInput() ?>
	
		<?= $form->field($model, 'description')->textInput() ?>
		
		
		<?= $form->field($model, 'keywords')->textInput() ?>
		
		<?= $form->field($model, 'seourl')->textInput() ?>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading"><h4>Основной текст</h4></div>
		<div class="panel-body">
		<?//= $form->field($model, 'content')->textArea(['rows' => '4']) ?>
		
		
		<?= TinyMceWidget::widget(['content' => $model->content, 'field_id'=>'StructureRecord[content]']) ?>
		
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading"><h4>Приложения</h4></div>
		<div class="panel-body">
		
		
		
		<?= $form->field($model, 'file')->fileInput() ?>
		<? if($model->file){ ?>
		<div class="well well-sm">
		Загружен файл <?=Html::a('('.$model->file.')',[$model->file],['class'=>'file-preview-other'])?>
		</div>
		<? } ?>
		
		<?= $form->field($model, 'image')->fileInput() ?>
		<? if($model->image){ ?>
		<div class="well well-sm">
		<?=Html::img($model->image,['class'=>'admin-thumb'])?>
		</div>
		<? } ?>
		
		
		
		</div>
	</div>
	
	
	
	
	
	
	
	
	<?//= $form->field($model, 'url')->textInput() ?>

    <?//= $form->field($model, 'level')->textInput() ?>

	<div class="top-buffer"></div><div class="top-buffer"></div>
		
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save fa-fw"></i> Создать' : '<i class="fa fa-save fa-fw"></i> Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?if(!$model->isNewRecord){?>
		<button type="button" id="predelete_button" class="btn btn-danger"> <i class="fa fa-remove fa-fw"></i>Удалить</button>
		<button type="button" id="canceldelete_button" class="btn btn-success hide"> <i class="fa fa-reply fa-fw"></i>Не удалять</button>
		<?= Html::a('<i class="fa fa-remove fa-fw"></i> Удалить',['/structure/delete','id'=>$model->id],['id'=>'delete_link','data-method'=>'post', 'class'=>'hide'])?>
		<?}?>
	</div>

    <?php ActiveForm::end(); ?>

</div>
