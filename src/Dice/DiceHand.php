<?php
namespace PJH\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand extends Dice
{
    /**
     * @var Dice $dices     Array of dices.
     * @var int  $values    Array consisting of last roll of the dices.
     */
    private $dices;
    private $values;

    private $playerSum;

    private $playerTotSum;

    private $message;

    private $round = 0;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to 2.
     */
    public function __construct(int $dices = 2)
    {
        $this->dices = [];
        $this->values = [];

        for ($i = 0; $i < $dices; $i++) {
            $oneThrow = new Dice();

            $this->dices[] = $oneThrow->rollDice();
            $this->values[] = null;
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
            $this->message = "Player rolled a 1-dice, press Computer roll-button to see the computers round.";
            return $this->playerSum = 0;
        } else {
            $this->playerSum = array_sum($this->values);
            $this->message = "The player can roll again or save the points, let the computer roll";
            return $this->playerSum;
        }
    }



    /**
     * Get the total score of a player
     *
     * @return void assigns the message to @var
     */
    public function totalSum($sum, $totSum)
    {
        if ($sum) {
            return $totSum = $totSum + $sum;
        } else {
            return $totSum = null;
        }
    }



    /**
     * Get the total score of a player
     *
     * @return void assigns the message to @var
     */
    public function checkWinner($totSum)
    {
        if ($totSum >= 100) {
            $plmessage = "Player got 100 points, player won, press restart for a new game";
            $this->setMessage($plmessage);
        }
    }



    /**
     * Set the message to the computer
     *
     * @return void The message to the player
     */
    public function setMessage($plmessage)
    {
        $this->message = $plmessage;
    }



    /**
     * Get the message to the player
     *
     * @return string The message to the player
     */
    public function getMessage()
    {
        return $this->message;
    }
}
