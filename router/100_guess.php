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
    return $app->response->redirect("guess/play");
});



/**
 * Play the game.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";
    $data = [
        "who" => "Bengt",
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
