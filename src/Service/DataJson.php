<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 11/12/18
 * Time: 15:20
 */

namespace App\Service;

class DataJson
{
    /**
     * @return mixed
     */
    public function jsonReading()
    {
        $json = file_get_contents('../Data/pinel.json');
        $result = json_decode($json, true);
        return $result;
    }
}
