<?php
namespace PJH\Dice;

/**
 * A dicehand for the computer, consisting of dices.
 */
class ComputerHand extends DiceHand
{
    /**
     * @var Dice $dices          Array of dices.
     * @var int  $values         Array consisting of last roll of the dices.
     * @var int  $computerSum    int consisting of the sum of last roll of the dices.
     * @var int  $cmessage       string consisting of messages about computers round to the player.
     * @var int  $rolls          int the number of times the computer throw it's dices.
     */
    private $dices;
    private $values;
    private $computerSum;
    private $cmessage;
    private $rolls;



    /**
     * Constructor to initiate the dicehand with a number of dices.
     * Throws the set number of dices 1, 2 or 3 times on random.
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
     * also store a message to the player depending on the return sum.
     *
     * @return int as the sum of all dices.
     * @return void string containing the message.
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
     * Get the total score of the computer
     *
     * @return int the total score of computer round.
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
     * check if computer is the winner and create a message.
     *
     * @return void assigns the message to @var $cmessage
     */
    public function checkWinner($cTotSum)
    {
        if ($cTotSum >= 100) {
            // return $this->cmessage = "Computer got a 100 score, computer won, press restart for a new game";

            $comessage = "Computer got a 100 score, computer won, press restart for a new game";
            $this->setMessage($comessage);
        }
    }



    /**
     * Set the message regarding computer round.
     *
     * @return void
     */
    public function setMessage($comessage)
    {
        $this->cmessage = $comessage;
    }



    /**
     * Get the message about computer round.
     *
     * @return string The message.
     */
    public function getMessage()
    {
        return $this->cmessage;
    }
}
