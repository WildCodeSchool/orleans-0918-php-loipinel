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
     * @var RealEstateProperty
     */
    private $realEstate;

    /**
     * Durée de la location en année
     *
     * @var int
     */
    private $rentalPeriod;

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
     * Calcule l'avantage fiscal en se basant sur la base fiscale et la durée
     *
     * @return int
     */
    public function calculateTaxBenefit() : float
    {
        $taxBenefit = 0;

        if ($this->calculateTaxBase() > self::MAXIMUM_TAX_BASE) {
            $taxBase = self::MAXIMUM_TAX_BASE;
        } else {
            $taxBase = $this->calculateTaxBase();
        }
        switch ($this->getRentalPeriod()) {
            case 6:
                $taxBenefit = $taxBase * self::RATE_FOR_A_PERIOD_OF_SIX_YEARS;
                break;
            case 9:
                $taxBenefit = $taxBase * self::RATE_FOR_A_PERIOD_OF_NINE_YEARS;
                break;
            case 12:
                $taxBenefit = $taxBase * self::RATE_FOR_A_PERIOD_OF_TWELVE_YEARS;
                break;
            default:
                throw new \LogicException("Only 6, 9, 12 accepted.");
                break;
        }

        return $taxBenefit;
    }

    /**
     * @return int
     */
    public function getRentalPeriod(): int
    {
        return $this->rentalPeriod;
    }

    /**
     * @param int $rentalPeriod
     * @return TaxBenefit
     */
    public function setRentalPeriod(int $rentalPeriod): TaxBenefit
    {
        $this->rentalPeriod = $rentalPeriod;
        return $this;
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
