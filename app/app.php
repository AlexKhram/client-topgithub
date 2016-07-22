<?php

use AlexKhram\Repositories\GuzzleTopRep;
use AlexKhram\Providers\ClientControllerProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

//TopRep repository
/* @var $app \Silex\Application */
$app['repository.toprep'] = function () use ($app) {
    return new GuzzleTopRep($app);
};

$app['api.url'] = 'http://api-topgithub.rhcloud.com';

$app->mount("/client", new ClientControllerProvider());

//error handling
$app->error(function (Exception $e) use ($app) {
    if ($e instanceof NotFoundHttpException) {
        return new Response('The requested page could not be found.', Response::HTTP_NOT_FOUND);
    }
    return new Response("{$e} Server error", 500);
});