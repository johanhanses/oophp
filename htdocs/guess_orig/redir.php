<?php

/**
 * A processing page that does a redirect.
 */

require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";

//Start a session
session_name("johv18");
session_start();

$guess = $_POST["guess"];
$doGuess = $_POST["doGuess"];
$doInit = $_POST["doInit"];
$doCheat = $_POST["doCheat"];

$_SESSION["guess"] = $guess;
$_SESSION["doGuess"] = $doGuess;
$_SESSION["doInit"] = $doInit;
$_SESSION["doCheat"] = $doCheat;

// var_dump($_POST);
// var_dump($_SESSION);

// // Redirect to a result page.
$url = "index.php";
header("Location: $url");
