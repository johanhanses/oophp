<?php
namespace PJH\Dice;

/**
 * A class for a dice
 */
class Dice
{
    /**
     * @var int $sides number of sides on a dice.
     * @var int $lastRoll last roll of a dice.
     */
    private $sides;
    private $lastRoll;


    /**
     * Constructor to throw one dice
     *
     *
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = rand(1, $sides);
        $this->sides = $this->rollDice();
    }



    public function rollDice()
    {
        $this->sides = rand(1, 6);
        return $this->sides;
    }



    public function getLastRoll()
    {
        return $this->lastRoll = $this->sides;
    }
}
