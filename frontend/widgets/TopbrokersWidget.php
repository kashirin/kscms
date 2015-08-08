<?php

namespace frontend\widgets;

use backend\models\carousel\CarouselRecord;


class TopbrokersWidget extends \yii\base\Widget
{
    private $_items;

    const PARENT_ID = 48;

    protected function _initItems(){

    	$this->_items = CarouselRecord::find()
    						->where(['active'=>CarouselRecord::$STATUS_IS_ACTIVE])
                            ->andWhere(['parent_id'=>self::PARENT_ID])
                            ->orderBy(['sort' => SORT_ASC])
                            ->all();

    }

    public function run()
    {
    	$this->_initItems();

        return $this->render('topbrokers',['items' => $this->_items, 'widget'=>$this]);
    }
}