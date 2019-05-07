<?php

namespace PJH\Dice;

use PHPUnit\Framework\TestCase;

/**
 * A class to test the Dice class
 */
class DiceCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateDiceNoArgs()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\PJH\Dice\Dice", $dice);
    }



    /**
     * Construct object and verify that the getLastRoll method returns wat it should.
     */
    public function testGetLastRoll()
    {
        $dice = new Dice();
        // $this->assertInstanceOf("\PJH\Dice\Dice", $dice);

        $res = $dice->rollDice();
        $exp = $dice->getLastRoll();
        $this->assertEquals($exp, $res);
    }
}
