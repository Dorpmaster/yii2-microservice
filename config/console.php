<?php

$db = require __DIR__.'/database.php';

$config = [
    'id'                  => 'basic-console',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'app\commands',
    'components'          => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log'   => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class' => 'yii\log\FileTarget',
                ],
            ],
        ],
        'db'    => $db,
    ],
];

return $config;
