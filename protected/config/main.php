<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'language'=>'ru',
	'name'=>'Oknaorg.ru',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'071089',
			'ipFilters'=>array('92.246.220.245','::1','145.255.18.218'),
		),
	),
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'db'=>array(
			'connectionString' => 'mysql:host=185.84.108.232;dbname=b226646_oknaorg',
			'emulatePrepare' => true,
			'username' => 'u226646_user',
			'password' => 'Sx7TZCx2',
			'charset' => 'utf8',
		),
		'cache'=>array(
			'class'=>'system.caching.CFileCache'
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'gii'=>'gii',
				'gii/<controller:\w+>'=>'gii/<controller>',
				'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
				
				'out/<id>' => 'site/out',

				'<gorod>/company/list' => 'company/index',
				'<gorod>/company/<url>' => 'company/view',
				'<gorod>/news/list' => 'news/index',
				'<gorod>/prices/list' => 'company/prices',
				'<gorod>/promo/list' => 'company/promo',
				'<gorod>/review/list' => 'review/index',
				'city/list' => 'city/index',
				'page/list' => 'page/index',
				'help/success' => 'site/success',
				'map' => 'site/map',
				'help' => 'site/help',

				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

				'page/<url>' => 'page/view',
				'<gorod>' => 'site/index_gorod',
			),
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);