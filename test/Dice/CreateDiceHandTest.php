<?php

namespace PJH\Dice;

use PHPUnit\Framework\TestCase;

/**
 * A test class for DiceHand class
 */
class CreateDiceHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateDiceHandNoArgs()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\PJH\Dice\Dice", $diceHand);
    }



    /**
     * Construct object and verify that the values() method returns wat it should.
     */
    public function testRollMethod()
    {
        $dice = new DiceHand();
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
        $dice = new DiceHand();
        $values = $dice->values();
        // $values1 = [2, 1];

        $res = array_sum($values);
        $exp = $dice->sum();
        $this->assertEquals($exp, $res);

        // $res1 = array_sum($values1);
        // $exp1 = $dice->sum();
        // $this->assertEquals($exp1, $res1);
    }



    /**
     * Construct object and verify that the sum() method returns the sum of values according to if statements.
     */
    public function testWinnerMethod()
    {
        $dice = new DiceHand();

        $totSum = 101;
        $plmessage = "";

        $exp = $plmessage === "Player got 100 points, player won, press restart for a new game";
        $res = $dice->checkWinner($totSum);
        $this->assertEquals($exp, $res);
    }
}
