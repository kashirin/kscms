<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

use backend\models\snippet\SnippetRecord;
use frontend\widgets\snippet\SnippetWidget;
use frontend\widgets\MainMenuWidget;

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

    <div class="wrap">
        <div id="left">
            <div class="header">
                <a href="#"><img src="images/logo.jpg" alt="logo"></a>
            </div>
            <a href="#" id="coming_events" class="open left_caption"><span ><img src="images/ico_calendar.png"></span><span>Ближайшие События</span></a>
            <div id="coming_events_list">
                <div class="coming_event coming_event2">
                    <span class="coming_event_title event_header">Актив</span>
                    <span class="coming_event_date event_header">Дата (Мскв.)</span>
                </div>
                <div class="coming_event">
                    <span class="coming_event_title">Газпром</span>
                    <span class="coming_event_date">14:00  3.09.2015 г.</span>
                </div>
                <div class="coming_event coming_event2">
                    <span class="coming_event_title">Газпром<br>Другое название</span>
                    <span class="coming_event_date">14:00  3.09.2015 г.</span>
                </div>  
                <div class="coming_event">
                    <span class="coming_event_title">Газпром</span>
                    <span class="coming_event_date">14:00  3.09.2015 г.</span>
                </div>
            </div>
            <div class="clear"></div>
            <div class="left_caption"><span ><img src="images/ico_star.png"></span><span>Популярные Брокеры</span></div>
            <div id="popular">
                <a href="#"><div class="new"></div><img src="images/b1.jpg"></a>
                <a href="#"><div class="new"></div><img src="images/b2.jpg"></a>
                <a href="#"><div class="new"></div><img src="images/b3.jpg"></a>
                <a href="#"><div class="new"></div><img src="images/b4.jpg"></a>
            </div>
            <div class="clear" style="height:40px;"></div>
            <div class="left_caption red"><span ><img src="images/ico_file.png"></span><span>Новое на Сайте</span></div>
            <div class="new_items">
                <a href="#"><img src="images/b7.jpg"><span class="arrow_rigth"></span>
                    <div class="clear" style="height:5px;"></div>
                    <span>Основа прибыльной торговли<br>
                          бинарными опционами</span>
                </a>
                <a href="#"><img src="images/b5.jpg">
                    <div class="clear" style="height:5px;"></div>
                    <span>Основа прибыльной торговли<br>
                          бинарными опционами</span>
                </a>    
                <a href="#"><img src="images/b6.jpg">
                    <div class="clear" style="height:5px;"></div>
                    <span>Основа прибыльной торговли<br>
                          бинарными опционами</span>
                </a>    
            </div>      
            <div class="clear" style="height:36px;"></div>
            <div class="left_caption blue"><span><img src="images/ico_rupor.png"></span><span>Советуем</span></div>
            <div id="help_items">
                <a href="#" class="left_caption"><span><img src="images/ico_doc.png"></span><span class="help_items_title">Торговля по новостям</span></a>
                <a href="#" class="left_caption"><span><img src="images/ico_money.png"></span><span class="help_items_title">Простые инвестиции</span></a>
                <a href="#" class="left_caption"><span><img src="images/ico_money2.png"></span><span class="help_items_title">Как выбрать брокера</span></a>
                <a href="#" class="left_caption"><span><img src="images/ico_impuls.png"></span><span class="help_items_title">Демо счет</span></a>
                <a href="#" class="left_caption"><span><img src="images/ico_rub.png"></span><span class="help_items_title">Бинарные опционыв рублях</span></a>
                <a href="#" class="left_caption"><span><img src="images/ico_message.png"></span><span class="help_items_title">Бесплатная помощь</span></a>
            </div>
            <div class="clear" style="height:20px;"></div>
            <div class="left_caption"><span ><img src="images/ico_example.png"></span><span>Примеры Заработка</span></div>
            <div id="example_items">
                <a href="#">Памм-счета Alpari – по алгоритму из курса Памм-инвестор</a>
                <a href="#">Памм-счета Alpari – по алгоритму из курса Памм-инвестор</a> 
                <a href="#">Памм-счета Alpari – по алгоритму из курса Памм-инвестор</a> 
                <a href="#">Памм-счета Alpari – по алгоритму из курса Памм-инвестор</a> 
            </div>
            <div class="clear" style="height:200px;"></div>
            <div id="left_footer">Предупреждение о риске: © 2015 
                MYOPTION не несет никакой
                ответственности за утрату ваших денег
                в результате того, что вы положились на
                информацию, содержащуюся на этом
                сайте, включая данные, котировки,
                графики и сигналы форекс
            </div>
        </div>
        <div id="right">

            <div class="header">
                <form id="search_form" method="post">
                    <div><input type="text" id="search_text" name="search" placeholder="Поиск по сайту"></div>
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
            <div id="banner">
                <img src="images/banner.jpg">
            </div>
            <!-- content area -->
            
            
            <?= $content ?>  
            
            <!-- end of content area -->
            <div class="clear" style="height:100px;"></div>
            <div id="footer">
                <div id="footer_menu_body">
                    <ul id="footer_menu">
                        <li><a href="<?=Url::to(['/contacts'])?>">Контакты</a></li>
                        <li><a href="<?=Url::to(['/about'])?>">О сайте</a></li>
                        <li><a href="<?=Url::to(['/sitemap'])?>">Все статьи</a></li>
                    </ul>
                </div>
                <noindex>
                <div id="social">
                    <a href="#" rel="nofollow" target="_blank"></a>
                    <a href="#" rel="nofollow" target="_blank" id="social2"></a>
                    <a href="#" rel="nofollow" target="_blank" id="social3"></a>
                    <a href="#" rel="nofollow" target="_blank" id="social4"></a>
                    <a href="#" rel="nofollow" target="_blank" id="social5"></a>
                    <a href="#" rel="nofollow" target="_blank" id="social6"></a>
                </div>
               </noindex>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
