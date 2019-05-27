<?php

namespace PJH\MyContent;

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
class MyContentController implements AppInjectableInterface
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
        $title = "Content management | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM content;";
        $resultset = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("mycontent/header");
        $this->app->page->add("mycontent/index", [
            "resultset" => $resultset,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * 404
     *
     * @return object
     */
    public function ooopsActionGet() : object
    {
        $title = "Ooops! | oophp";

        $this->app->page->add("mycontent/header");
        $this->app->page->add("mycontent/404");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * landing view for pages
     *
     * @return object
     */
    public function pagesActionGet() : object
    {
        $title = "View pages | oophp";

        $this->app->db->connect();
        $sql = <<<EOD
SELECT
    *,
    CASE
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
    END AS status
FROM content
WHERE type=?
;
EOD;
        $resultset = $this->app->db->executeFetchAll($sql, ["page"]);

        $this->app->page->add("mycontent/header");
        $this->app->page->add("mycontent/pages", [
            "resultset" => $resultset,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * landing view for blog
     *
     * @return object
     */
    public function blogActionGet() : object
    {
        $title = "View blog | oophp";

        $this->app->db->connect();
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE type=?
    AND deleted IS NULL
ORDER BY published DESC
;
EOD;
        $resultset = $this->app->db->executeFetchAll($sql, ["post"]);

        $this->app->page->add("mycontent/header");
        $this->app->page->add("mycontent/blog", [
            "resultset" => $resultset,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * view a specific page
     *
     * @return object
     */
    public function pageActionGet($rutt) : object
    {
        $route = $rutt;

        $this->app->db->connect();
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
    path = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
;
EOD;
        $content = $this->app->db->executeFetch($sql, [$route, "page"]);
        if (!$content) {
            return $this->app->response->redirect("mycontent/ooops");
        }
        $title = $content->title;

        $this->app->page->add("mycontent/header");
        $this->app->page->add("mycontent/page", [
            "content" => $content,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * view a specific blog entry
     *
     * @return object
     */
    public function blogPostActionGet($rutt) : object
    {
        $this->app->db->connect();

        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
    slug = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
ORDER BY published DESC
;
EOD;
        $slug = $rutt;
        $content = $this->app->db->executeFetch($sql, [$slug, "post"]);
        if (!$content) {
            return $this->app->response->redirect("mycontent/ooops");
        }

        $title = $content->title;

        $this->app->page->add("mycontent/header");
        $this->app->page->add("mycontent/blogpost", [
            "content" => $content,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * admin
     *
     * @return object
     */
    public function adminActionGet() : object
    {
        $title = "Content management | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM content;";
        $resultset = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("mycontent/header");
        $this->app->page->add("mycontent/admin", [
            "resultset" => $resultset,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * create
     *
     * @return object
     */
    public function createActionGet() : object
    {
        $title = "Create new content | oophp";

        $this->app->page->add("mycontent/header");
        $this->app->page->add("mycontent/create");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * create
     *
     * @return object
     */
    public function createActionPost() : object
    {
        if (hasKeyPost("doCreate")) {
            $title = getPost("contentTitle");

            $this->app->db->connect();
            $sql = "INSERT INTO content (title) VALUES (?);";
            $this->app->db->execute($sql, [$title]);
            $id = $this->app->db->lastInsertId();
            return $this->app->response->redirect("mycontent/edit/" . $id);
        }
    }



    /**
     * delete
     *
     * @return object
     */
    public function deleteActionGet($id) : object
    {
        $title = "Delete from database | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM content WHERE id = ?;";
        $content = $this->app->db->executeFetch($sql, [$id]);

        $data = [
            "content" => $content ?? null,
        ];

        $this->app->page->add("mycontent/header");
        $this->app->page->add("mycontent/delete", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * delete
     *
     * @return object
     */
    public function deleteActionPost($id)
    {
        $contentId = $id;

        if (!is_numeric($contentId)) {
            return $this->app->response->redirect("mycontent/index");
        }

        if (getPost("doDelete")) {
            $this->app->db->connect();
            $sql = "UPDATE content SET deleted=NOW() WHERE id = ?;";
            $this->app->db->execute($sql, [$contentId]);
            return $this->app->response->redirect("mycontent/admin");
        }

        if (getPost("doReturn")) {
            return $this->app->response->redirect("mycontent/admin");
        }
    }



    /**
     * edit view
     *
     * @return object
     */
    public function editActionGet($id) : object
    {
        $title = "Edit content | oophp";
        $contentId = $id;
        if (!is_numeric($contentId)) {
            return $this->app->response->redirect("mycontent/index");
        }

        $this->app->db->connect();
        $sql = "SELECT * FROM content WHERE id = ?;";
        $content = $this->app->db->executeFetchAll($sql, [$contentId]);
        $content = $content[0];

        $data = [
            "content" => $content ?? null
        ];

        $this->app->page->add("mycontent/header");
        $this->app->page->add("mycontent/edit", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * edit process
     *
     * @return object
     */
    public function editActionPost($id)
    {
        $contentId = $id;
        if (!is_numeric($contentId)) {
            return $this->app->response->redirect("mycontent/index");
        }

        if (hasKeyPost("doDelete")) {
            return $this->app->response->redirect("mycontent/delete/" . $id);
        } elseif (hasKeyPost("doSave")) {
            $params1 = getPost([
                "contentTitle", "contentPath", "contentSlug", "contentData",
                "contentType", "contentFilter", "contentPublish", "contentId"
            ]);

            $params2 = getPost([
                "contentTitle", "contentPath", "contentData", "contentType",
                "contentFilter", "contentPublish", "contentId"
            ]);

            $slug = $params1["contentSlug"];
            $this->app->db->connect();
            $sql = "SELECT slug FROM content WHERE slug = ?;";
            $checkIfSlugExists = $this->app->db->executeFetch($sql, [$slug]);

            if (!$params1["contentSlug"]) {
                $params1["contentSlug"] = slugify($params1["contentTitle"]);
            }

            if (!$params1["contentPath"]) {
                $params1["contentPath"] = null;
            }

            if (!$checkIfSlugExists) {
                $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";

                $this->app->db->execute($sql, array_values($params1));
            } else {
                $sql = "UPDATE content SET title=?, path=?, data=?, type=?, filter=?, published=? WHERE id = ?;";

                $this->app->db->execute($sql, array_values($params2));
            }

            return $this->app->response->redirect("mycontent/admin");
        }
    }



    /**
     * reset database
     *
     * @return object
     */
    public function resetActionGet() : object
    {
        $title = "Reset database | oophp";

        $this->app->page->add("mycontent/header");
        $this->app->page->add("mycontent/reset");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * reset database process and show result of query
     *
     * @return object
     */
    public function resetActionPost() : object
    {
        $title = "Reset database | oophp";

        // Restore the database to its original settings
        $file   = dirname(__FILE__, 3) . "/sql/content/setup.sql";
        if ($_SERVER["SERVER_NAME"] === "www.student.bth.se") {
            $mysql  = "mysql";
        } else {
            $mysql  = "/Applications/XAMPP/xamppfiles/bin/mysql";
        }
        $output = null;

        // Extract hostname and databasename from dsn
        $this->app->db->connect();
        $databaseConfig = require dirname(__FILE__, 3) . "/config/database.php";
        $dsnDetail = [];
        preg_match("/mysql:host=(.+);dbname=([^;.]+)/", $databaseConfig["dsn"], $dsnDetail);
        $host = $dsnDetail[1];
        $database = $dsnDetail[2];
        $login = $databaseConfig["username"];
        $password = $databaseConfig["password"];

        if (isset($_POST["reset"]) || isset($_GET["reset"])) {
            $command = "$mysql -h{$host} -u{$login} -p{$password} $database < $file 2>&1";
            $output = [];
            $status = null;
            exec($command, $output, $status);
            $output = "<p>The command exit status was $status."
                . "<br>The output from the command was:</p><pre>"
                . print_r($output, 1);
        }

        $data = [
            "output" => $output ?? null,
        ];

        $this->app->page->add("mycontent/header");
        $this->app->page->add("mycontent/reset", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
