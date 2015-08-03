<?php

namespace frontend\widgets;


class BreadcrumbsWidget extends \yii\base\Widget
{
    public $items;

    private function getHtml($items){

        $html = '<div id="breadcrumbs">';
        
        $arItems = [];

        foreach($items as $elem){
            if(!$elem['url']){
                $arItems[] = '<span>'.$elem['label'].'</span>';
            }else{
                $arItems[] = '<a href="'.$elem['url'].'">'.$elem['label'].'</a> /';
            }
        }

        $html .= implode("\r\n", $arItems);

        $html .= '</div>';

        return $html;
    }

    public function run()
    {
        return $this->getHtml($this->items);
    }
}
