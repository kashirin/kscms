<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\utilities\BaseFrontendController;
use backend\models\file\FileModel;


class FileController extends BaseFrontendController
{
    

    public function actionIndex($code = false)
    {
    	echo 'download '.$code;
    }



   
}
