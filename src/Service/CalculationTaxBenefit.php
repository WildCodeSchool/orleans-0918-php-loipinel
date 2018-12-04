<?php

namespace App\Service;

class CalculationTaxBenefit
{
    const MAXIMUM_TAX_BASE = 300000;
    const RATE_FOR_A_PERIOD_OF_SIX_YEARS = 0.12;
    const RATE_FOR_A_PERIOD_OF_NINE_YEARS = 0.18;
    const RATE_FOR_A_PERIOD_OF_TWELVE_YEARS = 0.21;

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
