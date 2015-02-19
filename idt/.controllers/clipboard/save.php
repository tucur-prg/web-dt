<?php
$view->layoutDisabled = true;

$raw = file_get_contents('php://input');

list($type, $img) = explode(',', $raw, 2);

$ext  = 'png';
$code = 'plain';
if (preg_match('!^data:(?P<mime>.+);(?P<code>.+)!', $type, $match)) {
    list(,$ext) = explode('/', $match['mime']);
    $code = $match['code'];
}

$file = md5(microtime(true)) . '.' . $ext;

switch ($code) {
    case 'base64':
        $img = base64_decode($img);
        $fp = fopen(getenv('PHP_WEBROOT').'/.tmp/'.$file, 'w');
        fwrite($fp, $img);
        fclose($fp);
        break;
}

$view->file = $file;
