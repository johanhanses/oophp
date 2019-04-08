<h1>Gissa numret</h1>

<p>Gissa på ett nummer mellan 1 och 100, du har <?= $tries ?> gissningar kvar.</p>

<form method="POST" action="redir.php">
    <input type="text" name="guess">
    <input type="submit" name="doGuess" value="Gissa">
    <input type="submit" name="doInit" value="Börja om">
    <input type="submit" name="doCheat" value="Fuska">
</form>

<?php if ($doGuess) : ?>
    <p> <?= $res ?></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>Fusk: Det nummer jag tänker på är <?= $number ?>.</p>
<?php endif; ?>
