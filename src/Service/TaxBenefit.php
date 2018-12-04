<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 04/12/18
 * Time: 16:36
 */

namespace App\Service;

class TaxBenefit
{
    const MAXIMUM_PRICE_PER_SQUARE_METER = 5500;
    const MAXIMUM_TAX_BASE = 300000;
    const RATE_FOR_A_PERIOD_OF_SIX_YEARS = 0.12;
    const RATE_FOR_A_PERIOD_OF_NINE_YEARS = 0.18;
    const RATE_FOR_A_PERIOD_OF_TWELVE_YEARS = 0.21;

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

    /**
     * @param int $taxBase
     * @param int $time
     * @return int
     */
    public function taxBenefit(int $taxBase, int $time) : int
    {
        $taxBenefit = 0;
        if ($taxBase > self::MAXIMUM_TAX_BASE) {
            $taxBase = 300000;
        }
        if ($time == 6) {
            $taxBenefit = $taxBase * self::RATE_FOR_A_PERIOD_OF_SIX_YEARS;
        } elseif ($time == 9) {
            $taxBenefit = $taxBase * self::RATE_FOR_A_PERIOD_OF_NINE_YEARS;
        } else {
            $taxBenefit = $taxBase * self::RATE_FOR_A_PERIOD_OF_TWELVE_YEARS;
        }
        return $taxBenefit;
    }
}
