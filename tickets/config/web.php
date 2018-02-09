<?php

$params = require(__DIR__ . '/params.php');
$params['adminEmail'] = 'tixty@tixty.co.uk';
$params['ticketFee'] = 0.50;

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'hiu3hrdif29gh8903try79rg0y4780t24769g4g-r20-',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'event/<slug>' => 'events/viewslug',
                'login' => 'site/login',
                'register' => 'user/create',
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'currencyCode' => '&pound;',
            'datetimeFormat' => 'MMM d, yyyy HH:mm',
        ]
    ],
    'sourceLanguage' => 'en-GB',
    'params' => $params,
    'modules' => [
        'account' => [
            'class' => 'app\modules\account\Module',
        ],
        'foxden' => [
            'class' => 'app\modules\foxden\Module',
        ],
    ],
//    'timeZone' => 'Europe/London',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
