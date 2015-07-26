<?php

namespace frontend\utilities;

use Yii;
use backend\models\carousel\CarouselRecord;
use backend\models\carousel\CarouselSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\filters\OnlyAdminFilter;

class BaseFrontendController extends Controller
{
    const PAGE_ERROR = 'error';

    const PAGE_OPEN_SITE = 'abrakadabra';

    public function beforeAction($action)
    {
        if($action->id == self::PAGE_ERROR || $action->id == self::PAGE_OPEN_SITE){
            return true;
        }

        if (isset(Yii::$app->params['siteIsClosed']) && Yii::$app->params['siteIsClosed'] == true ) {
            // get session key
            if( !Yii::$app->session->has(self::PAGE_OPEN_SITE) ){
                throw new \yii\web\NotFoundHttpException('Сайт закрыт');
            }        
        }

        return true;
    }

    public function actionAbrakadabra(){
        Yii::$app->session->set(self::PAGE_OPEN_SITE,1);
        return $this->goHome();
    }

}
