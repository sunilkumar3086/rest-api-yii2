<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'formatter' => [
            'defaultTimeZone' => 'Asia/Kolkata',
        ],
        'dataCache' => [
            'class' => 'yii\caching\ApcCache',
        ],
        /*'cache' => [
            'class' => 'yii\caching\ApcCache',
        ],

        'pageCache' => [
            'class' => 'yii\caching\FileCache',
        ],*/
    ],
];
