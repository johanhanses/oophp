<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // init the session for the game start.
    $game = new PJH\Guess\Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("guess/play");
});



/**
 * Play the game - show game status
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    //Get the current settings from SESSION
    $doCheat = $_SESSION["doCheat"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    
    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;

    $data = [
        "guess" => $guess ?? null,
        "tries" => $tries,
        "number" => $number ?? null,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
        "res" => $res,
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



// /**
//  * Play the game - make a guess
//  */
// $app->router->post("guess/play", function () use ($app) {
//     // Assign incoming variables
//     $guess    = $_POST["guess"] ?? null;
//     $doInit   = $_POST["doInit"] ?? null;
//     $doGuess  = $_POST["doGuess"] ?? null;
//     $doCheat  = $_POST["doCheat"] ?? null;

//     $number   = $_SESSION["number"] ?? null;
//     $tries    = $_SESSION["tries"] ?? null;
//     $res = null;

//     if ($doInit || $number === null) {
//     //Init the game
//         $game = new PJH\Guess\Guess();
//         $_SESSION["number"] = $game->number();
//         $_SESSION["tries"] = $game->tries();
//         return $app->response->redirect("guess/play");
//     } 
//     return $app->response->redirect("guess/play");
// });   
    
    
    
    
    
//     elseif ($doGuess && $tries === 1) {
//     //re init the game if out of guesses
//         $game = new PJH\Guess\Guess();
//         $res = $game->startOver();
//         $_SESSION["number"] = $game->number();
//         $_SESSION["tries"] = $game->tries();
//         $_SESSION["res"] = $res;
//         $_SESSION["guess"] = $guess;
//     } elseif ($doGuess) {
//     // do a guess
//         $game = new PJH\Guess\Guess($number, $tries);
//         $res = $game->makeGuess($guess);
//         $_SESSION["tries"] = $game->tries();
//         $_SESSION["res"] = $res;
//         $_SESSION["guess"] = $guess;
//     } elseif ($doCheat) {
//     // cheat
//         $game = new PJH\Guess\Guess($number, $tries);
//         $res = $game->cheat();
//         $_SESSION["res"] = $res;
//     }












/**
 * Play the game - make a guess
 */
$app->router->post("guess/play", function () use ($app) {
    // Assign incoming variables
    $guess    = $_POST["guess"] ?? null;
    $doInit   = $_POST["doInit"] ?? null;
    $doGuess  = $_POST["doGuess"] ?? null;
    $doCheat  = $_POST["doCheat"] ?? null;

    $number   = $_SESSION["number"] ?? null;
    $tries    = $_SESSION["tries"] ?? null;
    $res = null;

    if ($doInit || $number === null) {
    //Init the game
        $game = new PJH\Guess\Guess();
        $_SESSION["number"] = $game->number();
        $_SESSION["tries"] = $game->tries();
        return $app->response->redirect("guess/play");
    } elseif ($doGuess && $tries === 1) {
    //re init the game if out of guesses
        $game = new PJH\Guess\Guess();
        $res = $game->startOver();
        $_SESSION["number"] = $game->number();
        $_SESSION["tries"] = $game->tries();
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
    } elseif ($doGuess) {
    // do a guess
        $game = new PJH\Guess\Guess($number, $tries);
        $res = $game->makeGuess($guess);
        $_SESSION["tries"] = $game->tries();
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
    } elseif ($doCheat) {
    // cheat
        $game = new PJH\Guess\Guess($number, $tries);
        $res = $game->cheat();
        $_SESSION["res"] = $res;
    }

    return $app->response->redirect("guess/play");
});
