<?php

include_once('connection.php');

function insertSeriesScore($player_id, $level_mode, $level_size, $duration, $score) {
    $db = connectDB();
    $stmt = $db->prepare("INSERT INTO `games`(`player_id`, `level_mode`, `level_size`, `duration`, `score`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('isiid', $player_id, $level_mode, $level_size, $duration, $score);
    $stmt->execute();
}

?>