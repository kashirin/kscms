<?php

namespace backend\filters;

use Yii;

class BackendFilter extends \yii\base\ActionFilter
{
    
    /**
     * @param \yii\base\Action $action
     */
    public function beforeAction($action)
    {//var_dump($action->controller->id);exit;
		if(in_array($action->controller->id, ['security'])){
			return true;
		}
		
        if (!Yii::$app->user->identity->isAdmin) {
			throw new \yii\web\NotFoundHttpException('Not found');
        }
        
        return true;
    }
}