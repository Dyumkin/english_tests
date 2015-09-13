<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [

        'user' => [
            'identityClass' => 'common\models\User',
            'as ext' => 'common\behavior\UserBehavior',
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

        'language' => 'ru-RU',
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => 'en',
                ],
            ],
        ]
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin'],
            'urlPrefix' => '/',
            'urlRules' => []
        ],

        'admin' => [
                'class' => 'mdm\admin\Module',
                'controllerMap' => [
                    'assignment' => [
                        'class' => 'mdm\admin\controllers\AssignmentController',
                        'userClassName' => 'common\models\User',
                        'idField' => 'id', // id field of model User
                    ]
                ],
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
        ],
    ],
];
