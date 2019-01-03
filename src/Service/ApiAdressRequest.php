<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 18/12/18
 * Time: 18:03
 */

namespace App\Service;

use GuzzleHttp\Client;
use App\Entity\Simulator;

class ApiAdressRequest
{
    private $data;


    /**
     * @param Simulator $simulator
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function dataLoad(Simulator $simulator): array
    {

        $client = new Client(['base_uri' => 'https://api-adresse.data.gouv.fr']);
        $res= $client->request('GET', 'search', ['query' => ['q' => $simulator->getCity()]]);

        $data = json_decode($res->getBody(), true);


        return $data;
    }

    /**
     * @param Simulator $simulator
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCity(Simulator $simulator)
    {
        return $this->data = $this->dataLoad($simulator)['features'][0]['properties']['city'];
    }
}
