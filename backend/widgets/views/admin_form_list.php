<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\TinyMceWidget;
use yii\helpers\Url;
use backend\behaviors\AdminFormBehavior;
use yii\grid\GridView;

?>

<div class="article-record-index">

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $widget->getStandartColumns()
    ]); ?>
	
	<p>
        
		<?if( $searchModel->getParentParams() ){ ?>
			<?= Html::a('<i class="fa fa-plus-square fa-fw"></i> '.$searchModel->getCaption('add_element'), array_merge(['/'.$controller_name.'/create'],$searchModel->getParentParams()), ['class' => 'btn btn-success']) ?>
		<?}else{?>
			<?= Html::a('<i class="fa fa-plus-square fa-fw"></i> '.$searchModel->getCaption('add_element'), ['/'.$controller_name.'/create', 'parent_id'=>$parent_id], ['class' => 'btn btn-success']) ?>
		<?}?>

    	
    </p>
	
</div>