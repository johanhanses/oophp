<?php

namespace Anax\View;

?>

<!doctype html>
<!-- <html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $title . $titleExtended ?></title>
    <link rel="stylesheet" href="css/style.css">
</head> -->
<body>

<navbar class="navbar">
    <br>
    <!-- <a href="?route=select">SELECT *</a> | -->
    <a href="<?= url("movie/index") ?>">Show all movies</a> |
    <a href="<?= url("movie/reset") ?>">Reset database</a> |
    <a href="<?= url("movie/searchtitle") ?>">Search title</a> |
    <a href="<?= url("movie/searchyear") ?>">Search year</a> |
    <!-- <a href="?route=movie-select">Select</a> | -->
    <a href="<?= url("movie/select") ?>">Manage database</a> |
    <!-- <a href="?route=show-all-sort">Show all sortable</a> | -->
    <!-- <a href="?route=show-all-paginate">Show all paginate</a> | -->
</navbar>

<h1>My Movie Database</h1>

<main>
