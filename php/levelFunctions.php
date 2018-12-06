<?php

include_once('connection.php');

function getRandomLevel() {
    $db = connectDB();
    $stmt = $db->prepare("SELECT size, small, large FROM levels ORDER BY rand() LIMIT 1");
    if (!$stmt->execute()) {
        internal_error();
    }
    $stmt->bind_result($size, $small, $large);
    $stmt->fetch();
    if ($size === 0) {
        $gameGrid = array_chunk(str_split($small), 7);
    } else if ($size === 1) {
        $gameGrid = array_chunk(str_split($large), 13);
    }
    return $gameGrid;
}

function getCounts($arr) {
    $counts = [];
    $streak = 0;
    foreach($arr as $val) {
        if ($val === '1') {
            $streak++;
        } else if ($streak !== 0) {
            array_push($counts, $streak);
            $streak = 0;
        }
    }
    return $counts;
}

?>