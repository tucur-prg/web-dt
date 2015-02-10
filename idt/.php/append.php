<?php
 /**
  * PHP実行後処理
  *
  * 出力制御
  */

$__dump = ob_get_clean();

$protocol   = $_SERVER['SERVER_PROTOCOL'];
$statusCode = Header::getInstance()->getStatusCode();
$headers    = Header::getInstance()->getAll();

header("${protocol} ${statusCode}");
foreach ($headers as $key => $value) {
    header("${key}: ${value}");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<base href="/idt/">
<title>開発ツール</title>
<?php echo Tag_Link::getInstance(); ?>
<?php echo Tag_Script::getInstance(); ?>
<?php echo $view->readScript(); ?>
<?php echo $view->readStyle(); ?>
</head>

<body>

<?php if ($view->layoutHeaderDisabled !== true) { ?>
<script>
$(function () {
    $('.ico-menu').click(function () {
        $('nav.main').animate({ width:'toggle' }, 300);
    });

    $('.hover-out').mouseleave(function () {
        $(this).animate({ width:'toggle' }, 300);
    });
});
</script>

<header>
    <h1><a href="/idt/">開発ツール</a></h1>

    <div class="list-ico">
        <span class="ico ico-menu"></span>
    </div>

    <div class="search-box">
        <form method="GET" action="http://jp2.php.net/manual-lookup.php" target="_blank">
            <span class="category"><img src="data:image/x-icon;base64,Qk02AwAAAAAAADYAAAAoAAAAEAAAABAAAAABABgAAAAAAAADAADEDgAAxA4AAAAAAAAAAAAAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICA19fX19fX19fXwICAwICAwICAwICAwICAwICAwICA19fX19fX19fXwICAwICAwICA19fXAAAA19fXwICAwICAwICAwICAwICAwICAwICA19fXAAAA19fXwICAwICAwICA19fXAAAA19fX19fXwICAwICA19fXwICAwICA19fX19fXAAAA19fX19fXwICAwICA19fXAAAAAAAAAAAA19fX19fXAAAA19fX19fXAAAA19fXAAAAAAAAAAAA19fX19fX19fXAAAA19fX19fXAAAA19fXAAAA19fX19fXAAAA19fXAAAA19fX19fXAAAA19fX19fXAAAA19fX19fXAAAA19fXAAAA19fX19fXAAAA19fXAAAA19fX19fXAAAA19fX19fXAAAA19fX19fXAAAA19fXAAAA19fX19fXAAAA19fXAAAA19fX19fXAAAA19fX19fXAAAAAAAAAAAA19fX19fXAAAAAAAAAAAA19fX19fXAAAAAAAAAAAA19fX19fXwICA19fX19fX19fXwICA19fXAAAA19fX19fXwICAwICA19fX19fX19fXwICAwICAwICAwICAwICAwICAwICA19fXAAAA19fXwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICA19fX19fX19fXwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICAwICA"></span>
            <input type="text" name="pattern" value="" placeholder="検索ワード">
            <input type="hidden" name="lang" value="ja">
            <input type="hidden" name="scope" value="quickref">
            <input type="submit" value="検索">
        </form>
    </div>
</header>

<nav class="main hover-out hidden">
    <div><a href="conversion/">暗号/複合</a></div>
    <div><a href="image/">画像解析</a></div>
    <div><a href="request/">リクエスト解析</a></div>
</nav>
<?php } ?>

<?php echo $view->readContent(); ?>

<?php echo $view->escape($__dump); ?>

</body>
</html>
