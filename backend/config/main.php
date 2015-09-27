<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'english-tests-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'class' => 'common\components\lang\LangRequest'
        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'as ext' => 'common\behavior\UserBehavior',
            'loginUrl' => '/login',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class'=>'common\components\lang\LangUrlManager',
            'rules'=>[
                '/' => 'site/index',
                '/login' => 'site/login',
                '/logout' => 'site/logout',
                'question/create/<type>' => 'question/create',

                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>'
            ]
        ],

        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@backend/views/user',
                    '@dektrium/rbac/views' => '@backend/views/rbac',
                ],
            ],
        ],
    ],
    'modules'=>[
        'user' => [
            // following line will restrict access to admin page
            'as backend' => 'dektrium\user\filters\BackendFilter',
            'admins' => ['Admin'],
        ],

        'rbac' => [
            'class' => 'dektrium\rbac\Module',
        ],
    ],

    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'admin/*', // add or remove allowed actions to this list
            'debug/*',
            'site/*',
            'user/*',
            'rbac/*',
            'lang/*',
            'gii/*',
            'level/*',
            'domain/*',
            'question/*'
        ]
    ],

    'params' => $params,
];
