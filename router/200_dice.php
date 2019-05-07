<?php
namespace PJH\Dice;

/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("dice/init", function () use ($app) {
    $_SESSION["game"] = new DiceHand();
    $_SESSION["message"] = "";
    return $app->response->redirect("dice/play");
});



/**
 * Play the game - show game status
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Tärningsspelet 100";

    if (isset($_SESSION["cGame"])) {
        $cValues = $_SESSION["cGame"]->values() ?? null;
        $cSum = $_SESSION["cGame"]->sum() ?? null;
        $cTotSum = $_SESSION["cTotSum"] ?? null;
        $message = $_SESSION["cGame"]->checkWinner($cTotSum) ?? $_SESSION["message"];
        $_SESSION["cTotSum"] = $cTotSum;
    }

    $values = $_SESSION["game"]->values() ?? null;
    $sum = $_SESSION["game"]->sum();
    $totSum = $_SESSION["totSum"] ?? $sum;
    $message = $_SESSION["game"]->checkWinner($totSum) ?? $_SESSION["message"];
    $_SESSION["totSum"] = $totSum;

    $data = [
        "values" => $values ?? null,
        "sum" => $sum ?? null,
        "tot" => $totSum ?? null,
        "message" => $message ?? null,
        "cValues" => $cValues ?? null,
        "cSum" => $cSum ?? null,
        "cTotSum" => $cTotSum ?? null,
        "cmessage" => $cmessage ?? null,
    ];

    $app->page->add("dice/play", $data);
    // $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Player rolls dices
 */
$app->router->post("dice/process", function () use ($app) {
    // Assign incoming variables
    $game = new DiceHand();
    $message = null;
    $game->setMessage($message);
    $sum = $game->sum();
    $totSum = $_SESSION["totSum"];
    $totSum = $_SESSION["game"]->totalSum($sum, $totSum);
    $message = $game->getMessage();

    $_SESSION["message"] = $message;
    $_SESSION["sum"] = $sum;
    $_SESSION["totSum"] = $totSum;
    $_SESSION["game"] = $game;

    return $app->response->redirect("dice/play");
});



/**
 * Player saves state. Computers round
 */
$app->router->post("dice/save", function () use ($app) {
    // Assign incoming variables
    $game = $_SESSION["game"];
    $totSum = $_SESSION["totSum"];

    $_SESSION["cGame"] = new ComputerHand();
    $cGame = $_SESSION["cGame"];
    $cmessage = null;
    $cGame->setMessage($cmessage);

    $cSum = $_SESSION["cGame"]->sum();
    $cTotSum = $_SESSION["cTotSum"] ?? null;
    $cTotSum = $_SESSION["cGame"]->totalSum($cSum, $cTotSum);
    $cmessage = $_SESSION["cGame"]->getMessage();

    $_SESSION["message"] = $cmessage;
    $_SESSION["cTotSum"] = $cTotSum;
    $_SESSION["totSum"] = $totSum;
    $_SESSION["game"] = $game;

    return $app->response->redirect("dice/play");
});



/**
 * Player resets game
 */
$app->router->post("dice/restart", function () use ($app) {
    $_SESSION = [];
    session_destroy();

    return $app->response->redirect("dice/init");
});
