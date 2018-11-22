<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 22/11/18
 * Time: 17:20
 */
namespace App;

class CalculateAdvantageFiscal
{


    public function fiscalBase($fiscalBase, $time)
    {
        $AdvantageFiscal = 0;
        if ($fiscalBase > 300000) {
            $fiscalBase = 300000;
        }

        if ($time == 6) {
            $AdvantageFiscal = $fiscalBase * 0.12;
        } elseif ($time == 9) {
            $AdvantageFiscal = $fiscalBase * 0.18;
        } else {
            $AdvantageFiscal = $fiscalBase * 0.21;
        }

        return $AdvantageFiscal;
    }
}
