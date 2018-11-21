<html>
<head>
    <meta charset="UTF-8">
    <title>Pomodoro Club</title>
</head>
<body>
<link rel="stylesheet" href="style/common.css">
<style>
    .head {
        height: 10em;
    }

    .root {
        display: flex;
        align-items: flex-start;
    }

    menu, h2 {
        width: 10em;
    }

    iframe {
        width: calc(100vw - 15em);
        height: calc(100vh - 12em);
    }
</style>
<div text-center class="head">
    <img src="img/logo.png">
    <h1>Welcome to Pomodoro Club</h1>
</div>
<div class="root">
    <menu>
        <h2>Main Menu</h2>
        <ul>
            <li><a href="signup.html">Signup</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="search.html">Search</a></li>
            <li><a href="README.html">ReadMe</a></li>
        </ul>
        <h2>Admin Menu</h2>
        <ul>
            <li><a href="install.php">Install</a></li>
            <li><a href="uninstall.php">Uninstall</a></li>
            <li><a href="reset.php">Reset</a></li>
        </ul>
    </menu>
    <main>
        <iframe src="README.html"></iframe>
    </main>
</div>
</body>
</html>