<?php

namespace frontend\modules\comment\controllers;

use backend\models\comment\CommentRecord;
use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{
    public function actionCreate()
    {
        $validator = new \yii\captcha\CaptchaValidator();

        $post = Yii::$app->request->post(); 

        $res = $validator->validate($post['captcha'], $err);
        
        if($res){

        	$comment = new CommentRecord();

        	$comment->parent_id = $post['parent_id'];
        	$comment->type = $post['type'];
        	$comment->text = $post['text'];
        	$comment->user_name = $post['user_name'];
        	$comment->active = CommentRecord::STATUS_IS_NOT_ACTIVE;

        	$comment->save();

        	Yii::$app->getSession()->setFlash('success', 'Ваш комментарий добавлен и после модерации появится на сайте');
        }else{
        	Yii::$app->getSession()->setFlash('error', 'Код введен не верно');
        }

        $this->redirect($post['back_url']);

    }
}
