<?php
return [
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],


        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                 //   'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app'       => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],
    'controllerMap' => [
        'migration' => [
            'class' => 'tmukherjee13\migration\console\controllers\MigrationController',
            'templateFile' => '@tmukherjee13/migration/views/template.php',
        ],
    ],
    'modules' => [
        'dynagrid' => [
            'class' => '\kartik\dynagrid\Module',
            // other module settings
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
            // other module settings
        ],

        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout'=>'left-menu'

        ],

            'uploadBehavior' => [
                'class' => 'cyneek\yii2\uploadBehavior\Module',
            ]

    ]
];
