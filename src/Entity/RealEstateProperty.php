<?php

namespace App\Entity;

class RealEstateProperty
{
    /**
     * @var int
     */
    private $surfaceArea;
    /**
     * @var int
     */
    private $purchasePrice;

    /**
     * @return int
     */
    public function getSurfaceArea(): int
    {
        return $this->surfaceArea;
    }

    /**
     * @param int $surfaceArea
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
