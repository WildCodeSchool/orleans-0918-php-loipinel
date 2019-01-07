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
    public function getCity(string $search): string
    {
        $client = new Client(['base_uri' => 'https://api-adresse.data.gouv.fr']);
        $res = $client->request('GET', 'search', ['query' => ['q' => $search]]);

        $data = json_decode($res->getBody(), true);
        return $data['features'][0]['properties']['city'] ?? '';
    }
}
