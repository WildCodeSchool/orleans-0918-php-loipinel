<?php

namespace App\Service;

use App\Entity\RealEstateProperty;
use App\Repository\VariableRepository;

class TaxBenefit
{
    /**
     * @var RealEstateProperty
     */
    private $realEstate;

    /**
     * Durée de la location en année
     * @var int
     */
    private $rentalPeriod;

    /**
     * Base fiscale
     * @var float
     */
    private $taxBase;

    private $variable;

    private $variableRepository;

    public function __construct(VariableRepository $variablesRepository)
    {
        $this->variableRepository = $variablesRepository;
        $this->initializeVariableFromDB();
    }

    /**
     * récupère la seule ligne de données de la table variable
     */
    private function initializeVariableFromDB()
    {
        $this->variable = $this->variableRepository->findOneBy([]);
    }

    private function ratesByDuration()
    {
        return $tableOfRatesByDuration = [
        6 => $this->getVariable()->getRateFor6years(),
        9 => $this->getVariable()->getRateFor9years(),
        12 => $this->getVariable()->getRateFor12years(),
        ];
    }

    /**
     * Calcule la base fiscale du bien
     * @return float
     */
    public function calculateTaxBase() : float
    {
        $meterSquarePrice = $this->getRealEstate()->getPurchasePrice() / $this->getRealEstate()->getSurfaceArea();
        if ($meterSquarePrice > $this->getVariable()->getMaximumPricePerSquareMeter()) {
            $meterSquarePrice = $this->getVariable()->getMaximumPricePerSquareMeter();
        }
        return $meterSquarePrice * $this->realEstate->getSurfaceArea();
    }

    /**
     * Calcule l'avantage fiscal en se basant sur la base fiscale et la durée
     * @return int
     */
    public function calculateTaxBenefit() : float
    {
        $taxBenefit = 0;

        $this->setTaxBase($this->calculateTaxBase());

        if ($this->taxBase > $this->getVariable()->getMaximumTaxBase()) {
            $taxBase = $this->getVariable()->getMaximumTaxBase();
        } else {
            $taxBase = $this->taxBase;
        }
        $datesOfRatesByDuration = array_keys($this->ratesByDuration());
        if (array_key_exists($this->getRentalPeriod(), $this->ratesByDuration())) {
            $taxBenefit = $taxBase * $this->ratesByDuration()[$this->getRentalPeriod()];
        } else {
            throw new \LogicException("Only " . implode(", ", $datesOfRatesByDuration) . " accepted.");
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

    /**
     * @return mixed
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * @param mixed $variable
     */
    public function setVariable($variable): void
    {
        $this->variable = $variable;
    }
}
