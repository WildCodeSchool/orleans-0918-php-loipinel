<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 22/11/18
 * Time: 17:02
 */

namespace Tests;


use App\CalculateAdvantageFiscal;
use PHPUnit\Framework\TestCase;


class FiscalAdvantageTest extends TestCase
{

    public function testAdvantageInLimit()
    {
        $op = new CalculateAdvantageFiscal;
        $this->assertEquals(63000, $op->FiscalAdvantage(300000, 12));
        $this->assertEquals(54000, $op->FiscalAdvantage(300000, 9));
        $this->assertEquals(36000, $op->FiscalAdvantage(300000, 6));
    }

    public function testAdvantageOverLimit()
    {
        $op = new CalculateAdvantageFiscal;
        $this->assertEquals(63000, $op->FiscalAdvantage(600000, 12));
        $this->assertEquals(54000, $op->FiscalAdvantage(750000, 9));
        $this->assertEquals(36000, $op->FiscalAdvantage(320000, 6));
    }
}
