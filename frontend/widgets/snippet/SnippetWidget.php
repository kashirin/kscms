<?php
namespace frontend\widgets\snippet;

use yii\base\Widget;
use yii\helpers\Html;
use frontend\widgets\snippet\SnippetAssetBundle;

class SnippetWidget extends Widget {

	public $snippets; // AR array
	
	public function init(){
		parent::init();

		$ar = [];
		if(is_array($this->snippets)){
			foreach($this->snippets as $snippet){
				$ar[$snippet->code] = $snippet->description;
			}
		}
		$this->snippets = $ar;
	}
	
	public function run(){
		parent::run();

		$this->getView()
			 ->registerJs("var snippets = ".json_encode($this->snippets).";", \yii\web\View::POS_END, 'my-options');
		
		SnippetAssetBundle::register($this->getView());
		
	}
}
?>