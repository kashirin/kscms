<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\utilities\BaseFrontendController;
use frontend\models\SearchModel;
use frontend\components\SitemapComponent;

class SitemapController extends BaseFrontendController
{
    

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($seourl = false)
    {
    	$sm = new SitemapComponent();
    	
        return $this->render('sitemap', ['articles'=>$sm->getArticles(), 'pages'=>$sm->getPages()]);
    }
	
	public function actionXml()
    {
		Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
		
		$headers = Yii::$app->response->headers;
		
		$headers->add('Content-Type', 'text/xml');
		
		$sm = new SitemapComponent();
    	
        return $this->renderPartial('xml', ['articles'=>$sm->getArticles(), 'pages'=>$sm->getPages()]);
    }



   
}
