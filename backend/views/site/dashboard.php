<?php

use yii\helpers\Html;

$this->title = 'KSCMS - Панель администрирования';
?>

            <!-- Single button -->
            <!--
            <div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bars fa-fw"></i> Меню <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#"><i class="fa fa-external-link fa-fw"></i> К тегам</a></li>
                    <li><a href="#"><i class="fa fa-external-link fa-fw"></i> К разделам</a></li>
                </ul>
            </div>
            -->



            


            <div class="row sections-pannel top-buffer">

            <div class="col-lg-3 dashboard-tile">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-home fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><a href="/">. . .</a></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>

                
            
                <?php foreach ($menu_items as $key => $item) {?>
                <?if($item->is_dir==1){?>
                <div class="col-lg-3 dashboard-tile">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-folder-open fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!--<div class="huge">10</div>-->
                                    <div><?=Html::a($item->label,['/site/dashboard', 'parent_id'=>$item->id])?></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?}else{?>
                <div class="col-lg-3 dashboard-tile">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-files-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!--<div class="huge">10</div>-->
                                    <?
                                    $res = $item->url;

                                    if((string)$item->params!=''){
                                        parse_str($item->params,$arParams);
                                        $res = array_merge([$item->url], $arParams);
                                    }
                                    ?>
                                    <div><?=Html::a($item->label,$res)?></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?}?>

                <?}?>
             

            <!--<div class="btn-group">
                <button type="button" class="btn btn-success" aria-expanded="false">
                    <i class="fa fa-save fa-fw"></i> Сохранить
                </button>
                <button type="button" class="btn btn-success left-space" aria-expanded="false">
                    <i class="fa fa-check fa-fw"></i> Применить
                </button>
                <button type="button" class="btn btn-danger left-space" aria-expanded="false">
                    <i class="fa fa-reply fa-fw"></i> Отменить
                </button>
            </div>-->
