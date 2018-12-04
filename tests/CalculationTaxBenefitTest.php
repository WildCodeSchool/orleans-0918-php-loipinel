<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 04/12/18
 * Time: 11:14
 */
namespace Tests;

use App\Service\CalculationTaxBenefit;
use PHPUnit\Framework\TestCase;

class taxBenefitTest extends TestCase
{
    public function testTaxBenefitInLimit()
    {
        $taxBenefitResult = new CalculationTaxBenefit;
        $this->assertEquals(63000, $taxBenefitResult->taxBenefit(300000, 12));
        $this->assertEquals(54000, $taxBenefitResult->taxBenefit(300000, 9));
        $this->assertEquals(36000, $taxBenefitResult->taxBenefit(300000, 6));
    }
    public function testTaxBenefitOverLimit()
    {
        $taxBenefitResult = new CalculationTaxBenefit;
        $this->assertEquals(63000, $taxBenefitResult->taxBenefit(600000, 12));
        $this->assertEquals(54000, $taxBenefitResult->taxBenefit(750000, 9));
        $this->assertEquals(36000, $taxBenefitResult->taxBenefit(320000, 6));
    }
}