<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 18/12/18
 * Time: 18:03
 */

namespace App\Service;

use GuzzleHttp\Client;

class ApiAddressRequest
{
    /**
     * @param string $search
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCity(string $zipcode, string $inseeCode ): string
    {
        $client = new Client(['base_uri' => 'https://api-adresse.data.gouv.fr']);
        $res = $client->request('GET', 'search', ['query' => ['q' => $zipcode]]);

        $data = json_decode($res->getBody(), true);

        for ($i=0; $i<count($data['features'][$i]); $i++) {
            if ($data['features'][$i]['properties']['citycode'] === $inseeCode){
             return $data['features'][$i]['properties']['city'];
            }
        }
    }
}
