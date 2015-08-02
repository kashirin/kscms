<?php

namespace console\controllers;
 
use Yii;
use yii\console\Controller;
 
/**
 * Test controller
 */
class TestController extends Controller {
 
    public function actionIndex($name) {
        
    	Yii::$app->mailer->compose()
	     ->setFrom('admin@myoption.ru')
	     ->setTo($name)
	     ->setSubject('some subj')
	     ->setTextBody('Plain text content')
	     ->send();

    }
 
}