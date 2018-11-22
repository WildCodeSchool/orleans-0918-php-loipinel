<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 22/11/18
 * Time: 16:06
 */
namespace Tests;


use App\CalculateFiscalBase;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;


class FiscalBaseTest extends TestCase
{

    public function testBaseUnderMax()
    {
        $op = new CalculateFiscalBase;
        $this->assertEquals(400000, $op->FiscalBase(400000, 100));
        $this->assertEquals(210000, $op->FiscalBase(210000, 70));
        $this->assertEquals(250000, $op->FiscalBase(250000, 100));
    }

    public function testBaseOverMax()
    {
        $op = new CalculateFiscalBase;
        $this->assertEquals(550000, $op->FiscalBase(1000000, 100));
        $this->assertEquals(412500, $op->FiscalBase(487500, 75));
        $this->assertEquals(275000, $op->FiscalBase(350000, 50));
    }
}
