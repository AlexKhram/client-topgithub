<?php
/**
 * Created by PhpStorm.
 * User: AlexKhram
 * Date: 21.07.16
 * Time: 18:18
 */

namespace AlexKhram\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


class GuzzleTopRep implements TopRepRepositoryInterface
{
    private $guzzle;

    public function __construct($app)
    {
        $this->guzzle = new Client(['base_url' => $app['api.url']]);
    }

    /**
     * Get list of top repositories by specified language by specified year
     *
     * @param $table string name of table (github repository language)
     * @param $year integer - year
     * @param $limit integer - quantity of returned objects (default = 100)
     *
     *
     * @return array of instances github repositories
     */
    public function getTopRepByYear($table, $year, $limit = 100)
    {

        try {
            $res = $this->guzzle->get("/api/v1/year/{$table}/{$year}/{$limit}");
        } catch
        (ClientException $e) {
            return null;
        }
//        var_dump(json_decode($res->getBody()->getContents(), true));var_dump(json_last_error() === JSON_ERROR_SYNTAX);
        return json_decode($res->getBody());

    }

    /**
     * Get list of top repositories by specified language by specified month
     *
     * @param $table string name of table (github repository language)
     * @param $year integer - year (ex.: 2015)
     * @param $month integer - month (ex.: 02)
     * @param $limit integer - quantity of returned objects (default = 100)
     *
     * @return array of instances github repositories
     */
    public function getTopRepByMonth($table, $year, $month, $limit = 100)
    {
        try {
            $res = $this->guzzle->get("/api/v1/month/{$table}/{$year}/{$month}/{$limit}");
        } catch
        (ClientException $e) {
            return null;
        }

//        var_dump(json_decode($res->getBody()->getContents(), true));var_dump(json_last_error() === JSON_ERROR_SYNTAX);
        return json_decode($res->getBody());
    }

    /**
     * Get list of of available languages
     *
     *
     * @return array of available languages
     */
    public function getLanguages()
    {
        try {
            $res = $this->guzzle->get("/api/v1/lang");
        } catch
        (ClientException $e) {
            return null;
        }
        return json_decode($res->getBody());
    }

    /**
     * Get lists of top5 repositories by every language
     *
     *
     * @return array of top5 repositories
     */
    public function getAllCurrentTopFive()
    {
        $data = [];
        $langs = $this->getLanguages();
        if (!$langs or !is_array($langs)) {
            return null;
        }
        foreach ($langs as $lang) {
            for ($n = 1; $n < 3; $n++) {
                $month = date('m', strtotime("-{$n} month"));
                $year = date('Y', strtotime("-{$n} month"));
                if ($topFive = $this->getTopRepByMonth($lang, $year, $month, 5)) {
                    $data[$lang] = $topFive;
                    $data[$lang]['month'] = $month;
                    $data[$lang]['year'] = $year;
                    break;
                }
            }
        }

        return $data;
    }
}