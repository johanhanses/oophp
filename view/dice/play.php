<?php
namespace PJH\Dice;



// $game = new DiceHand();
// $player->roll();
// echo "<pre>";
// var_dump($_SESSION);
// var_dump($message);
// echo "</pre>";

?><h1>Tärningsspelet 100</h1>
<div class="game">
    <div class="player">
        <h2>Player</h2>
        <p><?= ($values) ? implode(", ", $values) : null ?></p>
        <p><?= $message ?></p>
        <p>The sum of this hand is: <?= $sum ?>.</p>
        <p>Total player game sum is: <?= $tot ?>.</p>

        <form method="POST" action="process">
            <input type="submit" name="rollAgain" value="Player roll again">
        </form>
        <form method="POST" action ="save">
            <input type="submit" name="save" value="Computer roll or Save and computer roll">
        </form>
        <form method="POST" action ="restart">
            <input type="submit" name="restart" value="Restart">
        </form>
    </div>

    <div class="computer">
        <h2>Computer</h2>
        <p><?= ($cValues) ? implode(", ", $cValues) : null ?></p>
        <p><?= $cmessage ?></p>
        <p>The sum of the computers hand is: <?= $cSum ?>.</p>
        <p>Total computer game sum is: <?= $cTotSum ?>.</p>
    </div>
</div>
