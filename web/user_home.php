<?php session_start();
$user_id = $_SESSION['user_id'];
$query = 'select username from user where user_id = ?;';
require_once 'common.php';
$stmt = db_execute(true, $query, "i", $user_id);
if (!mysqli_stmt_bind_result($stmt, $username)) {
    echo 'Fail to bind username';
    leave(500);
}
mysqli_stmt_fetch($stmt);
?>
    <html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
    <link rel="stylesheet" href="styles/common.css">
    <div text-center>
        <img src="imgs/logo.png">
        <h1>Welcome back to Pomodoro Club</h1>
    </div>
    <menu>
        <h2>User Menu</h2>
        <ul>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </menu>
    <h2>Profile</h2>
    <form method="post" action="change_password.php">
        <table>
            <tbody>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo $username ?>"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            </tbody>
        </table>
        <input type="submit">
    </form>
    </body>
    </html>
<?php leave(200); ?>