<?php

namespace PJH\MyContent;

// var_dump($content);

?><form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="contentId" value="<?= esc($content->id) ?>"/>

        <label>Title:<br>
        <input type="text" name="contentTitle" value="<?= esc($content->title) ?>"/>
        </label>
    <br>
        <label>Path:<br>
        <input type="text" name="contentPath" value="<?= esc($content->path) ?>"/>
    <br>
        <label>Slug:<br>
        <input type="text" name="contentSlug" value="<?= esc($content->slug) ?>"/>
    <br>
        <label>Text:<br>
        <textarea name="contentData"><?= esc($content->data) ?></textarea>
    <br>
        <label>Type:<br>
        <input type="text" name="contentType" value="<?= esc($content->type) ?>"/>
    <br>
        <label>Filter:<br>
        <input type="text" name="contentFilter" value="<?= esc($content->filter) ?>"/>
    <br>
        <label>Publish:<br>
        <input type="datetime" name="contentPublish" value="<?= esc($content->published) ?>"/>
    <br>
        <button type="submit" name="doSave"><i class="fa fa-floppy" aria-hidden="true"></i> Save</button>
        <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
        <button type="submit" name="doDelete"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
    </fieldset>
</form>
