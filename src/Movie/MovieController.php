<?php

namespace PJH\Movie;

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
class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";



    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
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
    // public function indexAction() : string
    // {
    //     // Deal with the action and return a response.
    //     return __METHOD__ . ", \$db is {$this->db}";
    // }



    /**
     * index
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "Movie database | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $resultset = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movie/header");
        $this->app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * search-title landing and view result
     *
     * @return object
     */
    public function searchtitleActionGet() : object
    {
        $title = "Search database | oophp";
        $resultset = $this->app->session->get("resultset");
        // $searchTitle = $this->app->session->get("searchTitle");

        $data = [
            "resultset" => $resultset ?? null,
        ];

        $this->app->page->add("movie/header");
        $this->app->page->add("movie/searchtitle", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * search-title process
     *
     * @return void
     */
    public function processTitleActionPost() : object
    {
        $searchTitle = getPost("searchTitle");
        if ($searchTitle) {
            $this->app->db->connect();
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$searchTitle]);
        }

        $this->app->session->set("resultset", $resultset);
        $this->app->session->set("searchTitle", $searchTitle);

        return $this->app->response->redirect("movie/searchtitle");
    }



    /**
     * search-year landing and view result
     *
     * @return object
     */
    public function searchyearActionGet() : object
    {
        $title = "Search database | oophp";
        $resultset = $this->app->session->get("resultset2");

        $data = [
            "resultset" => $resultset ?? null,
        ];

        $this->app->page->add("movie/header");
        $this->app->page->add("movie/searchyear", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * search-year process
     *
     * @return void
     */
    public function processYearActionPost() : object
    {
        $year1 = getPost("year1");
        $year2 = getPost("year2");
        if ($year1 && $year2) {
            $this->app->db->connect();
            $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
            $this->app->db->connect();
            $sql = "SELECT * FROM movie WHERE year >= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
            $this->app->db->connect();
            $sql = "SELECT * FROM movie WHERE year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year2]);
        }

        $this->app->session->set("resultset2", $resultset);
        return $this->app->response->redirect("movie/searchyear");
    }



    /**
     * manage db
     *
     * @return object
     */
    public function selectActionGet() : object
    {
        $title = "Manage database | oophp";
        // $resultset = $this->app->session->get("resultset2");

        $data = [
            "resultset" => $resultset ?? null,
        ];

        $this->app->page->add("movie/header");
        $this->app->page->add("movie/select", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * reset
     *
     * @return object
     */
    public function resetActionGet() : object
    {
        $title = "Reset database | oophp";
        // $resultset = $this->app->session->get("resultset2");

        // $data = [
        //     "resultset" => $resultset ?? null,
        // ];

        $this->app->page->add("movie/header");
        $this->app->page->add("movie/reset");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

















}
