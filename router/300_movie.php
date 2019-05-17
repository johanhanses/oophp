<?php

/**
 * Show all movies.
 */
// $app->router->get("movie", function () use ($app) {
//     $title = "Movie database | oophp";
//
//     // $title = "Show all movies";
//     // $view[] = "view/show-all.php";
//     // $sql = "SELECT * FROM movie;";
//     // $resultset = $db->executeFetchAll($sql);
//
//     $app->db->connect();
//     $sql = "SELECT * FROM movie;";
//     $resultset = $app->db->executeFetchAll($sql);
//
//     $app->page->add("movie/index", [
//         "resultset" => $resultset,
//     ]);
//
//     return $app->page->render([
//         "title" => $title,
//     ]);
// });
