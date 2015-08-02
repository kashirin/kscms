<?php

namespace console\controllers;
 
use yii\console\Controller;
 
/**
 * Test controller
 */
class TestController extends Controller {
 
    public function actionIndex($name) {
        echo "cron service runnning ".$name;
    }
 
    public function actionMail($to) {
        echo "Sending mail to " . $to;
    }
 
}