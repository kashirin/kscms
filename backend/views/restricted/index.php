<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
?>

<p>
    Доступ только для админа<br>
	<?php if(Yii::$app->user->isGuest){ ?>
	<?=Html::a('Login', ['module/user/security/login'])?>
	<?php } ?>
</p>
