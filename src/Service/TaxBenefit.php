<?php

namespace App\Service;

use App\Entity\RealEstateProperty;

class TaxBenefit
{
    const MAXIMUM_PRICE_PER_SQUARE_METER = 5500;

    /**
     * @var RealEstateProperty
     */
    private $realEstate;


    /**
     * Calcule la base fiscale du bien
     *
     * @return float
     */
    public function calculateTaxBase() : float
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
