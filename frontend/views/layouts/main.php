<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

use backend\models\carousel\CarouselRecord;
use frontend\widgets\CarouselWidget;
use frontend\widgets\EventsWidget;
use frontend\widgets\TopbrokersWidget;
use frontend\widgets\TopnewsWidget;

use backend\models\snippet\SnippetRecord;
use frontend\widgets\snippet\SnippetWidget;
use frontend\widgets\MainMenuWidget;

use frontend\models\ContactForm;

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
    <meta name='yandex-verification' content='55f88d48cafe60cc' />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" media="all" href="css/template.css" />
    <link rel="stylesheet" type="text/css" media="screen and (max-width: 1220px)" href="css/template1000.css" />
    <?php $this->head() ?>
    <script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script>
</head>
<body>
    <?php $this->beginBody() ?>


    <?= $this->render('_contactform', [
        'model' => new ContactForm
    ]) ?>

    <div class="wrap">
        <div id="left">
            <div class="header">
                <a href="/"><img src="images/logo.jpg" alt="logo"></a>
            </div>
             <?=EventsWidget::widget()?>
            <!-- events -->
            <div class="clear"></div>
        
            <!-- topbrokers -->
            <?=TopbrokersWidget::widget()?>
            <div class="clear" style="height:28px;"></div>
            
            <!-- советуем -->
            <div class="left_caption blue"><span><img src="images/ico_rupor.png"></span><span>Советуем</span></div>
            <div id="help_items">
                <a href="/Torgovlja-po-novostjam-na-binarnyh-opcionah" class="left_caption"><span><img src="images/ico_doc.png"></span><span class="help_items_title">Торговля по новостям</span></a>
                <a href="/Kak-prosto-i-jeffektivno-investirovat-v-binarnye-opciony" class="left_caption"><span><img src="images/ico_money.png"></span><span class="help_items_title">Простые инвестиции</span></a>
                <a href="/Kak-pravilno-vybirat-brokera-dlja-torgovli-binarnymi-opcionami" class="left_caption"><span><img src="images/ico_money2.png"></span><span class="help_items_title">Как выбрать брокера</span></a>
                <a href="/Platforma-s-demo-schetom-na-rynke-binarnyh-opcionov" class="left_caption"><span><img src="images/ico_impuls.png"></span><span class="help_items_title">Демо счет</span></a>
                <a href="/Binarnye-opciony-s-depozitom-v-rubljah" class="left_caption"><span><img src="images/ico_rub.png"></span><span class="help_items_title">Бинарные опционыв рублях</span></a>
                <a href="/Pomoshh-dlja-trejderov-rynka-binarnyh-opcionov" class="left_caption"><span><img src="images/ico_message.png"></span><span class="help_items_title">Бесплатная помощь</span></a>
            </div>
            <div class="clear" style="height:36px;"></div>
            <!-- конец советуем -->
            
            <!-- topnews -->
            <?=TopnewsWidget::widget()?>
            <div class="clear" style="height:20px;"></div>
            
            <!-- примеры зароботка -->
            <div class="left_caption"><span ><img src="images/ico_example.png"></span><span>Примеры Заработка</span></div>
            <div id="example_items">
                <a href="/Rezultaty-torgovli-binarnymi-opcionami-v-2015-godu">Результаты торговли бинарными опционами в 2015 году</a>
            </div>
            <div class="clear" style="height:250px;"></div>
            <!-- конец примеры зароботка -->

            <div id="left_footer">Предупреждение о риске: © 2015 
                MYOPTION не несет никакой
                ответственности за утрату ваших денег
                в результате того, что вы положились на
                информацию, содержащуюся на этом
                сайте, включая данные, котировки,
                графики и сигналы форекс. Торговля на финансовых рынках связна с высоким уровнем риска. Все материалы сайта носят лишь информационный характер и отражают мнение автора. Сайт не несет ответственности за возможные потери трейдеров, воспользовавшихся любыми данными (информацией, сигналами и т.д.), размещенными на сайте myoption.ru.
            </div>
        </div>
        <div id="right">

            <div class="header">
                <form id="search_form" method="get" action="/search">
                    <div><input type="text" id="search_text" name="q" placeholder="Поиск по сайту"></div>
                    <input type="image" id="search_btn" src="images/search.jpg" name="view" value="view">
                </form>
            </div>
            
            <div class="clear"></div>
            
            <div id="heder_right">
                <div class="clear" style="height:25px;"></div>
                <!--menu-->
                <?=MainMenuWidget::widget([
                    'items' => Yii::$app->mainMenu->getMainMenu()
                ])?>
                <!-- menu end -->

            </div>  
            <div class="clear"></div>

            <?= Alert::widget() ?>
            
            <!-- carousel -->
            <?=CarouselWidget::widget([
                'items' => CarouselRecord::find()
                            ->where(['active'=>CarouselRecord::$STATUS_IS_ACTIVE, 'parent_id'=>22 /* from carousel branch */ ])
                            ->orderBy(['sort' => SORT_ASC])
                            ->all()
            ])?>
            <!-- content area -->
            
            
            <?= $content ?>  
            
            <!-- end of content area -->
            
            <div class="clear" style="height:100px;"></div>
            
            <div id="footer">
                <div id="footer_menu_body">
                    <ul id="footer_menu">
                        <li><a href="#" class="contacts_btn">Контакты</a></li>
                        <li><a href="<?=Url::to(['/o-sajte'])?>">О сайте</a></li>
                        <li><a href="<?=Url::to(['/sitemap'])?>">Все статьи</a></li>
                    </ul>
                </div>
                <noindex>
                <div id="social">
                    <a href="https://www.youtube.com/channel/UCFJWJB2pkMcWNVXXT9rbMSw" rel="nofollow" target="_blank"></a>
                    <a href="https://www.facebook.com/profile.php?id=100010245996647" rel="nofollow" target="_blank" id="social2"></a>
                    <a href="https://twitter.com/MyOptionRU" rel="nofollow" target="_blank" id="social3"></a>
                    <a href="https://vk.com/public100925821" rel="nofollow" target="_blank" id="social4"></a>
                    <!--<a href="#" rel="nofollow" target="_blank" id="social5"></a>
                    <a href="#" rel="nofollow" target="_blank" id="social6"></a>-->
                </div>
               </noindex>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <?php $this->endBody() ?>
<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=32196494&amp;from=informer"
target="_blank" rel="nofollow"><img src="//informer.yandex.ru/informer/32196494/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0; display: none;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:32196494,lang:'ru'});return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
(w[c] = w[c] || []).push(function() {
try {
w.yaCounter32196494 = new Ya.Metrika({id:32196494,
webvisor:true,
clickmap:true,
trackLinks:true,
accurateTrackBounce:true});
} catch(e) { }
});

var n = d.getElementsByTagName("script")[0],
s = d.createElement("script"),
f = function () { n.parentNode.insertBefore(s, n); };
s.type = "text/javascript";
s.async = true;
s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

if (w.opera == "[object Opera]") {
d.addEventListener("DOMContentLoaded", f, false);
} else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/32196494" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
<?php $this->endPage() ?>
