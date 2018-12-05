<?php

namespace Tests;

use App\Entity\RealEstateProperty;
use App\Service\TaxBenefit;
use PHPUnit\Framework\TestCase;

class TaxBaseTest extends TestCase
{
    public function testBaseUnderMax()
    {
        $realEstateProperty = new RealEstateProperty();
        $realEstateProperty->setSurfaceArea(100);
        $realEstateProperty->setPurchasePrice(400000);
        $taxBenefit = new TaxBenefit();
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(400000, $taxBenefit->getTaxBase());

        $realEstateProperty->setSurfaceArea(70);
        $realEstateProperty->setPurchasePrice(210000);
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(210000, $taxBenefit->getTaxBase());

        $realEstateProperty->setSurfaceArea(100);
        $realEstateProperty->setPurchasePrice(250000);
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(250000, $taxBenefit->getTaxBase());
    }


    public function testBaseOverMax()
    {
        $realEstateProperty = new RealEstateProperty();
        $realEstateProperty->setSurfaceArea(100);
        $realEstateProperty->setPurchasePrice(1000000);
        $taxBenefit = new TaxBenefit();
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(550000, $taxBenefit->getTaxBase());

        $realEstateProperty->setSurfaceArea(75);
        $realEstateProperty->setPurchasePrice(487500);
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(412500, $taxBenefit->getTaxBase());

        $realEstateProperty->setSurfaceArea(50);
        $realEstateProperty->setPurchasePrice(350000);
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(275000, $taxBenefit->getTaxBase());
   }
}