<?php

namespace App\Service;

use App\Entity\RealEstateProperty;

class TaxBenefit
{
    const MAXIMUM_PRICE_PER_SQUARE_METER = 5500;
    const MAXIMUM_TAX_BASE = 300000;
    const RATE_FOR_A_PERIOD_OF_SIX_YEARS = 0.12;
    const RATE_FOR_A_PERIOD_OF_NINE_YEARS = 0.18;
    const RATE_FOR_A_PERIOD_OF_TWELVE_YEARS = 0.21;

    /**
     * Durée de la location en année
     *
     * @var int
     */
    private $rentalPeriod;


    /**
     * @var RealEstateProperty
     */
    private $realEstate;


    /**
     * Calcule la base fiscale du bien
     *
     * @return int
     */
    public function getTaxBase() : int
    {
        $meterSquarePrice = $this->getRealEstate()->getPurchasePrice() / $this->getRealEstate()->getSurfaceArea();
        if ($meterSquarePrice > self::MAXIMUM_PRICE_PER_SQUARE_METER) {
            $meterSquarePrice = self::MAXIMUM_PRICE_PER_SQUARE_METER;
        }
        return $meterSquarePrice * $this->realEstate->getSurfaceArea();
    }

    /**
     * @return RealEstateProperty
     */
    public function getRealEstate(): RealEstateProperty
    {
        return $this->realEstate;
    }

    /**
     * @param RealEstateProperty $realEstate
     * @return TaxBenefit
     */
    public function setRealEstate(RealEstateProperty $realEstate): TaxBenefit
    {
        $this->realEstate = $realEstate;
        return $this;
    }
}
