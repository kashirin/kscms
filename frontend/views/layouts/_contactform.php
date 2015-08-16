<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use frontend\models\ContactForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */
?>
<div class="jqmWindow contact_form" id="contacts">
<div class="form_title">Оставить сообщение</div>
<?
if(empty($model->body)){
  $model->body = ContactForm::DEFAULT_BODY;
}
?>
            <?php $form = ActiveForm::begin(['id' => 'contact-form', 'action'=>'/contact']); ?>
                <?= $form->field($model, 'email')->textInput(['placeholder' => 'email'])->label(false)  ?>
                <div class="clear" style="height:20px"></div>
                <?= $form->field($model, 'subject')->textInput(['placeholder' => 'тема'])->label(false)  ?>
                <div class="clear" style="height:20px"></div>
                <?= $form->field($model, 'body')->textArea(['rows' => 6])->label(false)  ?>
                <div class="clear" style="height:20px"></div>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    'options' => [
                        'placeholder'=>'введите код'
                    ]
                ])->label(false)  ?>
                <div class="clear" style="height:20px"></div>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
                <div class="clear" style="height:16px"></div>
                <span class="form_hint">Чтобы закрыть форму нажмите ESC</span>
            <?php ActiveForm::end(); ?>

</div>