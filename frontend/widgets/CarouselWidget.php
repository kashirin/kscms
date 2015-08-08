<?php

namespace frontend\widgets;


class CarouselWidget extends \yii\base\Widget
{
    public $items;

    public function run()
    {
        return $this->render('carousel',['items' => $this->items, 'widget'=>$this]);
    }
}
