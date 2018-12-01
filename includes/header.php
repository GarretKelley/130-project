<?php

include_once('php/connection.php');
connectDB();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Picross</title>
    <?php
        $currentName = basename($_SERVER['PHP_SELF']);
        $cssFile = explode('.', $currentName)[0];
        print("<link rel=\"stylesheet\" type=\"text/css\" href=\"css/$cssFile.css\"/>\n");
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
			integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
			crossorigin="anonymous"></script>
</head>
<body>
<header>
    <div class="buttons">
        <button class="a">Log out</button>
        <button class="a" onclick="location.href='about.html'">How to play &raquo;</button>
        <button class="a" onclick="location.href='author.html'">About the author &raquo;</button>
        <button class="b" onclick="location.href='game.html'">PLAY</button>
    </div>
</header>
<?php

echo("hello world!"); 

?>