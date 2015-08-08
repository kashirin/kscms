<?php
namespace frontend\components;

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

    /**
    * Method for checking for duplicates in url
    */
    protected function _urlCheckUnique(){

        $result = true;

        $arUrls = [];
        foreach ($this->arMenu as $key => $itemFirstLevel) {
            if(isset( $arUrls[$itemFirstLevel['url']] )){
                $result = false;
                break;
            }else{
                $arUrls[$itemFirstLevel['url']] = 1; // mark
            }

            if(isset($itemFirstLevel['children'])){
                foreach ($itemFirstLevel['children'] as $subkey => $itemSecondLevel) {
                    if(isset( $arUrls[$itemSecondLevel['url']] )){
                        $result = false;
                        break;
                    }else{
                        $arUrls[$itemSecondLevel['url']] = 1; // mark
                    }
                }
            }

        }

        return $result;
    }

    /**
    * This method for make difference between pages and pages in menu
    */
    public function getMenuAsTable(){

        $arUrls = [];
        foreach ($this->arMenu as $key => $itemFirstLevel) {
                
            $itemFirstLevel['parent_url'] = false;
            $arUrls[$itemFirstLevel['url']] = $itemFirstLevel;
            unset($arUrls[$itemFirstLevel['url']]['children']);

            if(isset($itemFirstLevel['children'])){
                foreach ($itemFirstLevel['children'] as $subkey => $itemSecondLevel) {
                    $itemSecondLevel['parent_url'] = $itemFirstLevel['url'];
                    $arUrls[$itemSecondLevel['url']] = $itemSecondLevel;
                }
            }

        }

        return $arUrls;
    }

    public function getMainMenu(){
        if(!$this->_urlCheckUnique()){
            throw new \Exception('Duplicates in item urls');
        }

        return $this->arMenu;
    }


    /**
    * check if page allowed (from structure record table), some kind of white list
    */
    public function checkContentPageUrl($url){
        $arPages = ['about'];
        
        return in_array($url,$arPages);
         
    }


}
