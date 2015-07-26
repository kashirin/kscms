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
 * SnippetController implements the CRUD actions for SnippetRecord model.
 */
class SnippetController extends BaseBackendController
{
    public $recordClass = 'backend\models\snippet\SnippetRecord';
    public $searchClassRecord = 'backend\models\snippet\SnippetSearch';
}
