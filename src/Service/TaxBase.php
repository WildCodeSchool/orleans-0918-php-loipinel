<?php

namespace App\Service;

class TaxBase
{
    const MAXIMUM_PRICE_PER_SQUARE_METER = 5500;

    /**
     * @param int $price
     * @param int $area
     * @return int
     */
    public function taxBase(int $price, int $area) : int
    {
        $taxBase = 0;
        $meterSquarePrice = $price / $area;
        if ($meterSquarePrice > self::MAXIMUM_PRICE_PER_SQUARE_METER) {
            $meterSquarePrice = 5500;
        }
        $taxBase = $meterSquarePrice * $area;
        return $taxBase;
    }
}
