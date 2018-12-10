<?php

if (!isset($_POST['score']) || !isset($_POST['num']) || !isset($_POST['mode']) || !isset($_POST['size']) || !isset($_POST['time'])) {
    header("Location: game.php");
}

$mode = $_POST['mode'];
$num = (int)$_POST['num'];
$size = (int)$_POST['size'];
$score = (float)$_POST['score'];
$time = (int)$_POST['time'];
$nextLevel = $num + 1;

session_start();
$_SESSION['level_score'][$num] = $score;
$_SESSION['level_time'][$num] = $time;

if ($nextLevel > 2) {
    // series over
    include('includes/check-token.php');
    validateToken(true);
    include('php/gameFunctions.php');
    insertSeriesScore($GLOBALS['user_id'], $size, array_sum($_SESSION['level_time']), array_sum($_SESSION['level_score']));
    session_destroy();
    header("Location: leaderboards.php");
} else {
    header("Location: game.php?mode=$mode&level=$nextLevel&size=$size");
}

?>