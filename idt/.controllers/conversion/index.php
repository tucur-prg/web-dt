<?php

$view->encode = isset($_POST['encode']) ? (string) $_POST['encode'] : CHARSET;
$view->value  = (string) $_POST['value'];
$view->option = (string) $_POST['option'];

$view->crypto  = new Container_Utils();
$view->hash    = new Container_Utils();
$view->convert = new Container_Utils();
$view->escape  = new Container_Utils();

if ($dh = opendir('./utils')) {
    while (($file = readdir($dh)) !== false) {
        if (in_array($file, array('.', '..'))) {
            continue;
        }

        $className = 'Utils_' . ucfirst(basename($file, '.php'));
        if (interface_exists($className)) {
            continue;
        }

        $interfaceNames = class_implements($className);

        switch (current($interfaceNames)) {
            case 'Utils_Icrypto':
                $view->crypto->add(new $className());
                break;

            case 'Utils_Ihash':
                $view->hash->add(new $className());
                break;

            case 'Utils_Iconvert':
                $view->convert->add(new $className());
                break;

            case 'Utils_Iescape':
                $view->escape->add(new $className());
                break;
        }
    }
}
