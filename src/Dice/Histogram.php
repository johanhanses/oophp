<?php

namespace PJH\Dice;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie    The numbers stored in sequence.
     * @var array $series   All the numbers from a round stored in sequence.
     * @var int   $min      The lowest possible integer number.
     * @var int   $max      The highest possible integer number.
     */
    private $serie = [];
    private $series = [];
    private $min;
    private $max;



    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object)
    {
        $this->serie = $object->getHistogramSerie();
        $this->min = $object->getHistogramMin();
        $this->max = $object->getHistogramMax();
    }




    /**
     * Get the serie.
     *
     * @return array with the serie
     */
    public function getSerie()
    {
        return $this->serie;
    }




    /**
     * Add the previous numbers from session to the current in an array.
     *
     * @return array containing all dices thrown in a round.
     */
    public function addToSerie($serie)
    {
        $arrContainer = $this->getSerie();

        $this->series = array_merge($arrContainer, $serie);
        return $this->series;
    }



    /**
     * Print out the histogram, default is to print out only the numbers
     * in the serie, but when $min and $max is set then print also empty
     * values in the serie, within the range $min, $max.
     *
     * @return string representing the histogram.
     */
    public function getAsText($allNumbers)
    {
        $string = "";
        $numbers = array_count_values($allNumbers);
        ksort($numbers);

        if ($this->min || $this->max) {
            for ($i = $this->min; $i <= $this->max; $i++) {
                $row = "";
                foreach ($allNumbers as $value) {
                    if ($value == $i) {
                        $row = $row . "*";
                    }
                }
                $string .= $i . ": " . $row . "<br>";
            }
        }

        if ($this->min == null || $this->max == null) {
            foreach ($numbers as $number => $value) {
                $string .= $number . ": " . str_repeat("*", $value) . "<br>";
            }
        }
        return $string;
    }

    // public function getAsText()
    // {
    //     $string = "";
    //     $numbers = array_count_values($this->serie);
    //     ksort($numbers);
    //
    //     if ($this->min || $this->max) {
    //         for ($i = $this->min; $i <= $this->max; $i++) {
    //             $row = "";
    //             foreach ($this->serie as $value) {
    //                 if ($value == $i) {
    //                 $row = $row . "*";
    //                 }
    //             }
    //             $string .= $i . ": " . $row . "<br>";
    //         }
    //     }
    //
    //     if ($this->min == null || $this->max == null) {
    //         foreach ($numbers as $number => $value) {
    //             $string .= $number . ": " . str_repeat("*", $value) . "<br>";
    //         }
    //     }
    //     return $string;
    // }
}
