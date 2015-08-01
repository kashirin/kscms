<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

use backend\models\snippet\SnippetRecord;
use frontend\widgets\snippet\SnippetWidget;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

SnippetWidget::widget([
        'snippets' => SnippetRecord::find()->select('code, description')->all()
]);



?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru-RU<?/*=Yii::$app->language*/ ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" media="all" href="css/template.css" />
    <link rel="stylesheet" type="text/css" media="screen and (max-width: 1220px)" href="css/template1000.css" />
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    
            <!-- content area -->
            
            <?= $content ?>  
            
            
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
