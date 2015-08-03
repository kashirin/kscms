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
             /*'transport' => [
                                'class' => 'Swift_SmtpTransport',
                                'host' => 'ssl://smtp.gmail.com',
                                'username' => 'kasser2005@gmail.com',
                                'password' => '0xmpfwtq',
                                'port' => '587',
                                'encryption' => 'tls',
                                ],*/
                'transport' => [
                    'class' => 'Swift_MailTransport'
                ]
        ],
    ],
];
