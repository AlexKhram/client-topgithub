<?php
/**
 * Created by PhpStorm.
 * User: AlexKhram
 * Date: 19.07.16
 * Time: 15:49
 */

namespace AlexKhram\Repositories;


interface TopRepRepositoryInterface
{
//    /**
//     * Save bet
//     *
//     * @param Bet $bet
//     * @return boolean
//     */
//    public function saveBet(Bet $bet);

    /**
     * Get list of top repositories by specified table by specified year
     *
     * @param $table string name of table (github repository language)
     * @param $year integer - year
     * @param $limit integer - quantity of returned objects (default = 100)
     *
     *
     * @return array of instances github repositories
     */
    public function getTopRepByYear($table, $year, $limit = 100);

    /**
     * Get list of top repositories by specified table by specified month
     *
     * @param $table string name of table (github repository language)
     * @param $year integer - year (ex.: 2015)
     * @param $month integer - month (ex.: 02)
     * @param $limit integer - quantity of returned objects (default = 100)
     *
     * @return array of instances github repositories
     */
    public function getTopRepByMonth($table, $year, $month, $limit = 100);

    /**
     * Get list of of available languages (db tables)
     *
     *
     * @return array of available languages (db tables)
     */
    public function getLanguages();

}