<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\utilities\BaseFrontendController;
use backend\models\structure\StructureRecord;
use backend\models\article\ArticleRecord;
/**
 * Site controller
 */
class SiteController extends BaseFrontendController
{
    
    const MSG_PAGE_NOT_FOUND = 'Страница не найдена';
    const MSG_PAGE_HANDLER_NOT_FOUND = 'Страница найдена, но не найден обработчик контента';

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

    protected function _tryToGetContent($seourl){

        $seourl = htmlspecialchars($seourl);

        if(!$seourl){
            return [
                'type'=>'homepage',
                'model'=>null
            ];
        }

        // find in  static pages
        $structureModel = new StructureRecord;
        $page = $structureModel
                ->find()
                ->where(['seourl'=>$seourl /*, 'active'=>StructureRecord::STATUS_IS_ACTIVE */])
                ->one();
                
        if($page){

            $allowed = Yii::$app->mainMenu->checkContentPageUrl($seourl);

            if($allowed){
                return [
                    'type'=>'page',
                    'model'=>$page
                ];
            }

        }
        // find in  static articles
        $articleModel = new ArticleRecord;
        $article = $articleModel
                ->find()
                ->where(['seourl'=>$seourl, 'active'=>ArticleRecord::STATUS_IS_ACTIVE])
                ->andWhere('active_from < '.time())
                ->one();
        if($article){
            return [
                'type'=>'article',
                'model'=>$article
            ];
        }

        return false;

    }

    public function actionIndex($seourl = false)
    {//\Yii::$app->getSession()->setFlash('success', 'Текст тут');

        // 0. homepage
        // 1. content page from structure table
        // 2. article from article table

        $content = $this->_tryToGetContent($seourl);

        if(!$content){
            throw new \yii\web\NotFoundHttpException(self::MSG_PAGE_NOT_FOUND);
        }

        switch ($content['type']) {
            case 'homepage':
                return $this->_renderHomePage($content);
                break;
            case 'page':
                return $this->_renderPage($content);
                break;
            case 'article':
                return $this->_renderArticle($content);
                break;
            default:
                throw new \yii\web\NotFoundHttpException(self::MSG_PAGE_HANDLER_NOT_FOUND);
                break;
        }
    }

    protected function _renderHomePage($content){
        return $this->render('index');
    }

    protected function _renderPage($content){

        $params = [];

        $params['breadcrumbs'] = Yii::$app->breadcrumbs->getBreadcrumbs($content['model']);

        $params['model'] = $content['model'];

        return $this->render('page',$params);
    }

    protected function _renderArticle($content){

        $params = [];

        $params['breadcrumbs'] = Yii::$app->breadcrumbs->getBreadcrumbs($content['model']);

        $params['model'] = $content['model'];

        return $this->render('article',$params);
    }

    

    

    

   
}
