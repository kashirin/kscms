<?php

namespace frontend\modules\comment\widgets;

use backend\models\comment\CommentRecord;

class CommentsWidget extends \yii\base\Widget
{
	const TYPE_ARTICLE = 'article';

	const TYPE_PAGE = 'page';

    public $parent_id;

    public $type;

    public function run()
    {
    	$type = false;

    	if($this->type == self::TYPE_ARTICLE){
    		$type = 'article';
    	}elseif($this->type == self::TYPE_PAGE){
    		$type = 'page';
    	}else{
    		throw new Exception("Error CommentsWidget: unknown type [".$this->type."]");
    	}

    	$models = CommentRecord::find()->where([
    							'parent_id'=>(int)$this->parent_id,
    							'type' => $type,
    							'active' => CommentRecord::STATUS_IS_ACTIVE
    							])
    							->orderBy(['sort' => SORT_ASC])
    							->all();

        return $this->render('comments',[
        				'parent_id' => $this->parent_id,
        				'type'=>$this->type,
        				'models'=>$models
        ]);
    }
}
