<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 22/11/18
 * Time: 17:02
 */

namespace Tests;


use App\TaxAdvantage;
use PHPUnit\Framework\TestCase;


class TaxAdvantageTest extends TestCase
{

    public function testTaxAdvantageInLimit()
    {
        $taxAdvantageResult = new TaxAdvantage;
        $this->assertEquals(63000, $taxAdvantageResult->taxAdvantage(300000, 12));
        $this->assertEquals(54000, $taxAdvantageResult->taxAdvantage(300000, 9));
        $this->assertEquals(36000, $taxAdvantageResult->taxAdvantage(300000, 6));
    }

    public function testTaxAdvantageOverLimit()
    {
        $taxAdvantageResult = new TaxAdvantage;
        $this->assertEquals(63000, $taxAdvantageResult->taxAdvantage(600000, 12));
        $this->assertEquals(54000, $taxAdvantageResult->taxAdvantage(750000, 9));
        $this->assertEquals(36000, $taxAdvantageResult->taxAdvantage(320000, 6));
    }
}
