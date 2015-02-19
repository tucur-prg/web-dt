<?php
Tag_Script::getInstance()->addFile('assets/jquery/plugin/exif.js');

$view->url = (string) $_POST['url'];

if (preg_match('!^https?://.*!', $view->url)) {
    $binaryImg = file_get_contents($view->url);

    $binaryImg64 = base64_encode($binaryImg);
    $mimeType    = image_type_to_mime_type(exif_imagetype('data:application/octet-stream;base64,'.$binaryImg64));

    $view->imgScheme = "data:{$mimeType};base64,{$binaryImg64}";
}

/*
$file = './204928286_89ced49818.jpg';

echo $file, "<br>";
$exif = exif_read_data($file, 'IFD0');
echo $exif===false ? "No header data found.<br>\n" : "Image contains headers<br>\n";

$exif = exif_read_data($file, 0, true);
foreach ($exif as $key => $section) {
    echo "<hr>\n";
    echo '<table border="1">'."\n";
    echo '<caption>'.$key.'</caption>'."\n";
    foreach ($section as $name => $val) {
        echo '<tr><th align="left">'.$name.'</th><td>'.(is_array($val) ? implode("<br>", $val) : $val).'</td></tr>'."\n";
    }
    echo "</table>\n";
}
*/
