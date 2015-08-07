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
    	$fileModel = FileRecord::find()->where(['code' => $code])->one();
    	if(!$fileModel){
    	    throw new \yii\web\NotFoundHttpException('Такого файла не существует');
    	}

    	$file_path = Yii::getAlias('@webroot').$fileModel->file;
        //$file_path = 'D:/OpenServer/domains/yii/kscms/backend/web'.$fileModel->file;
        $file_info = pathinfo($file_path);

        header('Content-type: application/'.$file_info['extension']);
        header('Content-Disposition: attachment; filename="'.$fileModel->name.'.'.$file_info['extension'].'"');
        if (readfile( $file_path )){
            exit;
        }

    }



   
}
