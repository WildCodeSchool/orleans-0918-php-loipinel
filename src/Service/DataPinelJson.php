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
    public function jsonReading(): array
    {
        $json = file_get_contents('../Data/pinel.json');
        $result = json_decode($json, true);
        return $result;
    }

    /**
     * @param string $data1
     * @param string $data2
     * @return string
     */
    public function getPinelArea(string $data1, string $data2): string
    {
        $res = date_parse($data1);
        $selectYear = $res['year'];
        $result = $this->jsonReading();
        if (array_key_exists($selectYear, $result['years'])) {
            $inseeCodes = $result['years'][$selectYear]['insee'];
            if (array_key_exists($data2, $inseeCodes)) {
                $area = $inseeCodes[$data2];
            } else {
                $area = self::INELLIGIBLE_AREA;
            }
        } else {
            $area = 'Données indisponibles pour l\'année renseignée';
        }
        return $area;
    }
}
