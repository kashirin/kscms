<?php
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class MenuWidget extends Widget {

	public $message;
	
	public function init(){
		parent::init();
		if($this->message===null){
			$this->message= 'Welcome User';
		}else{
			$this->message= 'Welcome '.$this->message;
		}
	}
	
	public function run(){
		$msg = Html::encode($this->message);
		
		return $this->render('menu',['what_to_say' => $msg, 'widget'=>$this]);
	}
}
?>
