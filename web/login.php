<a href="login.html">Back to Login</a><br>
<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method <> 'POST') {
    http_response_code(400);
    echo '<code>Error: Only support POST Method</code>';
    echo "<p>Used $method Method</p>";
    echo '<a href="./">Back to Home</a>';
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

if (!$username) {
    echo 'Missing username';
    leave(400);
}
if (!$password) {
    echo 'Missing password';
    leave(400);
}

require_once 'common.php';
$query = "select count(*) count, user_id, type from user where username = ? and password = password(?);";
$stmt = db_execute(true, $query, "ss", $username, $password);
if (!mysqli_stmt_bind_result($stmt, $count, $user_id, $type)) {
    echo 'Failed to bind result';

    echo '<br> query = ', $query;
    leave(500);
}
mysqli_stmt_fetch($stmt);
if ($count <> 1) {
    echo 'Wrong username or password';
    leave(403);
}
echo '<p>Login success</p>';
session_start();
$_SESSION['user_id'] = $user_id;
if ($type <> 'admin') {
    echo '<a href="user_home.php">Go to user home</a>';
} else {
    echo '<a href="admin_home.php">Go to admin home</a>';
}
leave(200);
?>

