<?php

namespace PJH\Dice;

use PHPUnit\Framework\TestCase;

/**
 * A test class for ComputerHand class
 */
class CreateComputerHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateComputerHand()
    {
        $diceHand = new ComputerHand(12, 14, 2);
        $this->assertInstanceOf("\PJH\Dice\Dice", $diceHand);
    }



    /**
     * Construct object and verify that the values() method returns wat it should.
     */
    public function testRollMethod()
    {
        $dice = new ComputerHand(12, 14, 2);
        // $this->assertInstanceOf("\PJH\Dice\Dice", $dice);

        $res = $dice->roll();
        $exp = null;

        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the sum() method returns the sum of values according to if statements.
     */
    public function testSumMethod()
    {
        $dice = new ComputerHand(12, 14, 2);
        $values = $dice->values();

        $res = array_sum($values);
        $exp = $dice->sum();
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the sum() method returns the sum of values according to if statements.
     */
    public function testWinnerMethod()
    {
        $dice = new ComputerHand(101, 90, 2);

        $totSum = 101;
        $comessage = "";

        $exp = $comessage === "Player got 100 points, player won, press restart for a new game";
        $res = $dice->checkWinner($totSum);
        $this->assertEquals($exp, $res);
    }
}
