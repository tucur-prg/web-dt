<?php

$view->modifyType = array(
    'post',
    'header',
    'cookie',
);

$view->url = (string) Request::post('url');

$modify = array(
    'header' => array(),
    'cookie' => array(),
    'post'   => array(),
);

foreach ($_POST as $key => $value) {
    if (preg_match('!^(post|header|cookie):!', $key, $match)) {
        $modify[$match[1]][$key] = $value;
    }
}

$view->modify = $modify;
