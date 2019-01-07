<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 11/12/18
 * Time: 15:20
 */

namespace App\Service;

class DataPinelJson
{
    const INELLIGIBLE_AREA = 'C';


    /**
     * @return array
     */
    private function jsonReading(): array
    {
        $json = file_get_contents('../Data/pinel.json');
        $result = json_decode($json, true);
        return $result;
    }

    /**
     * @param string $date
     * @param string $cityCode
     * @return string
     */
    public function getPinelArea(string $date, string $cityCode): string
    {
        $res = date_parse($date);
        $selectYear = $res['year'];
        $result = $this->jsonReading();
        if (array_key_exists($selectYear, $result['years'])) {
            $inseeCodes = $result['years'][$selectYear]['insee'];
            if (array_key_exists($cityCode, $inseeCodes)) {
                $area = $inseeCodes[$cityCode];
            } else {
                $area = self::INELLIGIBLE_AREA;
            }
        } else {
            $area = 'Données indisponibles pour l\'année renseignée';
        }
        return $area;
    }
}
