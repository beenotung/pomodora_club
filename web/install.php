<a href="/">Back</a><br>
<?php
require_once 'common.php';

$query = file_get_contents('install.sql');
db_query(true, $query);
echo 'ok.';
?>
