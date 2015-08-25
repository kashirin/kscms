<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log','GlobalBeforeComponent'],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin','Alexander'],
			'layout'=>'wide',
			'as backendFIlter' => 'backend\filters\BackendFilter',
        ],
        'ksconfig' => [
            'class' => 'kasser\ksconfig\Module',
            //'as backendFIlter' => 'backend\filters\BackendFilter',
        ],
    ],
    'components' => [
        'GlobalBeforeComponent'=>[
            'class'=>'backend\utilities\GlobalBeforeComponent'
        ],
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
		'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>[
                '<alias:dashboard|cp>' => 'site/<alias>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
				
				'<controller:\w+>/type/<type:[\w-]+>/list-for/<parent_id:\d+>' => '<controller>/index',//for comments
				'<controller:\w+>/list-for/<parent_id:\d+>' => '<controller>/index',
                
				'<controller:\w+>/<action:[\w-]+>/type/<type:[\w-]+>/in-list/<parent_id:\d+>' => '<controller>/<action>', //comments
                '<controller:\w+>/<action:[\w-]+>/in-list/<parent_id:\d+>' => '<controller>/<action>',

				
                
                '<controller:\w+>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:[\w-]+>' => '<controller>/<action>',
                'module/<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ],
        ],
        'treeMenu' => [
            'class' => 'backend\components\structure\TreeMenu'
        ],
		
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user',
					'@dektrium/user/views/layouts' => '@app/views/layouts'
                ],
            ],
        ],
    ],
    'layout' => 'admin',
    'params' => $params
];
