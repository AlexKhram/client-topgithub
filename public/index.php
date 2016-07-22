<?php
/**
 * Created by PhpStorm.
 * User: AlexKhram
 * Date: 21.07.16
 * Time: 17:23
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../vendor/autoload.php';

$app = new \Silex\Application;

require_once __DIR__ . '/../app/app.php';

$app->run();