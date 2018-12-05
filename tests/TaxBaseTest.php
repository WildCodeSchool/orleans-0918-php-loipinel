<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 04/12/18
 * Time: 11:05
 */

namespace Tests;

use App\Entity\RealEstateProperty;
use App\Service\TaxBenefit;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TaxBaseTest extends TestCase
{
    public function testBaseUnderMax()
    {
        $mockSession = $this->getMockBuilder(SessionInterface::class)->getMock();
        $realEstateProperty = new RealEstateProperty();
        $realEstateProperty->setSurfaceArea(100);
        $realEstateProperty->setPurchasePrice(400000);
        $taxBenefit = new TaxBenefit($realEstateProperty, $mockSession);


        $this->assertEquals(400000, $taxBenefit->getTaxBenefit());
//        $this->assertEquals(210000, $taxBaseResult->taxBase(210000, 70));
//        $this->assertEquals(250000, $taxBaseResult->taxBase(250000, 100));
    }
//    public function testBaseOverMax()
//    {
//        $taxBaseResult = new TaxBenefit();
//        $this->assertEquals(550000, $taxBaseResult->taxBase(1000000, 100));
//        $this->assertEquals(412500, $taxBaseResult->taxBase(487500, 75));
//        $this->assertEquals(275000, $taxBaseResult->taxBase(350000, 50));
//    }
}