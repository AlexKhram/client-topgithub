<?php
/**
 * Created by PhpStorm.
 * User: AlexKhram
 * Date: 21.07.16
 * Time: 17:28
 */

namespace AlexKhram\Controllers;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;


class ClientController
{
    public function index(Application $app)
    {
        $data = $app["repository.toprep"]->getAllCurrentTopFive();

        if (!$data) {
            throw new NotFoundHttpException;
        }
        var_dump($data);

        return 'ee';
    }

    public function topMonth(Application $app, $table, $year, $month, $limit)
    {
        $data = $app["repository.toprep"]->getTopRepByMonth($table, $year, $month, $limit);

        if (!$data) {
            throw new NotFoundHttpException;
        }
        var_dump($data[0]);

        return 'ee';
    }

    public function topYear(Application $app, $table, $year, $limit)
    {
        $data = $app["repository.toprep"]->getTopRepByYear($table, $year, $limit);

        if (!$data) {
            throw new NotFoundHttpException;
        }
        var_dump($data[0]);

        return 'ee';
    }

    public function topLang(Application $app, $table)
    {
        $data = $app["repository.toprep"]->getCurrentTopByLang();

        if (!$data) {
            throw new NotFoundHttpException;
        }
        var_dump($data);

        return 'ee';
    }

}