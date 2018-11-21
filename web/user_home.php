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
?>
