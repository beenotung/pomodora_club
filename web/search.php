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

$keyword = $_POST['keyword'];
if (!$keyword) {
    echo 'Missing keyword';
    leave(400);
}

echo "<h1>Search result of $keyword</h1>";

$query = "select username from user where username like concat('%',?,'%');";
$stmt = db_execute(true, $query, 's', $keyword);
echo "<h2>Matched users:</h2><ol>";
mysqli_stmt_bind_result($stmt, $username);
while (mysqli_stmt_fetch($stmt)) {
    echo "<li>$username</li>";
}
mysqli_stmt_free_result($stmt);
echo "</ol>";

$query = "select task_name from task where task_name like concat('%',?,'%');";
$stmt = db_execute(true, $query, 's', $keyword);
echo "<h2>Matched tasks:</h2><ol>";
mysqli_stmt_bind_result($stmt, $task_name);
while (mysqli_stmt_fetch($stmt)) {
    echo "<li>$task_name</li>";
}
mysqli_stmt_free_result($stmt);
echo "</ol>";

?>
