<?php
namespace PJH\Dice;

/**
 * A class for a dice
 */
class Dice
{
    /**
     * @var int $sides number of sides on a dice.
     * @var int $oneDice the value of ine dice.
     */
    protected $sides;
    private $oneDice;


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
        $this->sides = 6;
        $this->oneDice = rand(1, $this->sides);
        return $this->oneDice;
    }

    public function getLastRoll()
    {
        return $this->oneDice;
    }
}
