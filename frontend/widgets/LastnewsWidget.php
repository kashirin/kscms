<?php

namespace frontend\widgets;

use backend\models\structure\StructureRecord;
use backend\models\article\ArticleRecord;


class LastnewsWidget extends \yii\base\Widget
{
    private $_items;

    public $captionClass = '';

    public $parentCode = '';

    public $count = 6;

    public $caption;

    protected function _initItems(){




        $this->_items = ArticleRecord::find()
                ->select('article.*')
                ->leftJoin('structure', '`structure`.`id` = `article`.`parent_id`')
                ->where(['article.active' => ArticleRecord::STATUS_IS_ACTIVE])
                ->andWhere(['<','article.active_from',time()])
                ->andWhere(['structure.code'=>$this->parentCode])
                ->orderBy(['article.active_from' => SORT_DESC])
                ->with('structure')
                ->limit($this->count)
                ->all();

    }

    public function run()
    {
        $this->_initItems();

        return $this->render('lastnews',[
            'items' => $this->_items,
            'captionClass'=>$this->captionClass,
            'caption' => $this->caption
            ]);
    }
}