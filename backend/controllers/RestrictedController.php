<?php

namespace backend\controllers;

class RestrictedController extends \yii\web\Controller
{

    public $layout = 'wide';
    
    public function actionIndex()
    {
        return $this->render('index');
    }

}
