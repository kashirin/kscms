<?php
namespace frontend\components\structure;

use Yii;
use yii\base\Component;

/**
 * Main Menu
 */
class MainMenuComponent extends Component
{

    protected $arMenu = [
        [
            'label'    => 'Новичкам',
            'url'      => 'novichkam',
            'type'     => 'page', // type of content
            'children' => [
                [
                'label' => 'Базовые знания',
                'url'   => 'bazovye-znanija',
                'type'  => 'page'
                ],
                [
                'label' => 'Обучение',
                'url'   => 'obuchenie',
                'type'  => 'page'
                ],
                [
                'label' => 'Полезное новичкам',
                'url'   => 'poleznoe-novichkam',
                'type'  => 'page'
                ],
                [
                'label' => 'Технический анализ',
                'url'   => 'tekhnicheskijj-analiz',
                'type'  => 'page'
                ],
                [
                'label' => 'Статьи о бинарных опционах',
                'url'   => 'stati-o-binarnykh-opcionakh',
                'type'  => 'page'
                ],

            ]
        ],

        [
            'label'    => 'Торговля',
            'url'      => 'torgovlja',
            'type'     => 'page',
            'children' => [
                [
                'label' => 'Стратегии',
                'url'   => 'strategii',
                'type'  => 'page'
                ],
                [
                'label' => 'Индикаторы',
                'url'   => 'indikatory',
                'type'  => 'page'
                ],
                [
                'label' => 'Результаты',
                'url'   => 'rezultaty',
                'type'  => 'page'
                ],
                [
                'label' => 'Календарь событий',
                'url'   => 'calendar-need-to-be-changed',
                'type'  => 'article' // as one article from
                ],
            ]
        ],

        [
            'label'    => 'Брокеры',
            'url'      => 'brokery',
            'type'     => 'page',
            'children' => [
                [
                'label' => 'Рейтинг брокеров',
                'url'   => 'brating-need-to-be-changed',
                'type'  => 'article'
                ],
                [
                'label' => 'Обзоры компаний',
                'url'   => 'obzory-kompanijj',
                'type'  => 'page'
                ],
                [
                'label' => 'Статьи о брокерах',
                'url'   => 'stati-o-brokerakh',
                'type'  => 'page'
                ],
                [
                'label' => 'Бонусы',
                'url'   => 'bonusy',
                'type'  => 'page'
                ],
            ]
        ],

        [
            'label'    => 'Инвестиции',
            'url'      => 'investicii',
            'type'     => 'page',
            'children' => [
                [
                'label' => 'ПАММ бинарных опционов',
                'url'   => 'pamm-binarnykh-opcionov',
                'type'  => 'page'
                ],
                [
                'label' => 'Заработок на событиях',
                'url'   => 'zarabotok-na-sobytijakh',
                'type'  => 'page'
                ],
                [
                'label' => 'Сигналы',
                'url'   => 'signaly',
                'type'  => 'page'
                ]
            ]
        ]

    ];


}
