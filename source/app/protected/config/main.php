<?php
    // uncomment the following to define a path alias
    // Yii::setPathOfAlias('local','path/to/local-folder');

    // This is the main Web application configuration. Any writable
    // CWebApplication properties can be configured here.

    return array (
        'sourceLanguage' => 'ru',
        'aliases'        => array (
            'bootstrap'                  => realpath (__DIR__ . '/../../../vendor/crisu83/yiistrap'),
            'vendor.twbs.bootstrap.dist' => realpath (__DIR__ . '/../../../vendor/twbs/bootstrap/dist'),
        ),

        'basePath'       => dirname (__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name'           => 'yiiTicket',

        // preloading 'log' component
        'preload'        => [
            'log',
        ],

        // autoloading model and component classes
        'import'         => array (
            'application.models.*',
            'application.components.*',
            'bootstrap.behaviors.*',
            'bootstrap.components.*',
            'bootstrap.form.*',
            'bootstrap.helpers.*',
            'bootstrap.widgets.*',
            'bootstrap.helpers.TbHtml',
        ),

        'modules'    => array (
            // uncomment the following to enable the Gii tool

            'gii' => array (
                'class'          => 'system.gii.GiiModule',
                'password'       => '1234',
                'ipFilters'      => array ('*'),
                'generatorPaths' => array ('bootstrap.gii'),
            ),
        ),

        // application components
        'components' => array (

            'user'      => array (
                // enable cookie-based authentication
                'class'          => 'WebUser',
                'loginUrl'       => ['user/login'],
                'allowAutoLogin' => true,
            ),
            'bootstrap' => array (
                'class' => 'bootstrap.components.TbApi',
            ),
            // uncomment the following to enable URLs in path-format

            'urlManager' => array (
                'urlFormat'      => 'path',
                'showScriptName' => false,
                'urlSuffix'      => '/',
                'rules'          => array (
                    '<controller:\w+>/<id:\d+>'              => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
                ),
            ),

            // database settings are configured in database.php
            'db'         => require (dirname (__FILE__) . '/database.php'),

            'errorHandler' => array (
                // use 'site/error' action to display errors
                'errorAction' => YII_DEBUG ? null : 'site/error',
            ),

            'log' => array (
                'class'  => 'CLogRouter',
                'routes' => array (
                    array (
                        'class'  => 'CFileLogRoute',
                        'levels' => 'error, warning',
                    ),
                    // uncomment the following to show log messages on web pages
                    /*
                    array(
                        'class'=>'CWebLogRoute',
                    ),
                    */
                ),
            ),

            'authManager' => array (
                // Будем использовать свой менеджер авторизации
                'class'        => 'PhpAuthManager',
                // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
                'defaultRoles' => array ('guest'),
            ),

        ),

        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params'     => array (
            // this is used in contact page
            'adminEmail' => 'webmaster@example.com',
        ),
    );
