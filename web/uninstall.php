<a href="/">Back</a><br>
<?php
require_once 'common.php';

$query = file_get_contents('uninstall.sql');
db_query(true, $query);
echo 'ok.';
?>
