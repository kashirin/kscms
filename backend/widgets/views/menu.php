<?php
use backend\widgets\MenuWidget;
?>
<ul class="nav nav-sidebar sortable" id="left-menu">
                <li><a href="http://bootstrap-3.ru/examples/dashboard/#"><i class="fa fa-home fa-fw"></i> Главная страница</a></li>
                <li>
                    <a href="#"><i class="multilevel fa fa-folder-o fa-fw"></i> Многоуровневый список<span class="fa arrow"></span><i class="item-settings fa fa-cog fa-lg fa-fw pull-right"></i></a>
                    <ul class="sortable nav nav-second-level">
                        <li>
                            <a href="http://www.yandex.ru"><i class="fa fa-files-o fa-fw"></i> Первый пункт <i class="item-settings fa fa-cog fa-lg fa-fw pull-right"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Второй пункт</a>
                        </li>
                        <li>
                            <a href="http://www.ro.ru"><i class="multilevel fa fa-folder-o fa-fw"></i> Второй уровень <span class="fa arrow"></span></a>
                            <ul class="sortable nav nav-third-level">
                                <li>
                                    <a href="#"><i class="fa fa-files-o fa-fw"></i> Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-files-o fa-fw"></i> Очень длинное название пункта меню</a>
                                </li>
                                <li>
                                    <a href="#"><i class="multilevel fa fa-folder-o fa-fw"></i> На 4-й уровень<span class="fa arrow"></span></a>
                                    <ul class="sortable nav nav-fourth-level">
                                        <li>
                                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Парам</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Пам пам</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-files-o fa-fw"></i> Third Level Item</a>
                                </li>
                            </ul>
                            <!-- /.nav-third-level -->
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li><a href="http://bootstrap-3.ru/examples/dashboard/#"><i class="fa fa-files-o fa-fw"></i> Analytics</a></li>
                <li><a href="http://bootstrap-3.ru/examples/dashboard/#"><i class="fa fa-files-o fa-fw"></i> Export</a></li>
                <li class="ghost"><a href="http://bootstrap-3.ru/examples/dashboard/#"><i class="fa fa-plus-square fa-fw"></i> Добавить элемент</a></li>
</ul>

