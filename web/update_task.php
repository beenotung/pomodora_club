<button onclick="history.back()">Back</button><br>
<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method <> 'POST') {
    http_response_code(400);
    echo '<code>Error: Only support POST Method</code>';
    echo "<p>Used $method Method</p>";
    echo '<a href="/">Back to Home</a>';
    exit;
}

require_once 'common.php';

session_start();
$user_id = $_SESSION['user_id'];
if (!$user_id) {
    echo 'Not login yet';
    leave(403);
}

$tasks = $_POST['tasks'];

echo '<hr>';
var_dump($tasks);
echo '<hr>';

foreach ($tasks as $task) {
    $task_id = $task['task_id'];
    $task_name = $task['task_name'];

    echo 'updating task ', $task_id, '.';

    /* update task name */
    $query = 'update task set task_name = ? where task_id = ?;';
    db_execute(true, $query, 'si', $task_name, $task_id);
    db_query_free();

    echo '.';
    if ($task['done']) {
        /* update finish time if it's newly done */
        $query = 'update task set finish_time = CURRENT_TIMESTAMP where task_id = ? and finish_time is null;';
        db_execute(true, $query, 'i', $task_id);
        db_query_free();
    } else {
        /* unset finish time if it's unchecked */
        $query = 'update task set finish_time = null where task_id = ?';
        db_execute(true, $query, 'i', $task_id);
        db_query_free();
    }
    echo 'finished<br>';
}
echo 'ok.';
leave(200);
?>
