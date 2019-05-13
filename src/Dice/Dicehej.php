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
    protected $sides;
    private   $oneDice;


    /**
     * Constructor to throw one dice
     *
     *
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
        $this->oneDice = rand(1, $sides);
        // $this->sides = $this->rollDice();
    }



    public function rollDice()
    {
        $this->oneDice = rand(1, 6);
        return $this->oneDice;
    }

    public function getLastRoll()
    {
        return $this->oneDice;
    }
}
