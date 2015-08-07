<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\utilities\BaseFrontendController;
use backend\models\file\FileRecord;


class FileController extends BaseFrontendController
{
    

    public function actionIndex($code = false)
    {
    	$code = htmlspecialchars($code);
    	$fileModel = FileRecord::find()->where(['code' => $code])->one;
    	if(!$fileModel){
    	    throw new \yii\web\NotFoundHttpException('Такого файла не существует');
    	}
    	var_dump($fileModel);
    }



   
}
