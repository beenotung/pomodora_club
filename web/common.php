<?php

global $link;
function db_connect()
{
    global $link;
    $host = 'localhost';
    $user = 'my_user';
    $password = 'my_password';
    $database = 'my_db';
    $port = '3306';
    $link = mysqli_connect($host, $user, $password, $database, $port);
}

function db_disconnect()
{
}

function leave($status = 200)
{
    global $link;
    if ($link) {
        db_disconnect();
    }
    http_response_code($status);
    exit;
}

function db_check_connection()
{
    global $link;
    if (!$link) {
        db_connect();
    }
}


function db_execute($force, $query, $types = "", ...$vars)
{
    db_check_connection();
    global $link;
    $stmt = mysqli_prepare($link, $query);
    if (!$stmt) {
        if (!$force) {
            return false;
        }
        echo 'Failed to prepare query';

        echo '<br> query = ';
        var_dump($query);

        leave(500);
        return false;
    }
    if (!mysqli_stmt_bind_param($stmt, $types, ...$vars)) {
        if (!$force) {
            return false;
        }
        echo 'Failed to bind params';

        echo '<br> query = ';
        var_dump($query);

        echo '<br> types = ';
        var_dump($types);

        echo '<br> vars = ';
        var_dump($vars);

        echo '<br> error = ';
        var_dump(mysqli_stmt_error($stmt));

        leave(500);
        return false;
    }
    if (!mysqli_stmt_execute($stmt)) {
        if (!$force) {
            define('db_errno', mysqli_errno($link));
            define('db_error', mysqli_error($link));
            return false;
        }
        echo 'Failed to execute statement';

        echo '<br> query = ';
        var_dump($query);

        echo '<br> types = ';
        var_dump($types);

        echo '<br> vars = ';
        var_dump($vars);

        echo '<br> errno = ';
        var_dump(mysqli_errno($link));

        echo '<br> error = ';
        var_dump(mysqli_error($link));

        leave(500);
        return false;
    }
    return $stmt;
}

function db_query($force, $query)
{
    db_check_connection();
    global $link;
    if (!mysqli_multi_query($link, $query)) {
        if (!$force) {
            return false;
        }
        echo 'Failed to query: ', mysqli_error($link);
        echo '<br> query = ', $query;
        leave(500);
        return false;
    }
    return true;
}

function db_query_free()
{
    global $link;
    do {
        if ($result = mysqli_store_result($link)) {
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($link));
}

?>