<?php
namespace PJH\Dice;

/**
 * A player dicehand, consisting of dices.
 */
class DiceHand extends Dice implements HistogramInterface
{
    use HistogramTrait2;



    /**
     * @var Dice    $dices        Array of dices.
     * @var int     $values       Array consisting of last roll of the dices.
     * @var int     $playerSum    int consisting of the sum of last roll of the dices.
     * @var string  $message      string consisting of messages to the player.
     */
    private $dices;
    private $values;
    private $playerSum;
    private $message;



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
     * also store a message to the player depending on the return sum.
     *
     * @return int as the sum of all dices.
     * @return void string containing the message.
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
     * @return int the total score of players round.
     */
    public function totalSum($sum, $totSum)
    {
        if ($sum) {
            return $totSum = $totSum + $sum;
        } else {
            return $totSum = $sum;
        }
    }



    /**
     * Check if player is a winner and create a message.
     *
     * @return void assigns the message to @var $plmessage
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



    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return $this->sides;
    }



    /**
     * Roll the dice, remeber it's value in the serie and return its value.
     *
     * @return int the value of the rolled dice.
     */
    public function rollaDice()
    {
        parent::rollDice();

        $this->serie = $this->dices;
        return $this->getLastRoll();
    }
}
