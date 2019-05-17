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

<form method="post" action="processYear">
    <fieldset>
    <legend>Search</legend>
    <p>
        <label>Created between:
        <input type="number" name="year1" placeholder="1900" min="1900" max="2100"/>
        -
        <input type="number" name="year2" placeholder="2100" min="1900" max="2100"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
    </fieldset>
</form>




<?php
if (!$resultset) {
    return;
}
?>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="../<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
<?php endforeach; ?>
</table>
