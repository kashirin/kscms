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
                                'host' => 'smtp.mastermail.ru',
                                'username' => 'admin@myoption.ru',
                                'password' => 'x73ds871',
                                'port' => '25',
                                'encryption' => 'tls',
                                ],
                
        ],
    ],
];
