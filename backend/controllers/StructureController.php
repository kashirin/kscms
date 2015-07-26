<?php

namespace backend\controllers;

use Yii;
use backend\models\structure\StructureRecord;
use common\helpers\Translit;
use common\components\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\filters\OnlyAdminFilter;

/**
 * StructureController implements the CRUD actions for StructureRecord model.
 */
class StructureController extends Controller
{

	//public $defaultAction = 'index';
	
	
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
			'access' => OnlyAdminFilter::className()
        ];
    }

    /**
     * Lists all StructureRecord models.
     * @return mixed
     */
    /*public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => StructureRecord::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Displays a single StructureRecord model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StructureRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id=0)
    {
        $model = new StructureRecord();
		
		$model->parent_id = $id;
		$model->is_dir = StructureRecord::STATUS_IS_NOT_DIR;

        if ($model->load(Yii::$app->request->post()) ) {
		
			$this->fillSeourl($model);
			
			// status
			$model->purpose = Yii::$app->request->post('item-type');
		
			if($this->upOrSave($model,['file','image'])){
				return $this->redirect(['update', 'id' => $model->id]);
			}
					
			return $this->render('create', [
                'model' => $model,
            ]);
		
            
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }
	
	private function getUploadedFileName($uploadedObject){
		
		$name = '/uploads/' . $uploadedObject->baseName . '.' . $uploadedObject->extension;
		
		return $name;
	}
	
	private function upOrSave($model,$arFiles){
	
		$res = true;
		$fileObjects = [];
		if(is_array($arFiles)){
			foreach($arFiles as $fname){
				$fileObject = UploadedFile::getInstance($model, $fname);
				if(!empty($fileObject)){
					$model->setAttribute($fname, $fileObject->getPreparedName());
					$fileObjects[] = $fileObject;
				}
			}
		}
			
		if ($model->validate()) {   
			if($model->save()) {
							
				foreach($fileObjects as $fileObject){
					if(!empty($fileObject)){
						$fileObject->saveIt();
					}
				}
				
				
			}

		}
		
		return $res;
	
	}
	
	protected function fillSeourl(StructureRecord $model){
		
		if(empty($model->title)){
			$model->title = $model->label;
		}
		
		if(empty($model->seourl)){
			$model->seourl = Translit::url($model->title);
		}
	}
	

    /**
     * Updates an existing StructureRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		
        $model = $this->findModel($id);
		
        if ( $model->load(Yii::$app->request->post()) ) {
			
			$this->fillSeourl($model);
			
			if($this->upOrSave($model,['file','image'])){
				return $this->redirect(['update', 'id' => $model->id]);
			}
					
			return $this->render('update', [
                'model' => $model,
            ]);
		
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StructureRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/dashboard']);
    }

    /**
     * Finds the StructureRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StructureRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StructureRecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
