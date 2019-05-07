<?php
namespace PJH\Dice;

/**
 * A dicehand, consisting of dices.
 */
class ComputerHand extends DiceHand
{
    /**
     * @var Dice $dices     Array of dices.
     * @var int  $values    Array consisting of last roll of the dices.
     */
    private $dices;
    private $values;

    private $computerSum;

    private $computerTotSum;

    private $win;

    private $cmessage;

    private $rolls;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to 2.
     */
    public function __construct(int $dices = 2)
    {
        $this->dices = [];
        $this->values = [];
        $this->rolls = rand(1, 3);
        // $this->cmessage = "The computer has rolled, the player can now roll again";

        for ($j = 0; $j < $this->rolls; $j++) {

            for ($i = 0; $i < $dices; $i++) {
                $oneThrow = new Dice();

                $this->dices[] = $oneThrow->rollDice();
                $this->values[] = null;
            }

            if (in_array(1, $this->values())) {
                $j = $this->rolls;
            }
        }
    }



    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll()
    {
        $this->dices = $this->dices;
    }



    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        $this->values = $this->dices;
        return $this->values;
    }



    /**
     * Get the Sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        if (in_array(1, $this->values())) {
            $this->cmessage = "The computer rolled a 1-dice, the player can now roll";
            return $this->computerSum = 0;
        } else {
            $this->computerSum = array_sum($this->values);
            $this->cmessage = "The computer has rolled, the player can now roll again";
            return $this->computerSum;
        }
    }



    /**
     * Get the total score of a player
     *
     * @return void assigns the message to @var
     */
    public function totalSum($cSum, $cTotSum)
    {
        if ($cSum) {
            return $cTotSum = $cTotSum + $cSum;
        } else {
            return $cTotSum = 0;
        }
    }



    /**
     * check if computer is wthe winner.
     *
     * @return @var string assigns the message to @var
     */
    public function checkWinner($cTotSum)
    {
        if ($cTotSum >= 100) {
            return $this->cmessage = "Computer got a 100 score, computer won, press restart for a new game";
        }
    }



    /**
     * Set the message to the computer
     *
     * @return void The message to the player
     */
    public function setMessage($comessage)
    {
        $this->cmessage = $comessage;
    }



    /**
     * Get the message to the $computerSum
     *
     * @return string The message to the player
     */
    public function getMessage()
    {
        return $this->cmessage;
    }
}
