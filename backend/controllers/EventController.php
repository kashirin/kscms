<?php

namespace backend\controllers;

use Yii;
use backend\models\event\EventRecord;
use backend\models\event\EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\filters\OnlyAdminFilter;
use backend\utilities\BaseBackendController;

/**
 * EventController implements the CRUD actions for EventRecord model.
 */
class EventController extends BaseBackendController
{
    public $recordClass = 'backend\models\event\EventRecord';
    public $searchClassRecord = 'backend\models\event\EventSearch';
}