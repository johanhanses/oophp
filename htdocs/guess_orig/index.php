<?php
/**
 * Guess my number main program
 */
require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";

//Start a session
session_name("johv18");
session_start();

//Incoming variables
$guess = $_SESSION["guess"] ?? null;
$doInit = $_SESSION["doInit"] ?? null;
$doGuess = $_SESSION["doGuess"] ?? null;
$doCheat = $_SESSION["doCheat"] ?? null;
$number = $_SESSION["number"] ?? null;
$tries = $_SESSION["tries"] ?? null;
$game = null;

if ($doInit || $number === null) {
    //Init the game
    $game = new Guess;
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();
} elseif ($doGuess && $tries === 1) {
    //re init the game if out of guesses
    $game = new Guess;
    $res = $game->startOver();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();
} elseif ($doGuess) {
    // do a guess
    $game = new Guess($number, $tries);
    $res = $game->makeGuess($guess);
    $_SESSION["tries"] = $game->tries();
}

// render page
require __DIR__ . "/view/guess_post.php";
require __DIR__ . "/view/debugger.php";
