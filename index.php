<?php
ini_set('memory_limit', '-1');
$config = dirname(__FILE__).'/protected/config/main.php';
$yii    = dirname(__FILE__).'/core/yii.php';

defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
$app = Yii::createWebApplication($config);

$app->run();