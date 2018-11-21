<?php session_start();
$user_id = $_SESSION['user_id'];

require_once 'common.php';
$query = 'select username from user where user_id = ?;';
$stmt = db_execute(true, $query, "i", $user_id);
if (!mysqli_stmt_bind_result($stmt, $username)) {
    echo 'Fail to bind username';
    leave(500);
}
mysqli_stmt_fetch($stmt);
mysqli_stmt_free_result($stmt);

require_once 'common.php';
$query = 'select task_id, task_name, finish_time from task where user_id = ?;';
$stmt = db_execute(true, $query, "i", $user_id);
if (!mysqli_stmt_bind_result($stmt, $task_id, $task_name, $finish_time)) {
    global $link;
    echo 'Failed to bind task result';
    echo '<br> statement error = ', mysqli_stmt_error($stmt);
    echo '<br> db error = ', mysqli_error($link);
    leave(500);
}
$tasks = array();
while (mysqli_stmt_fetch($stmt)) {
    $task = array(
        'task_id' => $task_id,
        'task_name' => $task_name,
        'finish_time' => $finish_time,
        'done' => !is_null($finish_time)
    );
    array_push($tasks, $task);
}
?>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<link rel="stylesheet" href="styles/common.css">
<style>
    main {
        display: flex;
        align-items: flex-start;
        max-width: 100vw;
    }

    form {
        display: inline-block;
        margin: 1em;
    }
</style>
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
<main>
    <form method="post" action="change_password.php">
        <h2>Profile</h2>
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
        <br>
        <input type="submit" value="Change Username and Password">
    </form>
    <form>
        <h2>Timer</h2>
        <input type="number" value="25">
    </form>
</main>
<main>
    <form method="post" action="create_task.php">
        <h2>New Task</h2>
        Task Name:
        <input type="text" name="task_name">
        <br>
        <input type="submit" value="Save New Task">
    </form>
    <form method="post" action="update_task.php">
        <h2>Task List</h2>
        <table>
            <thead>
            <tr>
                <th>Done</th>
                <th>Task Name</th>
                <th>Finish Time</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tasks as $idx => $task) {
                $task_id = $task['task_id'];
                $task_name = $task['task_name'];
                $finish_time = $task['finish_time'];
                if ($task['done']) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
//            echo '<hr>';
//            var_dump($task);
//            echo '<hr>';
                echo "<tr>
<td><input type='checkbox' name='tasks[$idx][done]' value='true' $checked></td>
<input type='text' name='tasks[$idx][task_id]' value='$task_id' hidden>
<td><input type='text' name='tasks[$idx][task_name]' value='$task_name'></td>
<td><input type='text' value='$finish_time' readonly></td>
</tr>";
            }
            ?>
            </tbody>
        </table>
        <br>
        <input type="submit" value="Update Tasks">
    </form>
</main>
</body>
</html>
<h4>Debug:</h4>
<?php
echo '<hr>';
echo 'user id = <br>';
var_dump($user_id);
echo '<hr>';
echo 'username = <br>';
var_dump($username);
echo '<hr>';
echo 'tasks = <br>';
var_dump($tasks);
echo '<hr>';
leave(200);
?>
