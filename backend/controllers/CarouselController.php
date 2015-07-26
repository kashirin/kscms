<?php

namespace backend\controllers;

use Yii;
use backend\models\carousel\CarouselRecord;
use backend\models\carousel\CarouselSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\filters\OnlyAdminFilter;
use backend\utilities\BaseBackendController;

/**
 * CarouselController implements the CRUD actions for CarouselRecord model.
 */
class CarouselController extends BaseBackendController
{
    public $recordClass = 'backend\models\carousel\CarouselRecord';
    public $searchClassRecord = 'backend\models\carousel\CarouselSearch';
}
