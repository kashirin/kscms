<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\TinyMceWidget;
use yii\helpers\Url;
use backend\behaviors\AdminFormBehavior;

?>

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



<div class="structure-record-form">

    <?php $form = ActiveForm::begin([
		'options' => ['enctype'=>'multipart/form-data']
	]); ?>
	
	<?if( $model->getParentParams() ){ ?>
		<? foreach($model->getParentParams() as $field => $value){?>
			<?= $form->field($model, $field)->hiddenInput()->label(false) ?>
		<?}?>
	<?}else{?>
		<?= $form->field($model, 'parent_id')->hiddenInput()->label(false) ?> <? // one default parent param ?>
	<?}?>

	
	
	<?
	foreach($model->getDescription() as $field_name => $item){
		if($item['detail']){
			if($item['type']=='int' || $item['type']=='string'){
				echo $form->field($model, $field_name)->textInput();
			}elseif($item['type'] == 'text'){
				echo $form->field($model, $field_name)->textArea(['rows' => '4']);
			}elseif($item['type'] == 'editor'){
				echo TinyMceWidget::widget(['content' => $model->{$field_name},
											'field_id'=>$model->getShortActiveRecordName().'['.$field_name.']']);
			}elseif($item['type'] == 'datetime'){
				
				if(!in_array($field_name,['created_at','updated_at'])){
				
					echo $form->field($model, $field_name)->widget(\yii\jui\DatePicker::classname(), [
					'language' => 'ru',
					'dateFormat' => AdminFormBehavior::DATE_FORMAT,
					]);
				
				}

			}elseif($item['type'] == 'checkbox'){
				
				echo $form->field($model, $field_name)->radioList($item['values'], [
					
					'class' => 'btn-group',
					'data-toggle' => 'buttons',
					'unselect' => null, // remove hidden field
					'item' => function ($index, $label, $name, $checked, $value) {
						return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
							Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
					},
				]);
				
			}elseif($item['type'] == 'list'){
				
				echo $form->field($model, $field_name)->dropDownList($item['values']);
				
			}elseif($item['type'] == 'file'){
				echo $form->field($model, $field_name)->fileInput();
				if($model->{$field_name}){?>
					<div class="well well-sm">
						Загружен файл <?=Html::a('('.$model->{$field_name}.')',[$model->{$field_name}],['class'=>'file-preview-other'])?>
					</div>
				<?}
			}elseif($item['type'] == 'image'){
				echo $form->field($model, $field_name)->fileInput();
				if($model->{$field_name}){?>
					<div class="well well-sm">
						<?=Html::img($model->{$field_name},['class'=>'admin-thumb'])?>
					</div>
				<?}
			}
		}
	}
	?>
	
	
	
	
	

	<div class="top-buffer"></div><div class="top-buffer"></div>
		
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save fa-fw"></i> Создать' : '<i class="fa fa-save fa-fw"></i> Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?if(!$model->isNewRecord){?>
		<button type="button" id="predelete_button" class="btn btn-danger"> <i class="fa fa-remove fa-fw"></i>Удалить</button>
		<button type="button" id="canceldelete_button" class="btn btn-success hide"> <i class="fa fa-reply fa-fw"></i>Не удалять</button>
		<?= Html::a('<i class="fa fa-remove fa-fw"></i> Удалить',['/'.$controller_name.'/delete','id'=>$model->id],['id'=>'delete_link','data-method'=>'post', 'class'=>'hide'])?>
		<?}?>
	</div>

    <?php ActiveForm::end(); ?>

</div>