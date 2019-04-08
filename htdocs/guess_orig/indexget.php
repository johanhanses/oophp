<?php
/**
 * Guess my number main program
 */


include __DIR__ . "/autoload.php";
include __DIR__ . "/config.php";


//incoming variables
$number = $_GET["number"] ?? null;
$tries = $_GET["tries"] ?? null;
$guess = $_GET["guess"] ?? null;
$doInit = $_GET["doInit"] ?? null;
$doGuess = $_GET["doGuess"] ?? null;
$doCheat = $_GET["doCheat"] ?? null;

//Init the game
if ($doInit || $number === null) {
    $number = rand(1, 100);
    $tries = 6;
    header("Location: indexget.php?tries=$tries&number=$number");
} elseif ($doGuess && $tries === "0") {
    $number = rand(1, 100);
    $tries = 6;
    header("Location: indexget.php?tries=$tries&number=$number");
} elseif ($doGuess) {
    $tries -= 1;
    if ($tries === 0) {
        $res = "Slut på gissningar spelet börjar om";
    } elseif ($guess > $number) {
        $res = "Din gissning $guess är för hög.";
    } elseif ($guess < $number) {
        $res = "Din gissning $guess är för låg.";
    } elseif ($guess === $number) {
        $res = "Din gissning $guess är RÄTT, spelet börjar om.";
        $tries = "0";
    }
}

?>
<!--render the page-->
<h1>Gissa numret</h1>

<p>Gissa på ett nummer mellan 1 och 100, du har <?= $tries ?> gissningar kvar.</p>

<form>
    <input type="text" name="guess">
    <input type="hidden" name="number" value="<?= $number ?>">
    <input type="hidden" name="tries" value="<?= $tries ?>">
    <input type="submit" name="doGuess" value="Gissa">
    <input type="submit" name="doInit" value="Börja om">
    <input type="submit" name="doCheat" value="Fuska">
</form>

<?php if ($doGuess) : ?>
    <p><?= $res ?></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>Fusk: Det nummer jag tänker på är <?= $number ?>.</p>
<?php endif; ?>

<pre>
<?= var_dump($_GET) ?>
