<?php

namespace common\filters;

use Yii;
use yii\filters\AccessRule;

class CustomAccessRule extends AccessRule
{

    /** @inheritdoc */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
		
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if (Yii::$app->user->isGuest) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!Yii::$app->user->isGuest) {
                    return true;
                }
            } elseif ($role === 'admin') {
                if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin) {
                    return true;
                }
            }
        }

        return false;
    }
}