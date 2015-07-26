<?php

namespace backend\behaviors;

use yii;
use yii\db\ActiveRecord;
use yii\base\Behavior;
use backend\widgets\AdminFormDetailWidget;
use backend\widgets\AdminFormListWidget;
use common\components\UploadedFile;




class AdminFormBehavior extends Behavior
{
	const METHOD_DESCRIPTION = 'getDescription';
	
	const METHOD_CAPTIONS = 'getCaptions';

	const METHOD_CONTEXT_MENU = 'getContextMenu';
	
	const SORT_STEP = 10;
	
	const DATE_FORMAT = 'dd.MM.yyyy';

	protected $_parentParams = false; // set of key fields of parent object

	public function setParentParams($arParams){
		$this->_parentParams = $arParams;
	}

	public function getParentParams(){
		return $this->_parentParams;
	}
	

	protected function _checkDescriptionMethod($event){
		if(!method_exists($this->owner,self::METHOD_DESCRIPTION)){
			throw new \Exception('Owner class must have ['.self::METHOD_DESCRIPTION.'] method');
		}
		if(!method_exists($this->owner,self::METHOD_CAPTIONS)){
			throw new \Exception('Owner class must have ['.self::METHOD_CAPTIONS.'] method');
		}
	}
	
	public function _onInit($event){
		$this->_checkDescriptionMethod($event);
	}
	
	protected function _fillSortField(){
		if($this->owner->isNewRecord && empty($this->owner->sort)){
			$this->owner->sort = $this->getNewSortValue();
		}	
	}
	
	protected function normalizeDate($event){
		foreach($this->owner->{self::METHOD_DESCRIPTION}() as $field => $item){
			
			if($item['type'] == 'datetime' && !in_array($field,['created_at','updated_at'])){
				if(empty($this->owner->{$field})){
					$this->owner->{$field} = time();
				}else{
					$arDate = explode('.',$this->owner->{$field});
					$this->owner->{$field} = mktime(0, 0, 0, $arDate[1], $arDate[0], $arDate[2]);
				}
			}
		}
		
	}
	
	protected function upOrSaveFiles($arFiles){
	
		$res = true;
		$fileObjects = [];
		if(is_array($arFiles)){
			foreach($arFiles as $fname){
				$fileObject = UploadedFile::getInstance($this->owner, $fname);
				if(!empty($fileObject)){
					$this->owner->setAttribute($fname, $fileObject->getPreparedName());
					$fileObjects[] = $fileObject;
				}
			}
		}
			
							
		foreach($fileObjects as $fileObject){
			if(!empty($fileObject)){
				$fileObject->saveIt();
			}
		}

		
		return $res;
	
	}
	
	protected function _fillInfoAboutFiles(){
		$arFileNames = [];
		foreach($this->owner->{self::METHOD_DESCRIPTION}() as $field => $item){
			if($item['type']=='file' || $item['type']=='image'){
				$arFileNames[] = $field;
			}
		}
		$this->upOrSaveFiles($arFileNames);
	}
	
	public function _onBeforeInsert($event){
		$this->normalizeDate($event);
		$this->_fillInfoAboutFiles();
		$this->_fillSortField();
	}
	
	public function _onBeforeUpdate($event){
		$this->normalizeDate($event);
		$this->_fillInfoAboutFiles();
	}
	
	public function events()
    {
        return [
            ActiveRecord::EVENT_INIT => '_onInit',
			ActiveRecord::EVENT_BEFORE_INSERT => '_onBeforeInsert',
			ActiveRecord::EVENT_BEFORE_UPDATE => '_onBeforeUpdate'
        ];
    }

    

    
	
	public function getDetail(){
		return AdminFormDetailWidget::widget([
			'model' => $this->owner
			]);
	}
	
	public function getCaption($name = false){
		if(!$name){
			return 'Не установлено имя заголовка';
		}
		
		$arMap = $this->owner->getCaptions();
		
		if(!isset($arMap[$name])){
			return 'Неизвестное имя заголовка';
		}
		
		return $arMap[$name];
		
	}

	protected function _replaceWithModel($str){
		$arAttrs = $this->owner->attributes();
		foreach ($arAttrs as $attrName) {
			$str = str_replace('{'.$attrName.'}', $this->owner->{$attrName}, $str);
		}
		return $str;
	}

	public function getMenu(){

		$result = [];

		if(method_exists($this->owner,self::METHOD_CONTEXT_MENU)){
			foreach($this->owner->{self::METHOD_CONTEXT_MENU}() as $item){
				if(isset($item['label'])){
					$item['label'] = $this->_replaceWithModel($item['label']);
				}
				if(isset($item['link'])){
					if(is_array($item['link'])){
						foreach ($item['link'] as $key => $value) {
							$item['link'][$key] =  $this->_replaceWithModel($value);
						}
					}else{
						$item['link'] = $this->_replaceWithModel($item['link']);
					}
				}
				$result[] = $item;
			}
		}

		return $result;

	}
	
	public function getList($searchModel, $dataProvider){
		return AdminFormListWidget::widget([
			'model' => $this->owner,
			'searchModel'=>$searchModel,
			'dataProvider'=>$dataProvider
			]);
	}
	
	public function getShortActiveRecordName(){
		$ar = explode("\\",$this->owner->className());
		return $ar[count($ar)-1];
	}
	
	public function getControllerName(){
		$reflect = new \ReflectionClass(Yii::$app->controller);
		return strtolower(str_replace("Controller","",$reflect->getShortName()));
	}
	
	// return object for $this->parent_id, type depends on $parent_level_class
	public function getParent($parent_level_class = 'backend\models\structure\StructureRecord'){
		if (($model = $parent_level_class::findOne($this->owner->parent_id)) !== null) {
            return $model;
        } else {
            throw new \Exception('Parent section doesn`t exist.');
        }
	}
	
	public function getNewSortValue(){
		// calculate sort prop
		$command = $this->owner->getDb()->createCommand("SELECT MAX(sort) as srt from ".$this->owner->tableName()." where parent_id=".$this->owner->parent_id)->queryOne();
		return ($command['srt'] + self::SORT_STEP);
	}
	
	
    
}