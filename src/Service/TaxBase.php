<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 03/12/18
 * Time: 17:42
 */

namespace App\Service;

class TaxBase
{
    public function taxBase($price, $area)
    {
        $taxBase = 0;
        $meterPrice = $price / $area;
        if ($meterPrice > 5500) {
            $meterPrice = 5500;
        }
        $taxBase = $meterPrice * $area;
        return $taxBase;
    }
}
