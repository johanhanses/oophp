<?php

namespace PJH\MyContent;

?><form method="post">
    <input type="submit" name="reset" value="Reset database">
    <?= (!empty($output)) ? $output : null ?>
</form>
