<?php

$db = require __DIR__.'/database.php';
$keys = require __DIR__.'/keys.php';

return [
    'id'         => 'yii2-microservice',
    'basePath'   => dirname(__DIR__),
    'bootstrap'  => ['log'],
    'modules'    => [
        'v1' => [
            'class' => 'app\modules\v1\Module',
        ],
    ],
    'components' => [
        'request'      => [
            'enableCsrfCookie' => false,
            'parsers'          => [
                'application/vnd.api+json' => 'tuyakhov\jsonapi\JsonApiParser',
            ],
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                'file' => [
                    'class' => 'yii\log\FileTarget',
                ],
            ],
        ],
        'urlManager'   => [
            'enablePrettyUrl'     => true,
            'enableStrictParsing' => true,
            'showScriptName'      => false,
            'rules'               => [
                [
                    'class'         => 'yii\rest\UrlRule',
                    'controller'    => 'v1/user',
                    'extraPatterns' => [
                        'POST token'    => 'token',
                        'OPTIONS token' => 'options',
                    ],
                ],
            ],
        ],
        'user'         => [
            'identityClass' => 'app\common\models\UserModel',
            'enableSession' => false,
        ],
        'db'           => $db,
        'jwt'          => [
            'class'          => 'app\common\components\Jwt',
            'privateKeyFile' => $keys['privateKeyFile'],
            'publicKeyFile'  => $keys['publicKeyFile'],
        ],
        'response'     => [
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class'         => 'tuyakhov\jsonapi\JsonApiResponseFormatter',
                    'prettyPrint'   => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'errorHandler' => [
            'class' => 'app\common\components\ErrorHandler',
        ],
    ],
];