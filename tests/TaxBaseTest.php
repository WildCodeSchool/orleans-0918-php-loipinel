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
        $this->assertEquals(400000, $taxBenefit->calculateTaxBase());

        $realEstateProperty->setSurfaceArea(70);
        $realEstateProperty->setPurchasePrice(210000);
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(210000, $taxBenefit->calculateTaxBase());

        $realEstateProperty->setSurfaceArea(100);
        $realEstateProperty->setPurchasePrice(250000);
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(250000, $taxBenefit->calculateTaxBase());

        $realEstateProperty->setSurfaceArea(100.00);
        $realEstateProperty->setPurchasePrice(250000);
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(250000, $taxBenefit->calculateTaxBase());

        $realEstateProperty->setSurfaceArea(25.75);
        $realEstateProperty->setPurchasePrice(125000);
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(125000, $taxBenefit->calculateTaxBase());


    }


    public function testBaseOverMax()
    {
        $realEstateProperty = new RealEstateProperty();
        $realEstateProperty->setSurfaceArea(100);
        $realEstateProperty->setPurchasePrice(1000000);
        $taxBenefit = new TaxBenefit();
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(550000, $taxBenefit->calculateTaxBase());

        $realEstateProperty->setSurfaceArea(75);
        $realEstateProperty->setPurchasePrice(487500);
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(412500, $taxBenefit->calculateTaxBase());

        $realEstateProperty->setSurfaceArea(50);
        $realEstateProperty->setPurchasePrice(350000);
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(275000, $taxBenefit->calculateTaxBase());

        $realEstateProperty->setSurfaceArea(50.00);
        $realEstateProperty->setPurchasePrice(350000);
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(275000, $taxBenefit->calculateTaxBase());

        $realEstateProperty->setSurfaceArea(30.78);
        $realEstateProperty->setPurchasePrice(350000);
        $taxBenefit->setRealEstate($realEstateProperty);
        $this->assertEquals(169290, $taxBenefit->calculateTaxBase());

   }

    public function testTaxBenefitInLimit()
    {
        $realEstateProperty = new RealEstateProperty();
        $realEstateProperty->setSurfaceArea(12);
        $realEstateProperty->setPurchasePrice(300000);
        $taxBenefitResult = new TaxBenefit();
        $taxBenefitResult->setRealEstate($realEstateProperty);
        $this->assertEquals(63000, $taxBenefit->calculateTaxBenefit());

        $realEstateProperty->setSurfaceArea(9);
        $realEstateProperty->setPurchasePrice(300000);
        $taxBenefitResult->setRealEstate($realEstateProperty);
        $this->assertEquals(54000, $taxBenefit->calculateTaxBenefit());

        $realEstateProperty->setSurfaceArea(6);
        $realEstateProperty->setPurchasePrice(300000);
        $taxBenefitResult->setRealEstate($realEstateProperty);
        $this->assertEquals(36000, $taxBenefit->calculateTaxBenefit());
    }

    public function testTaxBenefitOverLimit()
    {
        $realEstateProperty = new RealEstateProperty();
        $realEstateProperty->setSurfaceArea(12);
        $realEstateProperty->setPurchasePrice(600000);
        $taxBenefitResult = new TaxBenefit();
        $taxBenefitResult->setRealEstate($realEstateProperty);
        $this->assertEquals(63000, $taxBenefit->calculateTaxBenefit());

        $realEstateProperty->setSurfaceArea(9);
        $realEstateProperty->setPurchasePrice(750000);
        $taxBenefitResult->setRealEstate($realEstateProperty);
        $this->assertEquals(54000, $taxBenefit->calculateTaxBenefit());

        $realEstateProperty->setSurfaceArea(6);
        $realEstateProperty->setPurchasePrice(320000);
        $taxBenefitResult->setRealEstate($realEstateProperty);
        $this->assertEquals(36000, $taxBenefit->calculateTaxBenefit());
    }
}
