<?php

namespace Tests;

use App\Entity\RealEstateProperty;
use App\Repository\VariableRepository;
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
        $taxBenefit = new TaxBenefit($this->getVariable());
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
        $realEstateProperty->setSurfaceArea(25.75);
        $realEstateProperty->setPurchasePrice(125000);
        $taxBenefitResult = new TaxBenefit($this->getVariable());
        $taxBenefitResult->setRentalPeriod(12);
        $taxBenefitResult->setRealEstate($realEstateProperty);
        $this->assertEquals(26250, $taxBenefitResult->calculateTaxBenefit());

        $realEstateProperty->setSurfaceArea(25.75);
        $realEstateProperty->setPurchasePrice(125000);
        $taxBenefitResult->setRealEstate($realEstateProperty);
        $taxBenefitResult->setRentalPeriod(9);
        $this->assertEquals(22500, $taxBenefitResult->calculateTaxBenefit());

        $realEstateProperty->setSurfaceArea(25.75);
        $realEstateProperty->setPurchasePrice(125000);
        $taxBenefitResult->setRealEstate($realEstateProperty);
        $taxBenefitResult->setRentalPeriod(6);
        $this->assertEquals(15000, $taxBenefitResult->calculateTaxBenefit());
    }

    public function testTaxBenefitOverLimit()
    {
        $realEstateProperty = new RealEstateProperty();
        $realEstateProperty->setSurfaceArea(100);
        $realEstateProperty->setPurchasePrice(1000000);
        $taxBenefitResult = new TaxBenefit($this->getVariable());
        $taxBenefitResult->setRealEstate($realEstateProperty);
        $taxBenefitResult->setRentalPeriod(12);
        $this->assertEquals(63000, $taxBenefitResult->calculateTaxBenefit());

        $realEstateProperty->setSurfaceArea(100);
        $realEstateProperty->setPurchasePrice(1000000);
        $taxBenefitResult->setRealEstate($realEstateProperty);
        $taxBenefitResult->setRentalPeriod(9);
        $this->assertEquals(54000, $taxBenefitResult->calculateTaxBenefit());

        $realEstateProperty->setSurfaceArea(100);
        $realEstateProperty->setPurchasePrice(1000000);
        $taxBenefitResult->setRealEstate($realEstateProperty);
        $taxBenefitResult->setRentalPeriod(6);
        $this->assertEquals(36000, $taxBenefitResult->calculateTaxBenefit());
    }
}
