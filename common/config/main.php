<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport'=>false,
             'transport' => [
                                'class' => 'Swift_SmtpTransport',
                                'host' => 'smtp.rambler.ru',
                                'username' => 'kasser2005@rambler.ru',
                                'password' => 'kascangel',
                                'port' => '465',
                                'encryption' => 'ssl',
                                ],
        ],
    ],
];
