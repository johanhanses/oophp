<?php

namespace PJH\TextFilter;

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
class MyFilterController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * index
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "Textfiltertest | oophp";

        // $this->app->db->connect();
        // $sql = "SELECT * FROM movie;";
        // $resultset = $this->app->db->executeFetchAll($sql);

        // $this->app->page->add("movie/header");
        $this->app->page->add("textfilter/index", [
            // "resultset" => $resultset,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
