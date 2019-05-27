<?php

namespace PJH\MyContent;

// namespace Anax\View;

?>

<article>

<?php foreach ($resultset as $row) : ?>
<section>
    <header>
        <h1><a href="<?= \Anax\View\url("mycontent/blogPost/" . $row->slug) ?>"><?= esc($row->title) ?></a></h1>
        <p><i>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i></p>
    </header>
    <?= esc($row->data) ?>
</section>
<?php endforeach; ?>

</article>
