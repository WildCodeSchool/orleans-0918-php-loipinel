<?php
namespace Tests;
use App\Entity\RealEstateProperty;
use App\Entity\Variable;
use App\Repository\VariableRepository;
use App\Service\TaxBenefit;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;
class TaxBaseTest extends TestCase
{
    private $variableRepository;
    public function setUp()
    {
        $this->variableRepository = $this->createMock(VariableRepository::class);
        $variable = new Variable();
        $variable->setMaximumTaxBase(300000);
        $variable->setMaximumPricePerSquareMeter(5500);
        $variable->setRateFor6Years(0.12);
        $variable->setRateFor9Years(0.18);
        $variable->setRateFor12Years(0.21);
        $this->variableRepository->expects($this->any())
            ->method('findOneBy')
            ->willReturn($variable);
    }
    public function testBaseUnderMax()
    {
        $realEstateProperty = new RealEstateProperty();
        $realEstateProperty->setSurfaceArea(100);
        $realEstateProperty->setPurchasePrice(400000);
        $taxBenefit = new TaxBenefit($this->variableRepository);
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
        $taxBenefit = new TaxBenefit($this->variableRepository);
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
        $taxBenefitResult = new TaxBenefit($this->variableRepository);
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
        $taxBenefitResult = new TaxBenefit($this->variableRepository);
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