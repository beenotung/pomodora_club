<?php
if (!$_SERVER['REQUEST_METHOD'] <> 'POST') {
    http_response_code(400);
    echo '<code>Error: Only POST Method is supported.</code>';
    echo '<br>';
    echo '<a href="/">Back to Home</a>';
    exit;
}
?>