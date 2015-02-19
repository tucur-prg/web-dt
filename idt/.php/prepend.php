<?php
/**
 * PHP実行前処理
 *
 * 設定など記載
 */

// 定数
define('CHARSET', 'utf-8');

// オートローダー
function __autoload($className)
{
    include_once implode('/', explode('_', strtolower($className))).'.php';
}

// パス設定
set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            get_include_path(),
            getenv('PHP_WEBROOT').'/.library',
            getenv('PHP_WEBROOT').'/.vendor',
        )
    )
);

// 実装

Header::getInstance()->add('Content-Type', 'text/html; charset='.strtoupper(CHARSET));

Tag_Link::getInstance()->addStylesheet('assets/display.css');
Tag_Script::getInstance()->addFile('assets/jquery/jquery-1.10.2.min.js');

$view = new View();

$view->setDir(dirname($_SERVER['SCRIPT_FILENAME']));
$view->setController(basename($_SERVER['SCRIPT_FILENAME'], '.php'));


// コントローラーで出力された内容を append.php 側で補足する
ob_start();
