<?php
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii;

class AdminFormListWidget extends Widget {

	// instance of model
	public $model;
	
	public $searchModel;
    public $dataProvider;
	
	public function init()
    {
        parent::init();
       
    }
	
	protected function getControllerName(){
		$reflect = new \ReflectionClass(Yii::$app->controller);
		return strtolower(str_replace("Controller","",$reflect->getShortName()));
	}
	
	public function getStandartColumns(){
		$arColumns = [ ['class' => 'yii\grid\SerialColumn'] ];
		
		foreach($this->model->getDescription() as $field_name => $item){
			if($item['grid']){
				if(in_array($item['type'], ['int', 'string','text'])){
					$arColumns[] = $field_name;
				}elseif($item['type'] == 'datetime'){
					$arColumns[] = [
								'attribute' => $field_name,
								'format' => ['date', 'php:Y-m-d H:i:s']
					];
				}elseif($item['type'] == 'date'){
					$arColumns[] = [
								'attribute' => $field_name,
								'format' => ['date', 'php:Y-m-d']
					];
				}elseif($item['type'] == 'file'){
					$arColumns[] = [
								'label' => $item['label'],
								'value' =>function($model) use($field_name) {
											
										return	Html::a($model->{$field_name},[$model->{$field_name}],['class'=>'file-preview-other']);
									
								},
								'format' => 'raw'
					];
				}elseif($item['type'] == 'image'){
					$arColumns[] = [
								'label' => $item['label'],
								'value' =>function($model) use($field_name) {
										if(!empty($model->{$field_name})){
											return	Html::img($model->{$field_name},['class'=>'admin-thumb-100']);
										}else{
											return 'нет';
										}
									
								},
								'format' => 'raw'
					];
				}elseif($item['type'] == 'checkbox' || $item['type'] == 'list'){
					$list = $item['values'];
					$arColumns[] = [
								'label' => $item['label'],
								'value' =>function($model) use($field_name, $list) {
										if(isset( $list[$model->{$field_name}] )){
											return $list[$model->{$field_name}];
										}else{
											return '?';
										}
									
								},
								'format' => 'raw'
					];
				}
			}
		}
		
		$arColumns[] = ['class' => 'yii\grid\ActionColumn','template' => '{update}<br><br>{delete}'];
		
		return $arColumns;
	}
	
	public function run(){
		$parent_id = 0;
		if(isset(Yii::$app->request->queryParams['parent_id'])){
			$parent_id = Yii::$app->request->queryParams['parent_id'];
		}
	
		return $this->render('admin_form_list',[
			'model' => $this->model,
			'widget'=>$this,
			'searchModel'=>$this->searchModel,
			'dataProvider'=>$this->dataProvider,
			'controller_name'=>$this->getControllerName(),
			'parent_id'=>$parent_id
			]);
	}
}