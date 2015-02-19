<?php

Tag_Link::getInstance()->addStylesheet('assets/syntaxhighlighter/styles/shCore.css');
Tag_Link::getInstance()->addStylesheet('assets/syntaxhighlighter/styles/shThemeDefault.css');

Tag_Script::getInstance()->addFile('assets/syntaxhighlighter/scripts/shCore.js');
Tag_Script::getInstance()->addFile('assets/syntaxhighlighter/scripts/shBrushCss.js');
Tag_Script::getInstance()->addFile('assets/syntaxhighlighter/scripts/shBrushJScript.js');
Tag_Script::getInstance()->addFile('assets/syntaxhighlighter/scripts/shBrushXml.js');

$view->layoutHeaderDisabled = true;

$url = (string) $_POST['url'];

$modify = array(
    'header' => array(),
    'cookie' => array(),
    'post'   => array(),
);

foreach ($_POST as $key => $value) {
    if (preg_match('!^(header)::(.+)$!', $key, $match)) {
        $modify[$match[1]][] = $match[2].': '.$value;
    } elseif (preg_match('!^(post|header|cookie)::(.+)$!', $key, $match)) {
        $modify[$match[1]][$match[2]] = $value;
    }
}

if (preg_match('!^https?://!', $url)) {
    $resrc = curl_init();

    list($baseUrl) = explode('?', $url);
    if (preg_match('!\.(js|css)$!', $baseUrl, $match)) {
        $view->contentType = $match[1];
    } else {
        $view->contentType = 'html';
    }

    $header = $modify['header'];
    $post   = http_build_query($modify['post']);
    $cookie = http_build_query($modify['cookie'], '', ';');

    curl_setopt_array(
        $resrc,
        array(
            CURLOPT_URL            => $url,
            CURLOPT_HTTPHEADER     => $header,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLINFO_HEADER_OUT    => true,
            CURLOPT_HEADER         => true,
        )
    );

    if (count($modify['post']) > 0) {
        curl_setopt($resrc, CURLOPT_POST, true);
        curl_setopt($resrc, CURLOPT_POSTFIELDS, $post);
    }

    if (count($modify['cookie']) > 0) {
        curl_setopt($resrc, CURLOPT_COOKIE, $cookie);
    }

    list($responseHeader, $source) = explode("\r\n\r\n", curl_exec($resrc), 2);

    $enc    = mb_detect_encoding($source);
    $source = mb_convert_encoding($source, 'UTF8', $enc);

    $info   = curl_getinfo($resrc);

    $requestHeader = $info['request_header'];
    unset($info['request_header']);

    $view->curlInfo = $info;
    $view->request  = $requestHeader;
    $view->response = $responseHeader;

    $view->source   = $source;

    curl_close($resrc);
}
