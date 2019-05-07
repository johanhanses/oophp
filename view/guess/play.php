<?php

namespace PJH\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());




?>
<h1>Gissa mitt nummer</h1>

<p>Gissa på ett nummer mellan 1 och 100, du har <?= $tries ?> gissningar kvar.</p>

<!-- <form method="POST" action="redir.php"> -->
<form method="POST">
    <input type="text" name="guess">
    <input type="submit" name="doGuess" value="Gissa">
    <input type="submit" name="doInit" value="Börja om">
    <input type="submit" name="doCheat" value="Fuska">
</form>

<?php if ($res) : ?>
    <p> <?= $res ?></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>Fusk: Det nummer jag tänker på är <?= $res ?>.</p>
<?php endif; ?>
