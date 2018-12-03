<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 03/12/18
 * Time: 17:53
 */

namespace App\Service;

class CalculationTaxBenefit
{
    public function taxBenefit($taxBase, $time)
    {
        $taxBenefit = 0;
        if ($taxBase > 300000) {
            $taxBase = 300000;
        }
        if ($time == 6) {
            $taxBenefit = $taxBase * 0.12;
        } elseif ($time == 9) {
            $taxBenefit = $taxBase * 0.18;
        } else {
            $taxBenefit = $taxBase * 0.21;
        }
        return $taxBenefit;
    }
}