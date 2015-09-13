<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\filters\CustomAccessRule;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use backend\models\structure\StructureRecord;

/**
 * Site controller
 */
class SiteController extends Controller
{
	
	
	
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => CustomAccessRule::className(),
                ],
                'rules' => [
					[
                        'allow' => true,
						'actions' => ['access-restricted'],
                        'roles' => ['@','?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
				'denyCallback' => function () {
					return Yii::$app->response->redirect(['restricted']);
				},
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->actionDashboard();
    }

    public function actionDashboard($parent_id = 0)
    {  
        return $this->render('dashboard', ['menu_items'=>StructureRecord::findAll(['parent_id'=>$parent_id])]);
    }

    


}
