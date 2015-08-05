<?php
use yii\captcha\Captcha;
use yii\helpers\Url;
?>

<div id="caption_comment"><span>Комментарии</span></div>
				<?if(count($models)){?>
				<? $cnt = count($models); ?>
				<div id="comments" class="padding37">
					<? foreach($models as $k => $model){?>
					<div class="comment">
						<div class="left"><img src="images/no_face.jpg"></div>
						<div class="right">
							<div class="comment_name"><?=$model->user_name?></div><div class="clear"></div>							
							<?=$model->text?>
						</div>
					</div>
					<div class="clear" <? if($k!==($cnt-1)){?> style="height:28px"<? } ?>></div>
					<?}?>
				</div>	
				<?}?>
					<div class="clear" style="height:28px"></div>
					<form method="post" id="add_comment" action="/comment/default/create">
						<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>">
						<input type="hidden" name="parent_id" value="<?=$parent_id?>">
						<input type="hidden" name="type" value="<?=$type?>">
						<input type="hidden" name="back_url" value="<?=Url::current()?>">
						<div id="add_comment_title">Оставить сообщение</div>
						<div class="clear" style="height:28px"></div>
						<input type="text" name="user_name" placeholder="имя">
						<div class="clear" style="height:18px"></div>
						<textarea name="text">сообщение</textarea>
						<div class="clear" style="height:22px"></div>
						<?=Captcha::widget([
    						'name' => 'captcha',
    						'template' => '{image}<div class="clear" style="height:28px"></div>{input}',
    						'options' => [
    							'placeholder'=>'введите код'
    						],
						]);?>
						<div class="clear" style="height:22px"></div>
						<input type="submit" value="Отправить">
					</form>