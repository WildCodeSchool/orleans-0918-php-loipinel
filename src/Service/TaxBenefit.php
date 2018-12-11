<?php

namespace App\Service;

use App\Entity\RealEstateProperty;

class TaxBenefit
{
    const MAXIMUM_PRICE_PER_SQUARE_METER = 5500;
    const MAXIMUM_TAX_BASE = 300000;
    const TABLE_OF_RATES_BY_DURATION = [
        6 => 0.12,
        9 => 0.18,
        12 => 0.21,
    ];

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
     * Base fiscale
     * @var float
     */
    private $taxBase;



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

        $this->setTaxBase($this->calculateTaxBase());

        if ($this->taxBase > self::MAXIMUM_TAX_BASE) {
            $taxBase = self::MAXIMUM_TAX_BASE;
        } else {
            $taxBase = $this->taxBase;
        }
        $datesOfRatesByDuration = array_keys(self::TABLE_OF_RATES_BY_DURATION);
        if (array_key_exists ( $this->getRentalPeriod(),  self::TABLE_OF_RATES_BY_DURATION )) {
            $taxBenefit = $taxBase * self::TABLE_OF_RATES_BY_DURATION[$this->getRentalPeriod()];
        } else {
            throw new \LogicException("Only " .implode(", ",$datesOfRatesByDuration)." accepted.");
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

    /**
     * @return float
     */
    public function getTaxBase(): float
    {
        return $this->taxBase;
    }

    /**
     * @param float $taxBase
     * @return TaxBenefit
     */
    public function setTaxBase(float $taxBase): TaxBenefit
    {
        $this->taxBase = $taxBase;
        return $this;
    }
}
