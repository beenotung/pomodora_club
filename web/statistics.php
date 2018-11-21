<link rel="stylesheet" href="style/common.css">
<button onclick="history.back()">Back</button><br>
<?php
require_once 'common.php';

$query = 'select count(*) count from user;';
$stmt = db_execute(true, $query);
mysqli_stmt_bind_result($stmt, $count);
mysqli_stmt_fetch($stmt);
mysqli_stmt_free_result($stmt);
$user = $count;

$query = 'select count(*) count from task where finish_time is null;';
$stmt = db_execute(true, $query);
mysqli_stmt_bind_result($stmt, $count);
mysqli_stmt_fetch($stmt);
mysqli_stmt_free_result($stmt);
$new = $count;

$query = 'select count(*) count from task where finish_time is not null;';
$stmt = db_execute(true, $query);
mysqli_stmt_bind_result($stmt, $count);
mysqli_stmt_fetch($stmt);
mysqli_stmt_free_result($stmt);
$done = $count;
?>

<h2>Users</h2>
<table>
    <tbody>
    <tr>
        <td>Number of users:</td>
        <td><?php echo $user ?></td>
    </tr>
    </tbody>
</table>

<h2>Tasks</h2>
<table>
    <tbody>
    <tr>
        <td>Number of pending tasks:</td>
        <td><?php echo $new ?></td>
    </tr>
    <tr>
        <td>Number of finished tasks:</td>
        <td><?php echo $done ?></td>
    </tr>
    <tr>
        <td>Total number of tasks:</td>
        <td><?php echo($new + $done) ?></td>
    </tr>
    </tbody>
</table>

