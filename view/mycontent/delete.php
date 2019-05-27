<?php

namespace PJH\MyContent;

?><form method="post">
    <fieldset>
    <legend>Delete</legend>

    <input type="hidden" name="contentId" value="<?= esc($content->id) ?>"/>

    <p>Are you sure you want to delete entry <code><?= esc($content->title) ?></code>?</p>

    <p>
        <input type="submit" name="doDelete" value="Delete"/>

        <input type="submit" name="doReturn" value="No"/>
    </p>
    </fieldset>
</form>
