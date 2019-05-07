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
    public function testCreateComputerHandNoArgs()
    {
        $diceHand = new ComputerHand();
        $this->assertInstanceOf("\PJH\Dice\Dice", $diceHand);
    }



    /**
     * Construct object and verify that the values() method returns wat it should.
     */
    public function testRollMethod()
    {
        $dice = new ComputerHand();
        // $this->assertInstanceOf("\PJH\Dice\Dice", $dice);
        $diceroll[] = $dice->roll();
        $res = $diceroll;

        $exp = $dice->values();

        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the sum() method returns the sum of values according to if statements.
     */
    public function testSumMethod()
    {
        $dice = new ComputerHand();
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
        $dice = new ComputerHand();

        $totSum = 101;
        $comessage = "";

        $exp = $comessage === "Player got 100 points, player won, press restart for a new game";
        $res = $dice->checkWinner($totSum);
        $this->assertEquals($exp, $res);
    }
}
