<?php
/**
 * Guess my number main program
 */

require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";

//incoming variables
$number = $_POST["number"] ?? null;
$tries = $_POST["tries"] ?? null;
$guess = $_POST["guess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;
$res = null;

//Init the game
if ($doInit || $number === null) {
    $number = rand(1, 100);
    $tries = 6;
    // header("Location: indexget.php?tries=$tries&number=$number");
} elseif ($doGuess && $tries === "0") {
    $number = rand(1, 100);
    $tries = 6;
    // header("Location: indexget.php?tries=$tries&number=$number");
} elseif ($doGuess) {
    $tries -= 1;
    if ($tries === 0) {
        $res = "Slut på gissningar spelet börjar om";
    } elseif ($guess > $number) {
        $res = "Din gissning $guess är för hög.";
    } elseif ($guess < $number) {
        $res = "Din gissning $guess är för låg.";
    } elseif ($guess === $number) {
        $res = "Din gissning $guess är RÄTT, spelet börjar om.";
        $tries = "0";
    }
}

// render page
require __DIR__ . "/view/guess_post.php";
