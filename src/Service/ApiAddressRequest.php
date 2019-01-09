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
     * @param string $zipCode
     * @param string $inseeCode
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCityApi(string $zipCode, string $inseeCode): string
    {
        $client = new Client();
        $res = $client->request('GET','https://api-adresse.data.gouv.fr/search/?q='.$zipCode.'&limit=50');

        $data = json_decode($res->getBody(), true);

        foreach ($data['features'] as $city) {
            if ($city['properties']['citycode'] === $inseeCode) {
                $cityName = $city['properties']['city'];
            }
        }
        return $cityName;
    }
}
