<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 04/12/18
 * Time: 11:05
 */

namespace Tests;

use App\Service\TaxBase;
use PHPUnit\Framework\TestCase;

class TaxBaseTest extends TestCase
{
    public function testBaseUnderMax()
    {
        $op = new TaxBase();
        $this->assertEquals(400000, $op->taxBase(400000, 100));
        $this->assertEquals(210000, $op->taxBase(210000, 70));
        $this->assertEquals(250000, $op->taxBase(250000, 100));
    }
    public function testBaseOverMax()
    {
        $op = new TaxBase();
        $this->assertEquals(550000, $op->taxBase(1000000, 100));
        $this->assertEquals(412500, $op->taxBase(487500, 75));
        $this->assertEquals(275000, $op->taxBase(350000, 50));
    }
}