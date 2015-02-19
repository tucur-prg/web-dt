<?php

$view->connection = (string) $_POST['connection'];
$view->query      = (string) $_POST['query'];

list($up, $hd)         = explode('@', $view->connection);
list($user, $passwd)   = explode(':', $up);
list($host, $database) = explode('/', $hd);

//$pdo = new PDO("mysql:dbname={$database};host={$host}", $user, $passwd);

$querys = explode(';', $view->query);

$view->result = array();
foreach ($querys as $key => $query) {
    $query = trim($query);
    if (empty($query)) {
        continue;
    }

    $stime = microtime(true);
/*
    $statement = $pdo->prepare($query);
    $statement->execute();
*/
    $etime = microtime(true);

    $time = round($etime - $stime, 3);

    $list = array(
        array('test' => 123, 'value' => 'abc', 'foo' => 'bar', 'null' => null),
        array('test' => 456, 'value' => 'def', 'foo' => 'fuga', 'null' => null),
        array('test' => 789, 'value' => 'ghi', 'foo' => 'hoge', 'null' => null),
    );

    $view->result[] = array(
        'query'  => $query,
        'fields' => array_keys($list[0]),
        'rows'   => $list,
        'count'  => count($list),
        'time'   => $time,
    );
}
