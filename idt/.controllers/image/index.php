<?php
Tag_Script::getInstance()->addFile('assets/jquery/plugin/exif.js');

$view->url = (string) Request::post('url');

if (preg_match('!^https?://.*!', $view->url)) {
    $binaryImg = file_get_contents($view->url);

    $binaryImg64 = base64_encode($binaryImg);
    $mimeType    = image_type_to_mime_type(exif_imagetype('data:application/octet-stream;base64,'.$binaryImg64));

    $view->imgScheme = "data:{$mimeType};base64,{$binaryImg64}";
}
