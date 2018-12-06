<?php

namespace App\Entity;

class RealEstateProperty
{
    /**
     * @var float
     */
    private $surfaceArea;
    /**
     * @var int
     */
    private $purchasePrice;

    /**
     * @return float
     */
    public function getSurfaceArea(): float
    {
        return $this->surfaceArea;
    }

    /**
     * @param float $surfaceArea
     */
    public function setSurfaceArea(int $surfaceArea): void
    {
        $this->surfaceArea = $surfaceArea;
    }

    /**
     * @return int
     */
    public function getPurchasePrice(): int
    {
        return $this->purchasePrice;
    }

    /**
     * @param int $purchasePrice
     */
    public function setPurchasePrice(int $purchasePrice): void
    {
        $this->purchasePrice = $purchasePrice;
    }
}
