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
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }



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
            "cmessage" => $cmessage ?? null,
            "hist" => $hist ?? null,
            "debugg" => $debugg ?? null
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
        $totSum = $this->app->session->get("totSum");
        $histogram = $this->app->session->get("hist");
        $serie = $this->app->session->get("allNums");

        $cGame = new ComputerHand();
        $cGame->rollaDice();

        $this->app->session->set("cGame", $cGame);
        $cmessage = null;
        $cGame->setMessage($cmessage);

        $cSum = $cGame->sum();
        $cTotSum = $this->app->session->get("cTotSum", null);
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















    /**
     * This sample method dumps the content of $app.
     * GET mountpoint/dump-app
     *
     * @return string
     */
    public function dumpAppActionGet() : string
    {
        // Deal with the action and return a response.
        $services = implode(", ", $this->app->getServices());
        return __METHOD__ . "<p>\$app contains: $services";
    }



    /**
     * Add the request method to the method name to limit what request methods
     * the handler supports.
     * GET mountpoint/info
     *
     * @return string
     */
    public function infoActionGet() : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}";
    }



    /**
     * This sample method action it the handler for route:
     * GET mountpoint/create
     *
     * @return string
     */
    public function createActionGet() : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}";
    }



    /**
     * This sample method action it the handler for route:
     * POST mountpoint/create
     *
     * @return string
     */
    public function createActionPost() : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}";
    }



    /**
     * This sample method action takes one argument:
     * GET mountpoint/argument/<value>
     *
     * @param mixed $value
     *
     * @return string
     */
    public function argumentActionGet($value) : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}, got argument '$value'";
    }



    /**
     * This sample method action takes zero or one argument and you can use - as a separator which will then be removed:
     * GET mountpoint/defaultargument/
     * GET mountpoint/defaultargument/<value>
     * GET mountpoint/default-argument/
     * GET mountpoint/default-argument/<value>
     *
     * @param mixed $value with a default string.
     *
     * @return string
     */
    public function defaultArgumentActionGet($value = "default") : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}, got argument '$value'";
    }



    /**
     * This sample method action takes two typed arguments:
     * GET mountpoint/typed-argument/<string>/<int>
     *
     * NOTE. Its recommended to not use int as type since it will still
     * accept numbers such as 2hundred givving a PHP NOTICE. So, its better to
     * deal with type check within the action method and throuw exceptions
     * when the expected type is not met.
     *
     * @param mixed $value with a default string.
     *
     * @return string
     */
    public function typedArgumentActionGet(string $str, int $int) : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}, got string argument '$str' and int argument '$int'.";
    }



    /**
     * This sample method action takes a variadic list of arguments:
     * GET mountpoint/variadic/
     * GET mountpoint/variadic/<value>
     * GET mountpoint/variadic/<value>/<value>
     * GET mountpoint/variadic/<value>/<value>/<value>
     * etc.
     *
     * @param array $value as a variadic parameter.
     *
     * @return string
     */
    public function variadicActionGet(...$value) : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}, got '" . count($value) . "' arguments: " . implode(", ", $value);
    }



    /**
     * Adding an optional catchAll() method will catch all actions sent to the
     * router. You can then reply with an actual response or return void to
     * allow for the router to move on to next handler.
     * A catchAll() handles the following, if a specific action method is not
     * created:
     * ANY METHOD mountpoint/**
     *
     * @param array $args as a variadic parameter.
     *
     * @return mixed
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function catchAll(...$args)
    {
        // Deal with the request and send an actual response, or not.
        //return __METHOD__ . ", \$db is {$this->db}, got '" . count($args) . "' arguments: " . implode(", ", $args);
        return;
    }
}
