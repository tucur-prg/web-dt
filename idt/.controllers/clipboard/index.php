<?php

$view->path    = Request::get('path');
$view->enabled = is_file(getenv('PHP_WEBROOT') . '/.tmp/' . $view->path);

