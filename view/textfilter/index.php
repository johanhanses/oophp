<?php

namespace PJH\TextFilter;

/**
 * A page to show of my textfilter class and it's methods
 */



$text1 = file_get_contents(__DIR__ . "/text/bbcode.txt");
$textfilter1 = new MyTextFilter();
$html1 = $textfilter1->parse($text1, "bbcode,nl2br");

$text2 = file_get_contents(__DIR__ . "/text/clickable.txt");
$textfilter2 = new MyTextFilter();
$html2 = $textfilter2->parse($text2, "link");

$text3 = file_get_contents(__DIR__ . "/text/sample.md");
$textfilter3 = new MyTextFilter();
$html3 = $textfilter3->parse($text3, "markdown");




?><h1>Testing textfilters</h1>

<!-- bbcode -->
<h2>Showing off BBCode and nl2br</h2>

<h3>Source in bbcode.txt</h3>
<pre><?= wordwrap(htmlentities($text1)) ?></pre>

<h3>Filter BBCode applied, source</h3>
<pre><?= wordwrap(htmlentities($html1)) ?></pre>

<h3>Filter BBCode applied, HTML (including my method for nl2br())</h3>
<?= $html1 ?>

<!-- clickable -->
<h2>Showing off Clickable</h2>

<h3>Source in clickable.txt</h3>
<pre><?= wordwrap(htmlentities($text2)) ?></pre>

<h3>Source formatted as HTML</h3>
<?= $text2 ?>

<h3>Filter Clickable applied, source</h3>
<pre><?= wordwrap(htmlentities($html2)) ?></pre>

<h3>Filter Clickable applied, HTML</h3>
<?= $html2 ?>

<!-- markdown -->
<h1>Showing off Markdown</h1>

<h2>Markdown source in sample.md</h2>
<pre><?= $text3 ?></pre>

<h2>Text formatted as HTML source</h2>
<pre><?= htmlentities($html3) ?></pre>

<h2>Text displayed as HTML</h2>
<?= $html3 ?>
