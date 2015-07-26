<?php
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class TinyMceWidget extends Widget {

	public $content;
	
	public $field_id;
	
	public function init(){
		parent::init();
		
	}
	
	private function getTiny($f_id, $cont){
	
		$prepared_f = str_replace("[",'_',$f_id);
		$prepared_f = str_replace("]",'_',$prepared_f);
		
		return '
			<script>
			
			//$(function(){
			
				tinymce.init({
				content_css : "/css/template.css",
				language : "ru",
				selector: "textarea#'.$prepared_f.'",
				theme: "modern",
				width: "100%",
				height: 500,
				plugins: [
					"advlist autolink lists link image charmap print preview anchor",
					"searchreplace visualblocks code fullscreen",
					"insertdatetime media table contextmenu paste moxiecut columns hiddenlinks textcolor textdecorators"
				],
				toolbar: "undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image columns"
			  
			 });
			
			//});
			

			
			
			 
			</script>
			<textarea name="'.$f_id.'" id="'.$prepared_f.'">'.$cont.'</textarea>
		';
	}
	
	public function run(){
		//$msg = Html::encode($this->message);
		
		return $this->getTiny($this->field_id, $this->content);
	}
}
?>
