<?php

namespace PJH\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "index ffs!";
    }



    /**
     * init.
     *
     * @return object
     */
    public function initAction() : object
    {
        $this->app->session->set("message", "Welcome, player can now roll the dice");
        $this->app->session->set("allNums", []);

        return
        $this->app->response->redirect("dice1/play");
    }



    /**
     * play.
     *
     * @return object
     */
    public function playActionGet() : object
    {
        $title = "Tärningsspelet 100(1)";

        $message = $this->app->session->get("message");

        if ($this->app->session->has("cGame")) {
            $cGame = $this->app->session->get("cGame");
            $cValues = $cGame->values() ?? null;
            $cSum = $cGame->sum() ?? null;
            $cTotSum = $this->app->session->get("cTotSum", null);
            $message = $cGame->checkWinner($cTotSum) ?? $this->app->session->get("message");
            $this->app->session->set("cTotSum", $cTotSum);
        }

        if ($this->app->session->has("game")) {
            $game = $this->app->session->get("game");
            $values = $game->values() ?? null;
            $sum = $game->sum();
            $totSum = $this->app->session->get("totSum", $sum);
            $message = $game->checkWinner($totSum) ?? $this->app->session->get("message");
            $this->app->session->set("totSum", $totSum);
        }

        $toTextIfWorks = $this->app->session->get("allNums");
        $histogram = $this->app->session->get("hist");
        ($histogram) ? $hist = $histogram->getAsText($toTextIfWorks) : null;
        $this->app->session->set("allNums", $toTextIfWorks);

        $data = [
            "values" => $values ?? null,
            "sum" => $sum ?? null,
            "tot" => $totSum ?? null,
            "message" => $message ?? null,
            "cValues" => $cValues ?? null,
            "cSum" => $cSum ?? null,
            "cTotSum" => $cTotSum ?? null,
            // "cmessage" => $cmessage ?? null,
            "hist" => $hist ?? null
            // "debugg" => $debugg ?? null
        ];

        $this->app->page->add("dice1/play", $data);
        // $this->app->page->add("dice/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * process, this is where the player action happens.
     *
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function processActionPost() : object
    {
        // Assign incoming variables
        $game = $this->app->session->get("game");

        $check = $this->app->session->get("allNums");
        if ($check === null) {
            $serie[] = $this->app->session->get("allNums");
        } else {
            $serie = $this->app->session->get("allNums");
        }

        $game = new DiceHand();
        $game->rollaDice();

        $message = null;
        $game->setMessage($message);
        $sum = $game->sum();
        $totSum = $this->app->session->get("totSum");
        $totSum = $game->totalSum($sum, $totSum);
        $message = $game->getMessage();

        $histogram = new Histogram();
        $histogram->injectData($game);
        $allNums = $histogram->addToSerie($serie);

        $this->app->session->set("allNums", $allNums);
        $this->app->session->set("hist", $histogram);
        $this->app->session->set("message", $message);
        $this->app->session->set("sum", $sum);
        $this->app->session->set("totSum", $totSum);
        $this->app->session->set("game", $game);

        return $this->app->response->redirect("dice1/play");
    }



    /**
     * post save, this is where the computer does it's thing.
     *
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function saveActionPost() : object
    {
        // Assign incoming variables
        $game = $this->app->session->get("game");
        $totSum = $this->app->session->get("totSum", 0);
        $cTotSum = $this->app->session->get("cTotSum", 0);
        $histogram = $this->app->session->get("hist");
        $serie = $this->app->session->get("allNums");

        $cGame = new ComputerHand($totSum, $cTotSum, 2);
        $cGame->rollaDice();

        $this->app->session->set("cGame", $cGame);
        $cmessage = null;
        $cGame->setMessage($cmessage);

        $cSum = $cGame->sum();
        $cTotSum = $cGame->totalSum($cSum, $cTotSum);
        $cmessage = $cGame->getMessage();

        $histogram->injectData($cGame);
        $allNums = $histogram->addToSerie($serie);

        $this->app->session->set("allNums", $allNums);
        $this->app->session->set("hist", $histogram);
        $this->app->session->set("message", $cmessage);
        $this->app->session->set("cTotSum", $cTotSum);
        $this->app->session->set("totSum", $totSum);
        $this->app->session->set("game", $game);

        return $this->app->response->redirect("dice1/play");
    }



    /**
     * post restart.
     *
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function restartActionPost() : object
    {
        $this->app->session->destroy();

        return $this->app->response->redirect("dice1/init");
    }



    /**
     * debug.
     *
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug for ffs";
    }
}
