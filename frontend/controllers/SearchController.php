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
/**
 * Site controller
 */
class SearchController extends BaseFrontendController
{
    

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    

    public function actionIndex()
    {   

        try {
            
            $q = htmlspecialchars(Yii::$app->getRequest()->get('q'));

            $model = new SearchModel;

            $models = $model->find($q)->getAllModels();

        } catch (\Exception $e) {
           \Yii::$app->getSession()->setFlash('error', 'Ошибка запроса, вероятно вы ничего не ввели!');
            
            $this->redirect('/');
        }

        return $this->render('index',['models'=>$models, 'q'=>$q]);
    }



   
}
