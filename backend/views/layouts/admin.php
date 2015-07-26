<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\widgets\MenuWidget;
use backend\widgets\TreeMenuWidget;
use yii\helpers\Url;


/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
<style id="holderjs-style" type="text/css"></style></head>
<body>
<?php $this->beginBody() ?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Панель администрирования сайта</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
				<li><a href="<?=Url::to(['/user/settings/profile'])?>"><i class="fa fa-user fa-fw"></i> <?=Yii::$app->user->identity->profile->name?></a></li>
                <li><a href="#"><i class="fa fa-cogs fa-fw"></i> Настройки</a></li>
                <li id="logout-link"><a data-method="post" href="<?=Url::to(['/user/security/logout'])?>"><i class="fa fa-sign-out fa-fw"></i> Выход</a></li>
            </ul>
            <!--<form class="navbar-form navbar-right">
              <input type="text" class="form-control" placeholder="Search...">
            </form>-->
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        
        <div class="col-sm-3 sidebar">
			<?//=MenuWidget::widget()?>
            <?php
            echo TreeMenuWidget::widget(YII::$app->treeMenu->getItems());
            ?>
        </div>
        
        <div class="col-sm-9 col-sm-offset-3 main">
			<?if ($msg = Yii::$app->session->getFlash('message')) {?>
			<div class="top-light-buffer"></div>
			<div class="alert alert-warning" role="alert">
			<?= $msg; ?>
			</div>
			<?}?>
			
            
            <!-- breadcrubs-->
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>
            <!-- end breadcrubs -->
            
            <div class="top-light-buffer"></div>
			<!-- content block -->
			<?=$content;?>
			<!-- //content block -->
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
