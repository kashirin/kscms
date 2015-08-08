<?php
/* @var $this yii\web\View */

use frontend\widgets\EventsWidget;
use backend\models\structure\StructureRecord;

$this->title = 'myoption.ru - Главная страница';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Описание'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Ключевые'
]);
?>

<div class="padding37">
                <div class="tabs">
                    <a href="#" data_id="tab1" class="tab1 active">Календарь событий</a>
                    <a href="#" data_id="tab2" class="tab2">Бинарные опционы</a>
                </div>
                <div class="tabs_body">
                <div class="clear"></div>
                    <div class="tab1_body tab_body">
                        <?=EventsWidget::widget(['mode'=>'all'])?>               
                        <div class="clear" style="height:18px;"></div>
                        <!-- buttons -->
                        <a href="/zarabotok-na-sobytijakh" class="btn_red">Как заработать на событии</a>
                        <a href="#" class="btn_red" style="margin-left:20px;">Кнопка 1</a>
                        <a href="#" class="btn_red" style="margin-left:20px;">Кнопка 2</a>
                        <!-- end buttons -->
                    </div>
                    <div class="tab2_body tab_body">
                        <?php
                        $binpage = StructureRecord::find()->where(['code'=>'content_bin'])->one();
                        if($binpage){
                            echo $binpage->content;
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            <?php
            /*
            <h1 class="caption blue"><span>Торговая стратегия бинарных опционов 60 секунд (h1)</span></h1>
            <div class="padding37">
                <div id="breadcrumbs">
                    <a href="#">Главная</a> / 
                    <a href="#">Стратегии</a> /
                    <span>Торговая стратегия бинарных опционов 60 секунд</span>
                </div>
                <p>Стратегия, о которой пойдет речь ниже, является моей собственной разработкой. Ранее правила работы по данной методике
                    неоднократно публиковались на сторонних сайтах, посвященных Forex или <a href="#">бинарным опционам</a>. Теперь полное описание стратегии 60 секунд
                    доступно читателям моего блога.</p>
                <p>Считаю необходимым для начала рассказать, на чем именно основан метод торговли, что бы было полное понимание всего метода, а не
                    бессмысленное заучивание правил. Потом Вы найдете примеры и объяснения, как следует действовать на рынке
                </p>
                <h2>Торговая стратегия бинарных опционов 60 секунд (h2)</h2>
                <h3>Торговая стратегия бинарных опционов 60 секунд (h3)</h3>
                <h4>Торговая стратегия бинарных опционов 60 секунд (h4)</h4>
                <h5>Торговая стратегия бинарных опционов 60 секунд (h5-h6)</h5>
                <div class="arrow_blue">
                    <p>На рынке спокойное движение цены (пусть и не боковое, но относительно плавное);</p>
                    <p>Рыночная цена резко принимает значение, удаленное от общей тенденции на несколько пунктов;</p>
                    <p>Отсутствие новостей в данный момент (период).</p>
                </div>
                <div class="clear" style="height:20px;"></div>
                <div class="gray_block">
                    « Считаю необходимым для начала рассказать, на чем именно
                    основан метод торговли, что бы было полное понимание
                    всего метода, а не бессмысленное
                    заучивание правил »                 
                </div>
                <div class="soc"><img src="images/soc.jpg"></div>
                <div id="caption_comment"><span>Комментарии</span></div>
                <div id="comments" class="padding37">
                    <div class="comment">
                        <div class="left"><img src="images/no_face.jpg"></div>
                        <div class="right">
                            <div class="comment_name">Наталья</div><div class="clear"></div>                            
                            Надеюсь, Вам понравятся результаты от торговли по моей стратегии бинарных опционов 60 секунд.
                            Потребуется некоторое время, что бы приноровиться ловить моменты отскока рыночной цены
                        </div>
                    </div>
                    <div class="clear" style="height:28px"></div>
                    <div class="comment">
                        <div class="left"><img src="images/no_face.jpg"></div>
                        <div class="right">
                            <div class="comment_name">Наталья</div><div class="clear"></div>                            
                            Надеюсь, Вам понравятся результаты от торговли по моей стратегии бинарных опционов 60 секунд.
                            Потребуется некоторое время, что бы приноровиться ловить моменты отскока рыночной цены
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>      
                    <div class="clear" style="height:28px"></div>
                    <form method="post" id="add_comment">
                        <div id="add_comment_title">Оставить сообщение</div>
                        <div class="clear" style="height:28px"></div>
                        <input type="text" name="name" placeholder="имя">
                        <div class="clear" style="height:18px"></div>
                        <textarea>сообщение</textarea>
                        <div class="clear" style="height:22px"></div>
                        <input type="submit" value="Отправить">
                    </form>
                    
                
                
            </div>
            */
            ?>
            
            <div class="caption blue"><span>Обзоры событий на бинарных опционах</span></div>   
            <div class="items">
                <a href="#"><img src="images/b8.jpg"><span>Законы технического анализа Джона Мерфи</span></a>
                <a href="#"><img src="images/b8.jpg"><span class="arrow_rigth"></span><span>Законы технического анализа Джона Мерфи</span></a>
                <a href="#"><img src="images/b8.jpg"><span>Законы технического анализа Джона Мерфи</span></a>
            </div>  
                <div class="clear line_gray"></div>
            <div class="items">             
                <a href="#"><img src="images/b8.jpg"><span>Законы технического анализа Джона Мерфи</span></a>
                <a href="#"><img src="images/b8.jpg"><span class="arrow_rigth"></span><span>Законы технического анализа Джона Мерфи</span></a>
                <a href="#"><img src="images/b8.jpg"><span>Законы технического анализа Джона Мерфи</span></a>
            </div>
            <div class="clear"></div>
            
            <div class="caption red"><span>Заработок на инвестициях</span></div>    
            <div class="items">
                <a href="#"><img src="images/b8.jpg"><span>Законы технического анализа Джона Мерфи</span></a>
                <a href="#"><img src="images/b8.jpg"><span class="arrow_rigth"></span><span>Законы технического анализа Джона Мерфи</span></a>
                <a href="#"><img src="images/b8.jpg"><span>Законы технического анализа Джона Мерфи</span></a>
            </div>
