<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 22/11/18
 * Time: 11:53
 */

public function CalculateFiscalBase($price, $area){
    $FiscalBase = 0;
    $meterPrice = $price / $area;
    if ($meterPrice > 5500){
        $meterPrice = 5500;
    }
    $FiscalBase = $meterPrice * $area;
    return $FiscalBase;
}
