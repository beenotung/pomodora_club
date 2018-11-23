<button onclick="history.back()">Back</button><br>
<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method <> 'POST') {
    http_response_code(400);
    echo '<code>Error: Only support POST Method</code>';
    echo "<p>Used $method Method</p>";
    echo '<a href="./">Back to Home</a>';
    exit;
}

require_once 'common.php';

session_start();
$user_id = $_SESSION['user_id'];
if (!$user_id) {
    echo 'Not login yet';
    echo '<br><a href="login.html">Go to Login</a>';
    leave(403);
}

$task_name = $_POST['task_name'];
if (!$task_name) {
    echo 'Missing task name';
    leave(400);
}

$query = 'insert into task (user_id, task_name) values (?,?);';
db_execute(true, $query, "is", $user_id, $task_name);
echo 'saved new task.'

?>
