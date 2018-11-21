<a href="signup.html">Back</a><br>
<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method <> 'POST') {
    http_response_code(400);
    echo '<code>Error: Only support POST Method</code>';
    echo "<p>Used $method Method</p>";
    echo '<a href="/">Back to Home</a>';
    exit;
}
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

if (!$username) {
    echo 'Missing username';
    leave(400);
}
if (!$password) {
    echo 'Missing password';
    leave(400);
}
if (!$password2) {
    echo 'Missing Re-Password';
    leave(400);
}

if ($password <> $password2) {
    echo 'Password not matching';
    leave(400);
}

require_once 'common.php';
global $link;

$query = "insert into user(username,password) values (?,password(?))";
$result = db_execute(false, $query, "ss", $username, $password);
if (!$result) {
    if (db_errno == 1062) {
        echo 'This username is taken';
        leave(400);
    } else {
        echo "error = ", db_error;
        leave(500);
    }
}

echo 'Signup Succeed';
leave(200);

?>