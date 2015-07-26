<?php
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii;

class AdminFormDetailWidget extends Widget {

	// instance of model
	public $model;
	
	public function init()
    {
        parent::init();
       
    }
	
	protected function getControllerName(){
		$reflect = new \ReflectionClass(Yii::$app->controller);
		return strtolower(str_replace("Controller","",$reflect->getShortName()));
	}
	
	public function run(){
	
		return $this->render('admin_form_detail',['model' => $this->model, 'widget'=>$this, 'controller_name'=>$this->getControllerName() ]);
	}
}