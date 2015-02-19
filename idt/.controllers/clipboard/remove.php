<?php
$path = $_GET['path'];

if (preg_match('!^[^/]+\.(png)$!', $path)) {
    @unlink(getenv('PHP_WEBROOT').'/.tmp/'.$path);
}

Header::getInstance()->add('Location', '/idt/clipboard/');
