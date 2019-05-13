<?php

namespace PJH\Dice;

use PHPUnit\Framework\TestCase;

/**
 * A class to test the Dice class
 */
class HistogramTest extends TestCase
{
    /**
     * Test that the inserted object returns what's expected
     *
     */
    public function testInjectData()
    {
        $histogram = new Histogram();
        $dice = new DiceHand();
        $histogram->injectData($dice);

        $res = $dice->getHistogramSerie();
        $exp = $histogram->getSerie();
        $this->assertEquals($exp, $res);
    }



    /**
     *
     *
     */
    public function testAddToSerie()
    {
        $histogram = new Histogram();
        $dice = new DiceHand();
        $histogram->injectData($dice);

        $testArr = [2, 3];

        $res = $histogram->addToSerie($testArr);
        $exp = 2;
        $this->assertContains($exp, $res);
    }



    // /**
    //  * Construct object and verify that the getLastRoll method returns wat it should.
    //  */
    // public function testGetLastRoll()
    // {
    //     $dice = new Dice();
    //     // $this->assertInstanceOf("\PJH\Dice\Dice", $dice);
    //
    //     $res = $dice->rollDice();
    //     $exp = $dice->getLastRoll();
    //     $this->assertEquals($exp, $res);
    // }
}
