<?php
namespace PJH\Dice;

/**
 * A class for a dice
 */
class Dice
{
    /**
     * @var int $sides number of sides on a dice.
     */
    private $sides;

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
        return $this->sides;
    }
}
