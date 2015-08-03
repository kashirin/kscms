<?php

namespace frontend\widgets;


class MainMenuWidget extends \yii\base\Widget
{
    public $items;

    public function run()
    {
        return $this->render('menu',['items' => $this->items, 'widget'=>$this]);
    }
}
