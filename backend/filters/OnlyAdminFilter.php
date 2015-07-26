<?php

namespace backend\filters;

use Yii;

class OnlyAdminFilter extends \yii\base\ActionFilter
{
    
    /**
     * @param \yii\base\Action $action
     */
    public function beforeAction($action)
    {
		
        if (!Yii::$app->user->identity->isAdmin) {
			throw new \yii\web\NotFoundHttpException('Not found');
        }
        
        return true;
    }
}