<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
        'comment' => [
            'class' => 'frontend\modules\comment\Module',
        ],
    ],
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mainMenu' => [
            'class' => 'frontend\components\MainMenuComponent'
        ],
        'breadcrumbs' => [
            'class' => 'frontend\components\BreadcrumbsComponent'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>[
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                'error' => 'site/error',
                'page404' => 'site/page404',
                'abrakadabra' => 'site/abrakadabra',
                'contact' => 'site/contact',
                'search' => 'search/index',
                'sitemap' => 'sitemap/index',
                'dl/<code:[\w-]+>' => 'file/index',
                '<seourl:[\w-\(\)]+>' => 'site/index',
            ],
        ],
    ],
    'params' => $params,
];
