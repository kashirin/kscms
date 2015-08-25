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
            'url'      => 'Novichkam-rynka-binarnyh-opcionov',
            'type'     => 'page', // type of content
            'children' => [
                [
                'label' => 'Базовые знания',
                'url'   => 'Bazovye-znanija-dlja-trejderov',
                'type'  => 'page'
                ],
                [
                'label' => 'Обучение',
                'url'   => 'Obuchenie-torgovle',
                'type'  => 'page'
                ],
                [
                'label' => 'Полезное новичкам',
                'url'   => 'Poleznye-obzory-dlja-novichkov',
                'type'  => 'page'
                ],
                [
                'label' => 'Технический анализ',
                'url'   => 'Tehnicheskij-analiz-na-rynke-binarnyh-opcionov',
                'type'  => 'page'
                ],
                [
                'label' => 'Статьи о бинарных опционах',
                'url'   => 'Stati-o-binarnyh-opcionah',
                'type'  => 'page'
                ],

            ]
        ],

        [
            'label'    => 'Торговля',
            'url'      => 'Torgovlja-binarnymi-opcionami',
            'type'     => 'page',
            'children' => [
                [
                'label' => 'Стратегии',
                'url'   => 'Strategii-na-binarnyh-opcionah',
                'type'  => 'page'
                ],
                [
                'label' => 'Индикаторы',
                'url'   => 'Indikatory-na-rynke-binarnyh-opcionov',
                'type'  => 'page'
                ],
                [
                'label' => 'Результаты',
                'url'   => 'Rezultaty-torgovli-na-rynke',
                'type'  => 'page'
                ],
                [
                'label' => 'Календарь событий',
                'url'   => 'Jekonomicheskij-kalendar-s-obnovleniem-dannyh-v-realnom-vremeni',
                'type'  => 'article' // as one article from
                ],
            ]
        ],

        [
            'label'    => 'Брокеры',
            'url'      => 'Brokery-binarnyh-opcionov',
            'type'     => 'page',
            'children' => [
                [
                'label' => 'Рейтинг брокеров',
                'url'   => 'Rejting-brokerov-binarnyh-opcionov',
                'type'  => 'article'
                ],
                [
                'label' => 'Обзоры компаний',
                'url'   => 'Obzory-brokerov-binarnyh-opcionov',
                'type'  => 'page'
                ],
                [
                'label' => 'Статьи о брокерах',
                'url'   => 'Stati-o-brokerah',
                'type'  => 'page'
                ],
                [
                'label' => 'Бонусы',
                'url'   => 'Bonusy-brokerov-binarnyh-opcionov',
                'type'  => 'page'
                ],
            ]
        ],

        [
            'label'    => 'Инвестиции',
            'url'      => 'Ob-investicijah-na-rynke-binarnyh-opcionov',
            'type'     => 'page',
            'children' => [
                [
                'label' => 'ПАММ бинарных опционов',
                'url'   => 'PAMM-scheta-na-binarnyh-opcionah',
                'type'  => 'page'
                ],
                [
                'label' => 'Заработок на событиях',
                'url'   => 'Zarabotok-na-sobytijah',
                'type'  => 'page'
                ],
                [
                'label' => 'Сигналы',
                'url'   => 'Signaly-binarnyh-opcionov',
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
    * check if page allowed (from structure record table), some kind of black list
    */
    public function checkContentPageCode($code){
        $arPages = ['content_bin'];

        return !in_array($code,$arPages);
         
    }


}
