<?php

namespace backend\utilities;

use Yii;
use backend\models\carousel\CarouselRecord;
use backend\models\carousel\CarouselSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\filters\OnlyAdminFilter;

class BaseBackendController extends Controller
{

    public $default_views = true; // use default set of view files (false for custom view)

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            // restrict access for all non-admin users
            'access' => OnlyAdminFilter::className()
        ];
    }

    protected function _getViewFile($name){

        $view_file = '@app/views/Base'.ucfirst($name).'View';

        if(!$this->default_views){
            $view_file = $name;
        }

        return $view_file;
    }

    /**
     * Lists all CarouselRecord models.
     * @return mixed
     */
    public function actionIndex($parent_id)
    {
        $searchModel = new $this->searchClassRecord;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render($this->_getViewFile('index'), [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    

    /**
     * Creates a new ActiveRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($parent_id)
    {   
        /* ActiveRecord model */
        $model = new $this->recordClass;
        // init parent_id attribute
        $model->parent_id = $parent_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'parent_id' => $model->parent_id]);
        } else {
            return $this->render($this->_getViewFile('create'), [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ActiveRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'parent_id' => $model->parent_id]);
        } else {
            return $this->render($this->_getViewFile('update'), [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ActiveRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ActiveRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = call_user_func([$this->recordClass, 'findOne'], $id);
        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $model;
    }
}
