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



    // /**
    //  * search-title landing and view result
    //  *
    //  * @return object
    //  */
    // public function searchtitleActionGet() : object
    // {
    //     $title = "Search database | oophp";
    //     $resultset = $this->app->session->get("resultset");
    //     // $searchTitle = $this->app->session->get("searchTitle");
    //
    //     $data = [
    //         "resultset" => $resultset ?? null,
    //     ];
    //
    //     $this->app->page->add("movie/header");
    //     $this->app->page->add("movie/searchtitle", $data);
    //
    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }
    //
    //
    //
    // /**
    //  * search-title process
    //  *
    //  * @return object
    //  */
    // public function processTitleActionPost() : object
    // {
    //     $searchTitle = getPost("searchTitle");
    //     if ($searchTitle) {
    //         $this->app->db->connect();
    //         $sql = "SELECT * FROM movie WHERE title LIKE ?;";
    //         $resultset = $this->app->db->executeFetchAll($sql, [$searchTitle]);
    //     }
    //
    //     $this->app->session->set("resultset", $resultset);
    //     $this->app->session->set("searchTitle", $searchTitle);
    //
    //     return $this->app->response->redirect("movie/searchtitle");
    // }
    //
    //
    //
    // /**
    //  * search-year landing and view result
    //  *
    //  * @return object
    //  */
    // public function searchyearActionGet() : object
    // {
    //     $title = "Search database | oophp";
    //     $resultset = $this->app->session->get("resultset2");
    //
    //     $data = [
    //         "resultset" => $resultset ?? null,
    //     ];
    //
    //     $this->app->page->add("movie/header");
    //     $this->app->page->add("movie/searchyear", $data);
    //
    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }
    //
    //
    //
    // /**
    //  * search-year process
    //  *
    //  * @return object
    //  */
    // public function processYearActionPost() : object
    // {
    //     $year1 = getPost("year1");
    //     $year2 = getPost("year2");
    //     if ($year1 && $year2) {
    //         $this->app->db->connect();
    //         $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
    //         $resultset = $this->app->db->executeFetchAll($sql, [$year1, $year2]);
    //     } elseif ($year1) {
    //         $this->app->db->connect();
    //         $sql = "SELECT * FROM movie WHERE year >= ?;";
    //         $resultset = $this->app->db->executeFetchAll($sql, [$year1]);
    //     } elseif ($year2) {
    //         $this->app->db->connect();
    //         $sql = "SELECT * FROM movie WHERE year <= ?;";
    //         $resultset = $this->app->db->executeFetchAll($sql, [$year2]);
    //     }
    //
    //     $this->app->session->set("resultset2", $resultset);
    //     return $this->app->response->redirect("movie/searchyear");
    // }
    //
    //
    //
    // /**
    //  * manage db view
    //  *
    //  * @return object
    //  */
    // public function selectActionGet() : object
    // {
    //     $title = "Manage database | oophp";
    //
    //     $this->app->db->connect();
    //     $sql = "SELECT id, title FROM movie;";
    //     $movies = $this->app->db->executeFetchAll($sql);
    //
    //     $data = [
    //         "movies" => $movies ?? null,
    //     ];
    //
    //     $this->app->page->add("movie/header");
    //     $this->app->page->add("movie/select", $data);
    //
    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }
    //
    //
    //
    // /**
    //  * process for manage db
    //  *
    //  * @return object
    //  */
    // public function processSelectActionPost() : object
    // {
    //     $movieId = getPost("movieId");
    //
    //     if (getPost("doSave")) {
    //         $movieTitle = getPost("movieTitle");
    //         $movieYear  = getPost("movieYear");
    //         $movieImage = getPost("movieImage");
    //         $this->app->db->connect();
    //         $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
    //         $this->app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
    //     }
    //
    //     if (getPost("doDelete")) {
    //         $this->app->db->connect();
    //         $sql = "DELETE FROM movie WHERE id = ?;";
    //         $this->app->db->execute($sql, [$movieId]);
    //         return $this->app->response->redirect("movie/select");
    //     } elseif (getPost("doAdd")) {
    //         $this->app->db->connect();
    //         $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
    //         $this->app->db->execute($sql, ["A title", 2017, "img/noimage.png"]);
    //         $movieId = $this->app->db->lastInsertId();
    //         $this->app->session->set("movieId", $movieId);
    //         return $this->app->response->redirect("movie/movieEdit");
    //     } elseif (getPost("doEdit") && is_numeric($movieId)) {
    //         $this->app->session->set("movieId", $movieId);
    //         return $this->app->response->redirect("movie/movieEdit");
    //     }
    //     return $this->app->response->redirect("movie/select");
    // }
    //
    //
    //
    // /**
    //  * edit db view
    //  *
    //  * @return object
    //  */
    // public function movieEditActionGet() : object
    // {
    //     $title = "Manage database | oophp";
    //
    //     $movieId = $this->app->session->get("movieId");
    //
    //     $this->app->db->connect();
    //     $sql = "SELECT * FROM movie WHERE id = ?;";
    //     $movie = $this->app->db->executeFetchAll($sql, [$movieId]);
    //     $movie = $movie[0];
    //
    //     $data = [
    //         "movieId" => $movieId ?? null,
    //         "movie" => $movie ?? null
    //     ];
    //
    //     $this->app->page->add("movie/header");
    //     $this->app->page->add("movie/movieEdit", $data);
    //
    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }
}
