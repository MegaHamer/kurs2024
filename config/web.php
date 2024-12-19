<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'name' => 'computer_shop',
    'language' => 'ru',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Artem',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                // 'multipart/form-data' => 'yii\web\MultipartFormDataParser'
            ]
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
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            // 'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                // 'POST register'=>'user/create',
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'user',
                    // 'patterns' => [
                    //     '' => '',
                    // ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>', //commenting out this token allows login to return
                        // '{type}' => '<type:\\w+>'
                    ],
                    'patterns' => [
                        'POST register' => 'create',
                        'POST login' => 'login',
                        'GET' => 'view',
                        'GET profile' => 'profile',
                        'GET {id}' => 'viewbyid',
                        'PUT' => 'change'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'cart',
                    'pluralize'=>false,
                    "prefix" => "users",
                    'tokens' => [
                        '{id}' => '<id:\\d+>', //commenting out this token allows login to return
                        // '{type}' => '<type:\\w+>'
                    ],
                    'patterns' => [

                        'POST' => 'create',
                        'DELETE {id}' => 'delete',
                        'DELETE' => 'delete',
                        'PUT' => 'update',
                        'PUT {id}' => 'update',
                        'GET' => 'view',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['whishlist'=>'whish-list'],
                    'pluralize'=>false,
                    "prefix" => "users",
                    'tokens' => [
                        '{id}' => '<id:\\d+>', //commenting out this token allows login to return
                        // '{type}' => '<type:\\w+>'
                    ],
                    'patterns' => [
                        'POST' => 'create',
                        'GET' => 'view',
                        'DELETE' => 'delete',
                        'DELETE {id}' => 'delete',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['orders' => 'list-order'],
                    'pluralize'=>false,
                    "prefix" => "users",
                    'tokens' => [
                        '{id}' => '<id:\\d+>', //commenting out this token allows login to return
                        // '{type}' => '<type:\\w+>'
                    ],
                    'patterns' => [

                        'POST' => 'create',
                        'GET' => 'view',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'catalog',
                    'pluralize'=>false,
                    'tokens' => [
                        // '{id}' => '<id:\\d+>', //commenting out this token allows login to return
                        '{type}' => '<type:[a-zA-Z_]+>'
                    ],
                    'patterns' => [

                        'GET' => 'index',
                        'GET {type}' => 'view',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'product',
                    'pluralize'=>false,
                    'tokens' => [
                        '{id}' => '<id:\\d+>', //commenting out this token allows login to return
                        '{type}' => '<type:[a-zA-Z_]+>'
                    ],
                    'patterns' => [
                        // 'GET' => 'index',
                        'GET {id}' => 'view',
                        'POST {type}' => 'create',
                        'DELETE {id}' => 'delete',
                        'PUT {id}' => 'update',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['test' => 'user'],
                    'only' => ['test'],
                    'patterns' => [
                        '' => 'test'
                    ],
                    'extraPatterns' => [
                        'POST testi' => 'test'
                    ],
                    // 'pluralize'=>false,
                ],
                "POST register" => 'user/test',
            ],
        ],
        'requestput' => [
            'class' => 'app\components\RequestPutComponent',
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null && $response->statusCode == 401) {
                    $response->data = [
                        'message' => 'Authorization error'
                    ];
                    header('Access-Control-Allow-Origin: *');
                    header('Content-Type: application/json');
                }
            },
        ],


    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];
}

return $config;
