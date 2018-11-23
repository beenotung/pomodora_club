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
    leave(403);
}

$username = $_POST['username'];
$password = $_POST['password'];

if (!$username) {
    echo 'Missing username<br>';
    leave(400);
}
if (!$password) {
    echo 'Missing password<br>';
    leave(400);
}

$query = 'update user set username = ?, password = password(?) where user_id = ?;';
$stmt = db_execute(false, $query, 'ssi', $username, $password, $user_id);
if (!$stmt) {
    if (db_errno == 1062) {
        echo 'username used by others already';
    } else {
        echo 'Failed to update';
        echo '<br> errno = ', db_errno;
        echo '<br> error = ', db_error;
    }
    leave(400);
}
echo 'updated username and password.';
?>
