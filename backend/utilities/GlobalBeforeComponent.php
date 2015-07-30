<?php

namespace backend\utilities;

class GlobalBeforeComponent extends \yii\base\Component{
    
    public function init() {
        var_dump('here before');
        parent::init();
    }
    
}