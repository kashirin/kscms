<?php

namespace frontend\widgets;

use backend\models\article\ArticleRecord;


class TopnewsWidget extends \yii\base\Widget
{
    private $_items;

    protected function _initItems(){

    	$this->_items = ArticleRecord::find()
    						->where(['active'=>ArticleRecord::STATUS_IS_ACTIVE])
                            ->andWhere(['<','active_from',time()])
                            ->orderBy(['active_from' => SORT_DESC])
                            ->limit(5)
                            ->all();

    }

    public function run()
    {
    	$this->_initItems();

        return $this->render('topnews',['items' => $this->_items, 'widget'=>$this]);
    }
}