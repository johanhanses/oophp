<?php

namespace PJH\Dice;

/**
 * A dice which has the ability to present data to be used for creating a histogram.
 */
class DiceHistogram2 extends Dice implements HistogramInterface
{
    use HistogramTrait2;



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
    public function rollDice()
    {
        $this->serie[] = parent::rollDice();
        return $this->getLastRoll();
    }
}
