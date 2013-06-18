<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'BrEAST Website',

    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.utils.*',
    ),

    'modules'=>array(
        // uncomment the following to enable the Gii tool
//        'gii'=>array(
//            'class'=>'system.gii.GiiModule',
//            'password'=>'test',
//            // If removed, Gii defaults to localhost only. Edit carefully to taste.
//        ),
        'biotracking', 'derf', 'reports', 'shipment', 'administration', 'prototype',
    ),

    // application components
    'components'=>
        array(
        "assetManager"=>
            array(
                    // set to TRUE for dev otherwise FALSE.
                    "forceCopy"=>true
                 ),

        'user'=>
            array(
                    // enable cookie-based authentication
                    'allowAutoLogin'=>false,
                 ),
        // uncomment the following to enable URLs in path-format
        'urlManager'=>
            array(
                    'showScriptName'=>false,
                    'urlFormat'=>'path',
                    'rules'=>
                        array(
                                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                             ),
                 ),

        'dbSqlite'=>
            array(
                    "class"=>"CDbConnection",
                    'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/breast_reborn.db',
                 ),

        'db'=>
            array(
                    'class'=>'CDbConnection',
                    'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/breast_reborn.db',  
                    // 'charset' => 'utf8',
                    'enableProfiling'=>true,
                    'schemaCachingDuration'=>60*60*24*7, // 1 semaine
                 ),

        'dbShipment'=>
            array(
                    'class'=>'CDbConnection',
                    'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/breast_reborn.db',  
                    'schemaCachingDuration'=>60*60*24*7, // 1 semaine
                 ),

        'dbBiotracking'=>
            array(
                    'class'=>'CDbConnection',
                    'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/breast_reborn.db',
                    'enableProfiling' => true,
//                        'enableProfiling'=>true,
                    'schemaCachingDuration'=>60*60*24*7, // 1 semaine
                 ),

        'dbWebReports'=>
            array(
                    'class'=>'CDbConnection',
                    'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/breast_reborn.db',  
                    'schemaCachingDuration'=>60*60*24*7, // 1 semaine
                 ),

        'dbLabDev2'=>
            array(
                    'class'=>'CDbConnection',
                    'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/breast_reborn.db',  
                    'schemaCachingDuration'=>60*60*24*7, // 1 semaine
                 ),

        'clientScript'=>
            array(
                    'scriptMap'=>
                        array(
                                'jquery.js'=>false,

                             ),
                    'packages'=>
                        array(
                                'bootstrap'=>
                                    array(
                                            'basePath'=> 'webroot.framework.bootstrap',
                                            'css'=>array('css/bootstrap-combined.min.css'),
                                            'js'=>array('js/bootstrap.min.js'),
                                         ),
                                'angularjs'=>
                                    array(
                                            'basePath'=> 'webroot.framework.angularjs',
                                            'js'=>array('js/angular.min.js'),
                                         ),
                                'jquery'=>
                                    array(
                                            'basePath'=>'webroot.javascript.jquery',
                                            //'baseUrl'=>"//ajax.googleapis.com/ajax/libs/jquery/1.7.1/",
                                            'js'=>array('jquery-1.8.2.min.js')
                                         ),
                                'jquery-ui'=>
                                    array(
                                            'basePath'=>'webroot.javascript.jquery-ui',
                                            //'baseUrl'=>"//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/",
                                            'js'=>array('jquery-ui-1.9.0.min.js')
                                         )
                             )
                ), // end clientscript

        'errorHandler'=>
            array(
                    // use 'site/error' action to display errors
                    'errorAction'=>'site/error',
                 ),

        'log'=>
            array(
                    'class'=>'CLogRouter',
                    'routes'=>
                        array(
                        // utiliser lors du debuggage
                                array(
                                    'class'=>'CWebLogRoute',
                                    "levels"=>"trace",
                                    "categories"=>"app.*"
                                ),

                                array(
                                    'class'=>'CFileLogRoute',
                                    'levels'=>'warning,error,trace',
                                    "categories"=>"app.biotracking.*",
                                    "logFile"=>"biotracking.log"
                                ),

                                array(
                                    'class'=>'CFileLogRoute',
                                    'levels'=>'warning,error,trace',
                                    "categories"=>"app.administration.*",
                                    "logFile"=>"administration.log"
                                ),

                                array(
                                    'class'=>'CFileLogRoute',
                                    'levels'=>'warning,error,trace',
                                    "categories"=>"app.shipment.*",
                                    "logFile"=>"shipment.log"
                                ),
                                array(
                                    'class'=>'CFileLogRoute',
                                    'levels'=>'warning,error,trace',
                                    "categories"=>"app.breast.*",
                                    "logFile"=>"breast.log"
                                ),
                                array(
                                    'class'=>'CFileLogRoute',
                                    'levels'=>'warning,error,info',
                                ),

                                array(
                                    'class'=>'CProfileLogRoute',
                //                                    'showInFireBug'=>true,
                                ),

//                array(
//                    'class'=>'CEmailLogRoute',
//                    'levels'=>'error',
//                    'emails'=>'ngocvu.tran@bordet.be',
//                ),
            ),
        ),

        'cache'=>array(
            'class'=>'system.caching.CApcCache'
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'test@test.be',
        'cacheTime'=> 60*60*24*30,
        'environment'=>'dev',
    ),
);