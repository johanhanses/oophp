<?php

namespace PJH\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    private $number = null;
    private $tries = 6;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->tries = $tries;
        if ($number === -1) {
            $number = rand(1, 100);
        }
        $this->number = $number;
    }



    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    public function random() : void
    {
        $this->number = rand(1, 100);
    }




    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function tries() : int
    {
        return $this->tries;
    }



    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number() : int
    {
        return $this->number;
    }


    /**
     * Get the secret number as a cheat
     *
     * @return string as a message with the secret number.
     */
    public function cheat() : string
    {
        $res = "Numret jag tänker på är: " . $this->number;
        return $res;
    }



    /**
     * @return string if user presses "gissa" even though its game over
     */
    public function startOver() : string
    {
        $res = "Slut på gissningar, spelet börjar om,";
        return $res;
    }

    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess(int $guess)
    {
        if ($guess < 1 || $guess > 100) {
            // session_destroy();
            throw new GuessException("Gissa på ett nummer FRÅN 1 TILL 100.");
        }

        --$this->tries;

        if ($guess === $this->number) {
            $res = "Du gissade {$guess} vilket är rätt gissat, börja om för ett nytt spel";
        } elseif ($guess > $this->number) {
            $res = "Din gissning {$guess} är för hög";
        } else {
            $res = "Din gissning {$guess} är för låg";
        }

        return $res;
    }
}
