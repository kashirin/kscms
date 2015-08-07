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
 * FileController implements the CRUD actions for SnippetRecord model.
 */
class FileController extends BaseBackendController
{
    public $recordClass = 'backend\models\file\FileRecord';
    public $searchClassRecord = 'backend\models\file\FileSearch';
}