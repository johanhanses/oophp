<?php

// namespace Anax\View;
namespace PJH\Movie;

// if (!$resultset) {
//     return;
// }


// var_dump($searchTitle);
// echo "<pre>";
// print_r($resultset);
// echo "</pre>";

?>

<!-- <form method="post" action="processTitle">
    <fieldset>
    <legend>Search</legend>
    <p>
        <label>Title (use % as wildcard):
            <input type="search" name="searchTitle" value=""/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
    </fieldset>
</form> -->


<form method="post">
    <fieldset>
    <legend>Manage movies</legend>

    <p>
        <label>Movie:<br>
        <select name="movieId">
            <option value="">Select movie...</option>
            <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= $movie->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" name="doAdd" value="Add">
        <input type="submit" name="doEdit" value="Edit">
        <input type="submit" name="doDelete" value="Delete">
    </p>
    </fieldset>
</form>
