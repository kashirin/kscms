<?php

namespace backend\controllers;

use Yii;
use backend\models\banner\BannerRecord;
use backend\models\banner\BannerSearch;
use backend\utilities\BaseBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BannerController implements the CRUD actions for BannerRecord model.
 */
class BannerController extends BaseBackendController
{
    public $recordClass = 'backend\models\banner\BannerRecord';
    public $searchClassRecord = 'backend\models\banner\BannerSearch';
}
