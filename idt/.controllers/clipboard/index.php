<?php

$view->path    = isset($_GET['path']) ? (string) $_GET['path'] : null;
$view->enabled = is_file(getenv('PHP_WEBROOT') . '/.tmp/' . $view->path);

