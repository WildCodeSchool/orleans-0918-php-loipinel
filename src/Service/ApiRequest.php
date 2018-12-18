<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 18/12/18
 * Time: 11:11
 */

namespace App\Service;

use GuzzleHttp\Client;
use App\Entity\Simulator;

class ApiRequest
{
    /**
     * @param $simulator
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function dataLoad(Simulator $simulator)
    {
        $client = new Client();
        $res = $client->request('GET', 'https://api-adresse.data.gouv.fr/search/?q='.$simulator->getCity());
        $json = $res->getBody();
        $data = json_decode($json, true);

        return $data;
    }
}
